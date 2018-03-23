<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of message
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class message {

    public $classname = __CLASS__;

    function __construct() {
	;
    }

    public function set($name, $value = NULL) {
	$this->$name = $value;
	return TRUE;
    }

    public function get($name) {
	return $this->$name;
    }
    public function addToGroupRequest($user){
	return "ваша заявка направлена владельцу группы";
    }
}

?>
