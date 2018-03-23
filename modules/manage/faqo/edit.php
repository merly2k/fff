<?php

$template = "admin"; //dform; //"index";
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
    $z_apparment = "update `news` SET `news`='$content' where `id`='$id';";
    print_r($z_apparment);
    $z_ap = new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {

    }
endif;
$ajax = "";
$mod_name = 'Управление новостями';
$context.="<article class='module width_full'><header><h3>Управление новостями</h3></header>
		<div class='module_content'> ";



if (!empty($n_id)) {
    $ed = new db();
    $zap = "select * from news where `id`='$n_id' LIMIT 1;";
    $ed->get_rows($zap);
    extract($ed->result[0]);


    $context.="
<form method='POST' action='" . WWW_BASE_PATH . "/manage/faqo/update'>
	<label for='qw'>Вопрос</label><input class='form-control' name='qw' value='$qw' />
	<br />
	<label for='answer'>Ответ</label><textarea id='editor' name='answer'>$answer</textarea>
	<br />
	<label for='votes'>Голоса</label><input name='votes' value='$votes' />
<button type='submit'class='btn btn-default'>save</button>
</form>
";
} else {
$context.="<form method='POST' action='" . WWW_BASE_PATH . "/manage/faqo/update'>
	<label for='qw'>Вопрос</label><input class='form-control' name='qw' value='$qw' />
	<br />
	<label for='answer'>Ответ</label><textarea id='editor' name='answer'>$answer</textarea>
	<br />
	<label for='votes'>Голоса</label><input name='votes' value='$votes' />
<button type='submit'class='btn btn-default'>save</button>
</form>
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

