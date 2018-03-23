<?php
error_reporting(9999999);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$context='';
$template="newcab1"
$modName="Типы задач";
$bcump="";
$tl=new tasktype();
foreach ($tl->listType()as $row){
    $context.="<option value='$row->ttype'>$row->tname</option>";
}
include TEMPLATE_DIR.$template.".html";

