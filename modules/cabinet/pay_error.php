<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$context='Платёж отклонён сервером платежной системы';
$template="blank";
$redirectTo=WWW_BASE_PATH."cabinet";
header('Location: ' . $redirectTo);
include TEMPLATE_DIR.$template.".html";