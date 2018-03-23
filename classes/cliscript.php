<?php

abstract class CliScript
{

	const OUTPUT_FORMAT = '%time %pid %role %message';
	
	/**
	 * Time in microseconds to sleep before starting next child
	 * default is 200000 (0.2 seconds)
	 * 
	 * @var int
	 */
	public $usleep_next_worker = 200000;
	
	/**
	 * 
	 * filename of log file, keep empty if need to output to STDOUT
	 * 
	 * @see CliScript::log()
	 * 
	 * @var string
	 */
	public $file_log;
	
	/**
	 * message to display on -h --help -? or when required parameter not specified
	 * 
	 * @var string
	 */
	protected $help;
	
	/**
	 * @see getParameter()
	 * @var array 'param'=>'value'
	 */
	private $script_parameters = array();
	
	/**
	 * current thred PID
	 * @var int
	 */
	private $pid;

	/**
	 * is set to TRUE inside worker thred
	 * @var bool
	 */
	private $iam_worker = false;
	
	/**
	 * 
	 * script starting time 
	 * @var int
	 */
	private $start_time;
	
	/**
	 * 
	 * used in log, worker index for easier debuging
	 * @var int
	 */
	private $worker_index;
	
	private $index_next = 1;

	/**
	 * number of workers to start when no master thread is used
	 * 
	 * @var int
	 */
	private $workers = 1;
	
	/**
	 * array of children PIDs
	 *  
	 * @var array
	 */
	private $pids_workers = array();
	
	private $is_signal_handler_installed = false;
	
	/**
	 * a "touch" file in temporary dir, similar to pid file, the filename content PID of master and worker, see run() and startWorker()
	 * 
	 * @var string
	 */
	private $file_touch;
	
	private $file_result;
	
	private $is_master_ended;
	
	private $remains_prefix;
	
	/**
	 * 
	 * working thread logic
	 * 
	 * @param mixed $item
	 */
	abstract protected function processWorker($item);
	
	public function __construct()
	{
		$this->pid = getmypid();
		
		if (isset($_SERVER['REQUEST_TIME']))
		{
			$this->start_time = $_SERVER['REQUEST_TIME'];
		}
		else
		{
			$this->start_time = time();	
		}
		
		$this->script_parameters = $this->parseCLIParameters();
		
		if ( 0 < count(array_intersect(array('h','help','?'), array_keys($this->script_parameters))) )
		{
			echo($this->help."\n");
			exit(0);
		}
		
		pcntl_signal( SIGCHLD, array($this, 'handleSignalSIGCHLD'), false);
		
		$disable_log = $this->getParameter('disable_log', 0);
	    
		if ($disable_log == '1' or ( property_exists('Config', 'disable_cli_logs') and Config::$disable_cli_logs ) )
		{
		    $this->file_log = null;
		}
		elseif (!empty($this->file_log) and property_exists('Config', 'dir_logs'))
		{
			$this->file_log = Config::$dir_logs.'/'.$this->file_log;
		}
		
		// setup remains
		
		if (class_exists('PhpForks'))
		{
		    $this->remains_prefix = PhpForks::$remains_prefix;
		}
        elseif (property_exists('Config', 'dir_tmp'))
		{
			$this->remains_prefix = Config::$dir_tmp.'/cliscripts/';
		}
		else
		{
		    $this->remains_prefix = sys_get_temp_dir().'/cliscripts/';
		}
		
		if (!file_exists($this->remains_prefix))
		{
			mkdir($this->remains_prefix, 0777);
			chmod($this->remains_prefix, 0777);
		}
		
	}
	
	final public function __destruct()
	{
		if (is_file($this->file_touch))
		{
			unlink($this->file_touch);	
		}
		
		if ( $this->iam_worker )
		{
			return;
		}
		else
		{
			$this->is_master_ended = true;
		}
		
		// parent should wait for all children
		
		$this->log('master ended. waiting for workers to finish...');
		
		$this->waitForChildren();
		
		$this->log('all workers finished. Party duration: '.$this->getRunningTime().' seconds');
		
		// clenup all files
		
		$files = glob($this->remains_prefix.'m_'.$this->pid.'_*');
		
		if( count($files) )
		{
			foreach ($files as $file)
			{
				unlink($file);
			}
		}
	}
	
	protected function getRunningTime()
	{
		return (time() - $this->start_time);
	}

