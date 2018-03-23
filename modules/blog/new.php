<?php
$template="newcab1";//dform; //"index";
/**
*	`id` INT(10) NOT NULL AUTO_INCREMENT,
*	`name` VARCHAR(50) NULL DEFAULT NULL,
*	`deckription` TEXT NULL,
*/
//print_r($_POST);
//echo $this->param[0];
$cont_id=$this->param[0];

$mod_name='Новая статья';
$context.="<article class='module width_full'><header><h3>Новая статья</h3></header>
		<div class='module_content'> ";

if(!$_POST){
    $context.="<div class='table-responsive'><fieldset>
<hr>
<form name='add_content' method='POST'>
<div class='control-group'>
  <label>Заголовок</label>
  <input class='form-control' type='text' name='name'/><br><br>
</div>
<div class='control-group'>
  <label>ссылка</label>
  <input class='form-control' type='text' name='title'/><br><br>
</div>
    <textarea id='editor' class='editor' style='width:100%' name='content'></textarea>

	<button class='btn btn-success'><i class='fa fa-save'></i> Сохранить</button>
</form>

</fieldset></div>
";
} else {
    extract($_POST);
    $z_ap=new blog();
    $article= mysql_real_escape_string(stripcslashes($content));
    $val=array("name"=>"$name",
               "title"=>"$title",
              "article"=>"$article",
              "publik"=>"1",
              "razdel"=>"0",
              "pdate"=>"");
          
    $context.=$z_ap->Insert($val);
            
        
    
}




        include TEMPLATE_DIR.DS.$template.".html";
        
 ?>

