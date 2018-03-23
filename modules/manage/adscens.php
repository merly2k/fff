<?php
$template="admin";
$mod_name='Управление рекламой';
if($_POST['id']){
    $message= save_post();    
}else{$message=array(); }


$context.="<article class='module width_full'><header><h3>управление рекламой</h3></header>
		<div class='module_content'>";
$baners=new db();
$zap='select * from adcens';
$baners->get_rows($zap);
foreach ($baners->result as $rowa) {
    extract($rowa);
    $context.="<form method='POST'>
    <fieldset>
        <label>$coment</label>
        <textarea rows='6' name='ad_code'>$ad_code</textarea><br />
        <input type='hidden' name='id' value='$id'>
    <div class='submit_link'>
        <button type='submit' name='save' value='сохранить' class='alt_btn'>сохранить</button>
    </div>
    </fieldset>
        </form>";
    }
    $context.="</div></article><!-- end of content manager article -->";
    $sidebar->left.= "<p>вставте код банерной системы и нажмите &quot;сохранить&quot;</p>";
    include TEMPLATE_DIR . DS . $template . ".html";
    unset($zap);
    $baners->close();
    
    function save_post(){
        $baner=new db();
        extract($_POST);
        $zapr="UPDATE `adcens` SET `ad_code`='".addslashes($ad_code)."' WHERE  `id`='$id' LIMIT 1;";
        $baner->query($zapr);
        if($baner->lastState!=0){
            $mess="банер не сохранен";
        }else{
            $mess='Успешно сохранено';
             }
        return $mess;
    };
?>
