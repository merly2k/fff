<?php
$template="admin";//dform; //"index";
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
} else {
    extract($_POST);
    $z_apparment="INSERT INTO `context` SET `header`='$header', `context`='$content';";
    $z_ap=new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) { $message=$z_ap->lastState;} else{
    }
}
$context.="<fieldset>
<legend>редактор статей</legend>
<form name='add_content' method='POST'>
    <input type='hidden' name='ref' value='ed_content' />
    <input type='text' name='header' value='$header' required='required' placeholder='введите url(имя для статьи на английском)'/><br /><br />
<div class='width_full'>
    <textarea id='editor1' class='editor1' name='content'>$content</textarea>
</div>
</form>
</fieldset>
";


        include TEMPLATE_DIR.DS.$template.".html";
        
 ?>

