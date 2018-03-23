<?php
ini_set("display_errors", 0);
$template = "newcab1"; //uncomment this string if not use default template
$module_name = "Реферальная программа";
$reflink0 = WWW_BASE_PATH . "register/" . $this->_DATA['login'];
$tree=0;// userRefTree($this->$_SESSION['id']);
$structure=count($tree);
$uid= $_SESSION['id'] ;
$parent=sponsorBlock();
$user= new mainUser();
$t=$user->RefOborot();
$t1=$user->UserInfo($uid);
$context = "

<div class='container'>"
	. "<div class='col-md-12' data-content='/ajax/'>"
	. ""
	. "</div>"
	. "<div class='col-md-12'>"
	. "<h2>Структура моих рефералов</h2>
        
        <div class='row'>
	
            <div class='sutreeview col-md-4'>
	    ".userTree($this->_DATA['id'])."
            </div>
	    <div class='col-md-7' id='userinfo' data-content='https://finansicalservice.com//ajax/userinfo/".$this->_DATA['id']."'>
	    <div class=''>Выберите человека из дерева слева, для просмотра информации о нём</div>
	    
            </div>
        </div>
        </div>
    <br><br>";

$context.=build_tree($cats, $this->_DATA[id]);

include TEMPLATE_DIR . DS . $template . ".html";
