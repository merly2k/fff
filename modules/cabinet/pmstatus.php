<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$template="blank";

include TEMPLATE_DIR.$template.".html";
extract($_POST);
/**
$PAYEE_ACCOUNT":"U13071786",
$PAYMENT_AMOUNT":"0.5",
$PAYMENT_UNITS":"USD",
$PAYMENT_BATCH_NUM":"175856917",
$PAYMENT_ID":,
$SUGGESTED_MEMO":"",
$V2_HASH":"error_empty_phrase",
$TIMESTAMPGMT":"1494552902",
$PAYER_ACCOUNT":"U14322874"
 * 
 */
$cdate=date(time() + strtotime('+2 min'));
 $q="INSERT INTO `payments_in` (`uid`, `paycode`, `paysumm`, `paysustem`, `paydate`, `status`) VALUES ("
	. "'".$_SESSION[id]."',"
	. " '".$PAYMENT_BATCH_NUM."',"
	. " '".$PAYMENT_AMOUNT."',"
	. " '".$PAYEE_ACCOUNT."',"
	. " '$TIMESTAMPGMT',"
	. " 'ok');";
 $dbc->query($q);
 $qz="INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".$_SESSION['id']."', 'Покупка пакета через ПерфектМоней', 'pay');";   
 $dbc->query($qz);
 $dbc->query("INSERT INTO `user_fundation` (`user_id`, `fund_id`,`invest_summ`, `payments_period`) "
	 . "VALUES ('".$_SESSION['id']."', '".$SUGGESTED_MEMO."','".$PAYMENT_AMOUNT."', '15');");
 
$redirectTo=WWW_BASE_PATH."cabinet";
header('Location: ' . $redirectTo);