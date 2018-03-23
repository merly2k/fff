<?php
$template = "cabinet"; //dform; //"index";
$module_name='Управление новостями';
$context='';
$cont_id = @$this->param[0];
$ajax = "";
$context='';
if (!$_POST) {
    $context.="<fieldset>

<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "/manage/news/add'>
    <input type='hidden' name='id' value='' />
        <input type='hidden' name='ref' value='ed_content' />
    <input type='text' name='title' value='' /><br /><br />
<div class='width_full'>
    <textarea id='editor' name='fool'></textarea>
    <button type='submit'class='btn btn-default'>save</button>
</div>
</form>
</fieldset>
";

} else {
    extract($_POST);
    $fool=stripslashes($fool);
$z_apparment = "insert into `news` SET `title`='$title',`fool`='$fool'";
$z_ap = new db();
$z_ap->query($z_apparment);
if ($z_ap->lastState) {
    echo $z_ap->lastState;
    echo "<script>
            var url='" . WWW_BASE_PATH . "manage/news';
            //location.replace(url);
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
}
include TEMPLATE_DIR . DS . $template . ".html";
?>