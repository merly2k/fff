<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of block
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class block extends element{
    public $block;
    
    function __construct() {
        ;
    }

    public function set($name, $value=NULL) {
        $this->$name = $value;
        return TRUE;
    }

    public function get($name) {
        return $this->$name;
    }
    public function bottom_bar($in){
        /**<div class="bottom_block bottom">  
         * <div class="content">
         * $context
         * </div>
         * </div>
         */
        $context=$this->div('class="content"', $in);
        $this->block=$this->div('class="bottom_block bottom"',$context);
    }
}

?>
