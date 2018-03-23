<?php

$template = "admin"; //dform; //"index";
$cont_id = $this->param[0];
$context='';
$ajax = "

";

$module_name = 'Удаление новости';
$context.="<article class='module width_full'><header><h3>Удаление вопроса</h3></header>
		<div class='module_content'> ";
if (!empty($cont_id)) {
    $ed = new db();
    $zap = "select * from faqo where `id`='$cont_id' LIMIT 1;";
    $ed->get_rows($zap);
    extract($ed->result[0]);
    $message = "Вы собрались удалить статью, если это так нажмите кнопку &quot;удалить&quot;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;если нет - просто перейдите на любую другую страницу.";
    $context.="<fieldset>
<legend> $qw</legend>
<form name='del_cpl' method='POST'>
    <input type='hidden' name='id' value='$cont_id' />
        <input type='hidden' name='ref' value='ed_content' />
    <div class='width_full'>
    $qw<hr>$answer
    </div>
    <div class='submit_link'>
        <button type='submit' name='act' value='Удалить' class='alt_btn'>Удалить</button>
    </div>
</form>
</fieldset>
";
} else {

}

if ($_POST) {
    extract($_POST);
    $mid = (int) $id;
    $z_apparment = "DELETE FROM `faqo` WHERE  `id`=$mid LIMIT 1;";
    //$context.=$z_apparment;
    $z_ap = new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {

    }
    echo "<script>location.replace('" . WWW_BASE_PATH . "manage/faqo/');</script>";
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
                            //$('.column').equalHeight();
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

