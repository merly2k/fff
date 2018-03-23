<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of robots
 * КЛАСС разбирающий файл robots.txt:
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 *   
 */

class robots
{
	var $content = ''; # текст файла robots.txt
	var $branches = array(); # здесь храним ветки для разных User-Agent
 
	# конструктор
	# @url: адрес сайта или хост в произвольном формате
	function robots($url)
	{
		# получаем файл robots.txt
		$url = preg_replace('#^http://#is', '', trim($url));
		$url = current(explode('/', $url));
		$this->content = trim(file_get_contents('http://' . $url . '/robots.txt'));
 
		# парсим полученные данные
		$s = preg_split('#[\n]+#is', $this->content);
		$current_user_agent = '';
		foreach($s as $line)
		{
			$line = trim(current(explode('#', trim($line), 2)));
			if (substr_count($line, ':')<1) continue;
			$line = explode(':', $line, 2);
			$current_directive = strtolower(trim($line[0]));
			$current_value = trim($line[1]);
			if ($current_directive == 'user-agent') 
			{
				$current_user_agent = $current_value;
			}
			elseif($current_user_agent!='')
			{
				$this->branches[$current_user_agent][$current_directive][] = $current_value;
			}
		}
	}
 
	# получить значение заданной директивы для заданного агента
	# @user_agent: агент
	# @directive: имя директивы
	# возвратит FALSE если директива не указана
	function get_directive($user_agent, $directive)
	{
		$user_agent = strtolower($user_agent);
		$directive = strtolower($directive);
		$ret = array();
		foreach($this->branches as $ua_mask=>$data)
		{
			if (($ua_mask=='*' || $user_agent=='*' || @preg_match('#'.preg_quote($ua_mask,'#').'#is', $user_agent)) && isset($data[$directive]))
			{
				$ret = array_merge($ret, $data[$directive]);
			}
		}
		if (count($ret)>0) return array_unique($ret); else return FALSE;
	}
 
	# проверить, запрещен ли url к индексации
	# @user_agent: агент
	# @url: полный url для проверки
	# возвратит TRUE если url запрещен
	function check_disallow($user_agent, $url)
	{
		$url = preg_replace('#^http://#is', '', trim($url));
		$url = explode('/', $url, 2);
		$url = (count($url)>1) ? '/' . $url[1] : '/' . $url[0];
		$url = trim($url);
		$info = $this->get_directive($user_agent, 'Disallow');
		foreach($info as $url_mask)		
		{
			if (preg_match('#^'.preg_quote($url_mask, '#').'#', $url))
			{
				return true;
			}
		}
		return false;
	}
}

?>
