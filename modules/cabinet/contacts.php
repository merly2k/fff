<?php
// UI(user interfaces)
$template ="cabinet"; //uncomment this string if not use default template
$modName="Контакти<small></small>";
$cont_id='contacts';
$ed=new blog();

$context="";
if($_SESSION['role']==9):
    $bcump='<li><a href="'.WWW_BASE_PATH.'manage"><i class="fa fa-dashboard"></i>Дачборд</a></li><li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-home"></i> Головна</a></li>
            <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>Контакти</a></li>';
    else:
	$bcump='<li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
            <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>Контакти</a></li>';
endif;
      
$fid=$ed->SelectBy($cont_id,"name");
foreach ($fid as $art) {
    

$context.="<div class='container-fluid'>
            <div class='panel'>
               
	    $art->article
                
            </div>
        </div>";

}



include TEMPLATE_DIR . DS . $template . ".html";
?>
