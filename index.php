<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); 
ini_set("max_execution_time", 0);
$p=dirname(__FILE__);
$template='tool'; //default template name
//$_SESSION['HTTP_REFERER']=$_SERVER['HTTP_REFERER'];
//echo $_SESSION["logged_in"];
require_once $p.'/config.php';
require_once $p.'/shared.php';
//require $p.'/vendor/autoload.php';
spl_autoload_register("autoload");
require_once __DIR__ . '/vendor/autoload.php';
function autoload($class_name) {
    $possibilities = array(
        APP_PATH . DS . $class_name . '.php',
        APP_PATH . DS . "classes" . DS . $class_name . '.php',
        APP_PATH . DS . "classes" . DS .  str_replace('\\', DS , $class_name) . '.php'
        );
        
    foreach ($possibilities as $file) {
        //echo $file."<br>";
        if (file_exists($file)) {
            require_once($file);
            return true;
        }
    }
    return false;
}

$app = new app();
    foreach($_SESSION as $name=>$value){
        $app->set($name, $value);
    };
    foreach($_COOKIE as $name=>$value){
        $app->set($name, $value);
    };

    foreach($_POST as $name=>$value){
        $app->set($name, $value);
    };
$app->router();

unset($app);

if (PRODUCT == 'dev') {


      $log = new \log2file;

     if (!error_get_last()):
         return 1;
     else:
         $errors = implode('|', error_get_last());
     endif;
    $log->log($errors, "error.log");


//$mempik= memory_get_peak_usage(true)/10485764;
//echo "максимально используемая память".round($mempik, 3)."Mb";
}

?>
