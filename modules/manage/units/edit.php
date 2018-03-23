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
    $z_apparment = "update `unit` SET `cod`='$cod',`unit_name`='$unit_name' where `id`='$id';";
    //print_r($z_apparment);
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
    $zap = "select * from units where `id`='$n_id' LIMIT 1;";
    $ed->get_rows($zap);
    extract($ed->result[0]);


    $context.="<fieldset>
<legend>Запись $n_id</legend>
<form name='add_content' method='POST' action='" . WWW_ADMIN_PATH . "units/update/$n_id'>
    <input type='hidden' name='id' value='$n_id' />
        <input type='hidden' name='ref' value='ed_unit' />
<div class='control-group'>
<label class='col-3 control-label' for='textinput'>Осередок</label>
     
<input class='form-control col-9' type='text' id='textinput' name='unit_name' value='$unit_name' />

</div>
<label class='col-3 control-label' for='textinput'>Голова</label>
     
<input class='form-control col-9' type='text' id='textinput' name='contact_person' value='$contact_person' />

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

$postPrint="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){
                            $(tag).html(html);
                           // $('.column').equalHeight();
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }

        ";

include TEMPLATE_DIR . DS . $template . ".html";
?>

