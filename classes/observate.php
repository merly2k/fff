<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of observate
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class observate {

    public $classname = __CLASS__;
    static private $instance=null;
    private $observers=array();
    private $signals=array();
    
    function __construct() {
        if(self::$instance==NULL){
            self::$instance=new observate();
        }
        return self::$instance;
    }

    public function set($name, $value=NULL) {
        $this->$name = $value;
        $this->notifyObservers();
        return TRUE;
    }

    public function get($name) {
        return $this->$name;
    }
    
    public function registerObservers($obj){
        $this->observers[]=$obj;
    }
    public function notifyObservers(){
        foreach ($this->observers as $obj) {
            $obj->notify($this);
        }
    }

}

?>
