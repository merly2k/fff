<?php
/**
 * Description of session
 * @author merl
 */
class Session extends Registry
{
        private static $instance;
        public static function getInstance()
        {
                if( is_null(self::$instance) ) {
                        self::$instance = new self();
                }
                return self::$instance;
        }

        public function __construct() {
            session_start();
            $this->SID= session_id();
            
            }
                
        public function __get($name) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
            }
        
        public function __set($name, $value) {
            $_SESSION[$name] = $value;
            
            }
        public function clear(){
            session_start();
            session_unset();
            session_destroy();
            
            } 

}
?>
