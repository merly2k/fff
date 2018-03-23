<?php
$template = "cabinet"; //dform; //"index";
$module_name='Управление новостями';
$context='';
$cont_id = @$this->param[0];
$ajax = "";
$context='';
if (!$_POST) {
    $context.="<div class='table-responsive'><fieldset>
<legend>новий запис</legend>
<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "cabinet/news/add'>
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
</fieldset></div>
";

} else {
    extract($_POST);
    $fool=stripslashes($article);
$z_apparment = "insert into `news` SET `title`='$title',`article`='$fool'";
$z_ap = new db();
$z_ap->query($z_apparment);
if ($z_ap->lastState) {
    //echo $z_ap->lastState;
    
}
echo "<script type='text/javascript'>
     location.replace('".WWW_BASE_PATH."cabinet/news/');
</script>";

}
include TEMPLATE_DIR . DS . $template . ".html";
?>