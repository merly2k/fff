<?php

$template = "cabinet"; //dform; //"index";
/**
 * 	`id` INT(10) NOT NULL AUTO_INCREMENT,
 * 	`name` VARCHAR(50) NULL DEFAULT NULL,
 * 	`deckription` TEXT NULL,
 */
//print_r($_POST);
//echo $this->param[0];
$n_id = $this->param[0];
$context="";
if ($_POST):
    extract($_POST);
    $z_apparment = "update `news` SET `article`='$content' where `id`='$id';";
    print_r($z_apparment);
    $z_ap = new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {

    }
endif;
$ajax = "";
$module_name = 'Управление новостями';
$context.="<article class='module width_full'><header><h3>Управление новостями</h3></header>
		<div class='module_content'> ";



if (!empty($n_id)) {
    $ed = new db();
    $zap = "select * from news where `id`='$n_id' LIMIT 1;";
    $ed->get_rows($zap);
    extract($ed->result[0]);


    $context.="<fieldset>
<legend>новость $n_id</legend>
<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "cabinet/news/update/$n_id'>
    <input type='hidden' name='id' value='$n_id' />
        <input type='hidden' name='ref' value='ed_news' />
<div class='control-group'>
  <label class='col-3 control-label' for='textinput'>Заголовок</label>
     
<input class='form-control col-9' type='text' id='textinput' name='title' value='$title' />

</div>
	
<div class='width_full'>
    <textarea name='article' id='editor' class='editor' rows='10' style='width:100%'>$article</textarea>
</div>
<button type='submit'class='btn btn-default'>save</button>
</form>
</fieldset>
";
} else {
$context.="<fieldset>
<legend>новость</legend>
<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "manage/news/add'>
   
        <input type='hidden' name='ref' value='ed_news' />
	        <input type='text' name='title' value='' />
<div class='width_full'>
    <textarea id='editor' name='content'></textarea>
</div>
<button type='submit'class='btn btn-default'>save</button>
</form>
</fieldset>
";
}


include TEMPLATE_DIR . DS . $template . ".html";
?>

