<?php

$template = "cabinet"; //dform; //"index";
$context='';
/**
 * 	`id` INT(10) NOT NULL AUTO_INCREMENT,
 * 	`name` VARCHAR(50) NULL DEFAULT NULL,
 * 	`deckription` TEXT NULL,
 */
//print_r($_POST);
//echo $this->param[0];
$cont_id = $this->param[0];
$ajax = "";

$mod_name = 'Удаление статьи';
$context.="<article class='module width_full'><header><h3>Удаление статьи</h3></header>
		<div class='module_content'> ";
if (!empty($cont_id)) {
    $ed = new blog();
    $art=$ed->SelectBy($cont_id);
    $art=$art[0];
    $context.= "Вы собрались удалить статью, если это так нажмите кнопку &quot;удалить&quot;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;если нет - просто перейдите на любую другую страницу.";
    $context.="<fieldset>
<legend>статья $art->id</legend>
<form name='del_content' method='POST'>
    <input type='hidden' name='id' value='$cont_id' />
        <input type='hidden' name='ref' value='ed_content' />
    <div class='width_full'>
    $art->article
    </div>
    <div class='submit_link'>
        <button type='submit' name='act' value='Удалить' class='btn btn-danger'>Удалить</button>
	<a href='".WWW_ADMIN_PATH."/blog' class='btn btn-info'>Отменить</a>
    </div>
</form>
</fieldset>
";
} else {

}

if ($_POST) {
    extract($_POST);
    $mid = (int) $id;
    $z_ap = new blog();
    $z_ap->Delete($id);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {
    $context.="<script>location.replace('" . WWW_BASE_PATH . "cabinet/blog/');</script>";
    }
}



include TEMPLATE_DIR . DS . $template . ".html";
?>

