<?php

$zindex = $this->param[0];
$img = $this->param[1];

echo "<img style='floaf:left;position:absolute;z-index:$zindex' src='" . WWW_MEDIA_PATH . "higth/$img'>";
?>