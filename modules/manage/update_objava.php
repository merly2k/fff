<?php

if ($_POST) {
    extract($_POST);
    $updater = new db();
    $up = "UPDATE `announces`
        SET `message`='" . stripslashes($content) . "' WHERE  `id`=" . (int) $id . " LIMIT 1;";
    $updater->query($up);
    echo $updater->lastState;
    echo "<script type='text/javascript'>
     location.replace('" . WWW_BASE_PATH . "manage/ed_objava/$id');
</script>";
}
?>
