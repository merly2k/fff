<?php
$template ="cabinet"; //uncomment this string if not use default template
$reflink0=WWW_BASE_PATH."register/".$this->_DATA['login'];
	
$context='<div class="col-md-4" data-content="'.WWW_BASE_PATH.'ajax/userpack/" ></div>'
	. '<div class="col-md-12 bg-info text-center"><h4>Ваша реферальная ссылка: '.$reflink0.'</h4></div><br>';
$context.='
    <div class="row justify-content-md-center">
        <div  data-content="'.WWW_BASE_PATH.'ajax/userpack/1"></div>
        <div  data-content="'.WWW_BASE_PATH.'ajax/userpack/2"></div>
        <div  data-content="'.WWW_BASE_PATH.'ajax/userpack/3"></div>
        <div  data-content="'.WWW_BASE_PATH.'ajax/userpack/4"></div>
        <div  data-content="'.WWW_BASE_PATH.'ajax/userpack/5"></div>
        
    </div>
    ';
include TEMPLATE_DIR . DS . $template . ".html";
?>
