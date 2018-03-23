<?php
$template='cabinet';
$mod_name='настройки';
$ajax.="";
$con= file_get_contents('config.php');
if($_POST){
    save_file('bkp',$con);
    save_file('bkp',$_POST['config']);
}
$context.="<article class='module width_full'><header><h3>Правка конфигурации</h3></header>
		<div class='module_content'> <fieldset>
<legend>редактор конфигурации</legend>
<form name='config' method='POST'>";
$context.="<textarea name='config'rows='16'>$con</textarea>";
$context.='<div class="submit_link">
<button class="alt_btn" name="save" value="сохранить" type="submit">сохранить</button>
</div></form>
</fieldset>';

include TEMPLATE_DIR . DS . $template . ".html";
function save_file($f_type='php',$fcontent) {
    $w=fopen('config.'.$f_type,'w');
    fwrite($w,$fcontent);
    fclose($w);
}
?>