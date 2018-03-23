<?php
$template = "admin"; //dform; //"index";
$module_name='Управление новостями';
$context='';
$cont_id = @$this->param[0];
$ajax = "";
$context='';
if (!$_POST) {
    $context.="<form method='POST' action='" . WWW_BASE_PATH . "manage/faqo/add'>
	<label for='qw'>Вопрос</label><input class='form-control' name='qw' value='' />
	<br />
	<label for='answer'>Ответ</label><textarea id='editor' name='answer'></textarea>
	<br />
	<label for='votes'>Голоса</label><input name='votes' value='0' />
<button type='submit'class='btn btn-default'>save</button>
</form>
";

} else {
    extract($_POST);
    $answer=stripslashes($answer);
$z_apparment = "insert into `faqo` SET `qw`='$qw',`answer`='$answer',`votes`='$votes'";
$z_ap = new db();
$z_ap->query($z_apparment);
if ($z_ap->lastState) {
echo $z_ap->lastState;}
    echo "<script>
            var url='" . WWW_BASE_PATH . "manage/faqo';
            location.replace(url);
            </script>";
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