	private function parseCLIParameters()
	{
		$result = array ();
		$params = $GLOBALS['argv'];
		reset($params);

		while (list ($tmp, $p) = each($params))
		{
			if ($p[0] == '-')
			{
				$pname = substr($p, 1);
				$value = true;
				if ($pname[0] == '-')
				{
					// long-opt (--<param>)
					$pname = substr($pname, 1);
					if (strpos($p, '=') !== false)
					{
						// value specified inline (--<param>=<value>)
						list ($pname, $value) = explode('=', substr($p, 2), 2);
					}
				}
				// check if next parameter is a descriptor or a value
				$nextparm = current($params);
				if ( $value === true and $nextparm !== false and $nextparm[0] != '-')
					list ($tmp, $value) = each($params);
				$result[$pname] = $value;
			}
			else
			{
				// param doesn't belong to any option
				$result[] = $p;
			}
		}
		
		return $result;
	}
	
	public function getParameter($parameter_name, $default_value='__NOT_DEFINED__')
	{
		if (!isset($this->script_parameters[$parameter_name]) and $default_value==='__NOT_DEFINED__' )
		{
			echo("parameter {$parameter_name} is not specified. use -h, --help or -? to display help\n");
			exit(1);
		}
		elseif( isset($this->script_parameters[$parameter_name]) )
		{
			return $this->script_parameters[$parameter_name];
		}
		else
		{
			return $default_value;
		}
	}
	
	/**
	 * Sets the number of parrallel workers to run.
	 *
	 * @param integer $workers
	 */
	final public function setWorkers($workers)
	{
		if ($workers < 1)
		{
			throw new Exception('workers must be >1 and <500');
		}
		
		if ($workers > 100)
		{
			throw new Exception('Forking too many workers could lead to fork bomb. Make sure you know what you are doing and change this hardcoded limit.');
		}

		if (!function_exists('pcntl_fork') and $workers > 1)
		{
			throw new Exception('Cannot use pcntl_fork()');
		}
		else
		{
			$this->workers = $workers;
		}
	}

	/**
	 * run the script.
	 *
	 * if processMaster() method exists - execute processMaster() and exit
	 * if number of worker > 1 - start mulitple threads, otherwise just call processWorker()
	 */
	final public function run()
	{
		if (method_exists($this, 'processMaster'))
		{
			$this->file_touch = $this->remains_prefix.'master_'.$this->pid;
			touch($this->file_touch);
			
			$this->processMaster();
		}
		else
		{
			if ($this->workers == 1)
			{
				$this->iam_worker = true;
				
				$this->processWorker(null);
			}
			elseif ($this->workers > 1)
			{
				$this->runMultipleWorkers();
			}			
		}
	}
	
	/**
	 * start defined number of threads
	 */
	final private function runMultipleWorkers()
	{
		$this->pids_workers = array();
		
		for ($i = 0, $workers = $this->workers; $i < $workers; ++$i)
		{
			$this->startWorker();
			
			usleep($this->usleep_next_worker);
		}
	}
	
