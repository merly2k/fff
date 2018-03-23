<?php
if($_POST){
    extract($_POST);
    $updater = new db();
    $up="UPDATE `context` SET `context`='".stripslashes($content)."',`header`='$header' WHERE  `id`='$id' LIMIT 1;";
    $updater->query($up);
    echo "<script type='text/javascript'>
     location.replace('".WWW_BASE_PATH."manage/ed_content/$id');
</script>";
}
?>
