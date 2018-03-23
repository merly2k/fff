<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
print_r($_POST);
$json_string = json_encode($_POST);

$file_handle = fopen('my_filename.json', 'w');
fwrite($file_handle, $json_string);
fclose($file_handle);
$context='';
$template="blank";

include TEMPLATE_DIR.$template.".html";