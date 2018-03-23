<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of synonim
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class synonim {

    public $classname = __CLASS__;
    public $text_in;
    public $text_out;
    public $frases=array();
    public $dict_file = 'frases.txt';
    const ROW_DELIM   = '=>';   
    const VALUE_DELIM = '|';   

    function __construct() {
        $this->build_dictonary();
    }
    
    function parse(){
        $this->text_out= preg_replace_callback('/\(  (.*?)  \)/xs', "random_str", $this->text_in);
       $result = preg_replace('/terulala/', '', $subject);
    }
    
    function random_str($frase)
        {
	$ar=$this->frases[$frase];//[array_rand($ar, 1)];
	return $ar[array_rand($ar, 1)];
        }
        
    function build_dictonary(){
    $_parsed = file('libs/'. $this->dict_file);
    foreach ($_parsed as $k => $v) {
      $v = trim($v); 
      if (empty($v) || 0 === strpos($v, '#')) {
        ; // nop
      }
      else {
        $v = explode(self::ROW_DELIM, $v);
        $_key = trim($v[0]);
        $_data = array();
        if (strpos($v[1], self::VALUE_DELIM) !== false) {
            $data = explode(self::VALUE_DELIM, $v[1]);
            foreach ($data as $dk => $dv) {
                $_data[$dk] = trim($dv);
            }
        }
        else {
            $_data = array(trim($v[1]));
            if (strpos($_data[0], '@') === 0) {
                // this is alias
                $_data = $this->parsed[substr($_data[0], 1)];
            }
        }
     
        // save
        $this->frases[$_key] = $_data;
      }
    }
    }

}

?>
