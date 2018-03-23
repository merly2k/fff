<?php
$p=$this->param[0];
if(empty($_SESSION['login'])or empty($_SESSION['id'])){
    $t=WWW_BASE_PATH."auth/singup";
}else{
    $t=WWW_BASE_PATH."cabinet/invest/add/".$p;
}
header ("Location: $t ");