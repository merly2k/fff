<?php
if(@isset($this->param[0])){
    $_SESSION['Referal']=$this->param[0];
}
header("Location: ".WWW_BASE_PATH."");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

