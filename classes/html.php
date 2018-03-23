<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of html
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class html {

    public $classname = __CLASS__;
    
    function __construct() {
    
    }
    
    

    public function set($name, $value=NULL) {
        $this->$name = $value;
        return TRUE;
    }

    public function get($name) {
        return $this->$name;
    }
    
    public static function ftag($tag,$param=null,$tag_content=null){
        return "<$tag $param>".$tag_content."</$tag>";
    }
    public static function stag($tag,$param=NULL) {
        return "<$tag $param />";
        
    }

}

?>
