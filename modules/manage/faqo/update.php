<?php
if($_POST){
    extract($_POST);
    $updater = new db();
    $up="UPDATE `news` SET `fool`='".stripslashes($content)."',`title`='$title' WHERE  `id`='$id' LIMIT 1;";
    $updater->query($up);
    echo "новость сохранена успешно";
    echo "<script type='text/javascript'>
     location.replace('".WWW_BASE_PATH."manage/news/');
</script>";
}
?>