	protected function canStartWorker()
	{
		if ($this->countWorkers() >= $this->workers )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	/**
	 * 
	 * start working thread
	 * 
	 * @param mixed $item
	 */
	final protected function startWorker($item=null)
	{
		if (!$this->is_signal_handler_installed)
		{
			$this->installPcntlSignalHandler();	
		}
		
		if ( ! $this->canStartWorker())
		{
			throw new Exception('max workers started, cannot start worker, use canStartWorker() to check' );
		}
		
		$pid = pcntl_fork();
		
		$next_index = $this->index_next++;
		
		if ($pid == 0) // child
		{
			$master_pid = $this->pid;
			
			$this->iam_worker = true;
			$this->pid = getmypid();
			$this->worker_index = $next_index;

			$this->file_touch = $this->remains_prefix.'m_'.$master_pid.'_w_'.$this->pid;
			 
			file_put_contents($this->file_touch, serialize(array($this->worker_index,$item)) );
			
			unset($this->pids_workers); // doesn't make sense in child process, removing to avoid confusion
			
			try {
				
				$result = $this->processWorker($item);
				
			} catch (Exception $e)
			{
				$result = 'ERROR:EXCTEPTION_'.get_class($e);
			}
			
			if ($result !== NULL)
			{
				$this->file_result = $this->remains_prefix.'m_'.$master_pid.'_w_'.$this->pid.'_result';
				file_put_contents($this->file_result, serialize($result) );
			}
			
			unlink($this->file_touch);
			
			$this->selfKill();
		}
		elseif ($pid < 0) // error
		{
			throw new Exception('Cannot fork process');	
		}
		else 
		{
			$this->log("started worker {$pid}");
			
			$this->pids_workers[] = $pid;
		}
		
		return $pid;
	}
	
	final private function selfKill()
	{
		system("kill -9 {$this->pid}");
		
		die();
	}
	
	/**
	 * make sure all children finished
	 */
	final protected function waitForChildren()
	{
		if( 0 == count($this->pids_workers) )
		{
			return;
		}
		
		if (!function_exists('pcntl_signal_dispatch'))
		{
			$use_php53_pcntl = false;
			
			declare(ticks=1);
		}
		else 
		{
			$use_php53_pcntl = true;
		}
		
		do 
		{
			if ($use_php53_pcntl)
			{
				pcntl_signal_dispatch();	
			}
			
			$pid_ended = pcntl_waitpid(-1, $status, WNOHANG);
			
			if( in_array($pid_ended, $this->pids_workers) )
			{
				// child ended
				
				unset($this->pids_workers[array_search($pid_ended, $this->pids_workers)]);
			}
			else
			{
				// very small sleep to avopid "zombie" processes flushing in the process list
				// feel free to increase if parent will be taking too much CPU
				
				usleep(10000);
			}
			
		} while ( count($this->pids_workers) > 0 );
	}
	
	final private function installPcntlSignalHandler()
	{
		pcntl_signal(SIGTERM, array($this, 'handleSignal'));
	}
	
	private function handleSignal($signo)
	{
		switch ( $signo )
		{
			case SIGHUP:
			case SIGTERM :
				
				echo 'opa!';
				
				return;
				
				if ( !$this->iam_worker )
				{
					$this->log('terminating...');
				
					foreach ($this->pids_workers as $pid)
					{
						exec('kill -9 '.$pid);
					}					
				}
				
				exec('kill -9 '.$this->pid);

				break;
				
			default :
		
				$this->log('got not handled signal: '.$signo);
		}
	}

	
	public function handleSignalSIGCHLD($signo)
	{
		static $warning_was_displaied = false;
		static $exists_processing_method = 'NOT CHECKED';
		
		if ($exists_processing_method == 'NOT CHECKED' and method_exists($this, 'processResult'))
		{
			$exists_processing_method = true;	
		}
		elseif ($exists_processing_method == 'NOT CHECKED')
		{
			$exists_processing_method = false;
		}
		
		if( $signo ===  SIGCHLD)
		{
			if($this->is_master_ended and !$warning_was_displaied and $exists_processing_method)
			{
				$this->log('Master ended before processing results. Results will be lost.');

				$warning_was_displaied = true;
			}
			
			$results_files = glob($this->remains_prefix.'m_'.$this->pid.'_w_*_result');
			
			if(count($results_files))
			{
				if( !$exists_processing_method )
				{
					$this->log('Workers are returning results but no processResult() method found. All results will be lost');
				}
				
				foreach ($results_files as $result_file)
				{
					preg_match("~m_{$this->pid}_w_(\d+)_~", $result_file, $matches );
					
					$worker_pid = $matches[1];
					
					$result = file_get_contents($result_file);
					$result = unserialize($result);
					
					if ($exists_processing_method and !$this->is_master_ended)
					{
						$this->processResult($result, $worker_pid);	
					}
					
					unlink($result_file);
				}
			}
		} 
	}
	
	/**
	 * Logs a message to the standard output if debug us enabled 
	 *
	 * @see self::$debug
	 * @param string $message
	 */
	protected function log($message)
	{
		if (empty($this->file_log))
		{
			echo($this->getFormattedMessage($message)."\n");
			return;		
		}
		
		$fh = fopen($this->file_log, 'a');
		
		if (is_resource($fh))
		{
			fwrite($fh, $this->getFormattedMessage($message)."\n" );
			fclose($fh);
		}
		else
		{
			echo($this->getFormattedMessage($message)."\n");
		}
		
	}
	
	private function getFormattedMessage($message)
	{
		$time = strftime('%Y-%m-%d %H:%M:%S');
		
		if ($this->iam_worker)
		{
			$role = "\033[0;34mworker_".str_repeat('_', 5 - (strlen($this->worker_index)) ).$this->worker_index."\033[0m ";
		}
		else
		{
			$role = "\033[0;31mMASTER______\033[0m ";
		}
		
		$message_formatted = str_replace('%time', $time , self::OUTPUT_FORMAT );
		$message_formatted = str_replace('%role', $role, $message_formatted);
		$message_formatted = str_replace('%pid', $this->pid, $message_formatted);
		$message_formatted = str_replace('%message', $message, $message_formatted);
		
		return $message_formatted;
	}
	
	protected function countWorkers()
	{
		do
		{
			$pid_ended = pcntl_waitpid(-1, $status, WNOHANG);
			
			if( in_array($pid_ended, $this->pids_workers) )
			{
				// child ended
				
				unset($this->pids_workers[array_search($pid_ended, $this->pids_workers)]);
				
				$return = false; 
			}
			else
			{
				$return = true;
			}
		
		} while (!$return );

		return count($this->pids_workers);
	}
		
	
}



