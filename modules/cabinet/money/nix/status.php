<?php 

// здесь нужно прописать пароль от акаунта кошелька

define("PASSWORD","123123");

/*
PAYMENT_ID:PAYEE_ACCOUNT:PAYMENT_AMOUNT:PAYMENT_UNITS:PAYMENT_BATCH_NUM:PAYER_ACCOUNT:PasswordMD5:TIMESTAMPGMT
*/

  $string=
     $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
     $_POST['PAYMENT_BATCH_NUM'].':'.$_POST['PAYER_ACCOUNT'].':'.strtoupper(md5(PASSWORD)).':'.$_POST['TIMESTAMPGMT'];
     
$v2key=$_POST['V2_HASH'];
$hash=strtoupper(md5($string));
  
if($hash==$v2key) mail("mail@ya.ru", "Ok", "Line 1\nLine 2\nLine 3");
// в случае успешной оплаты  обрабатываем  (начисляем средства, записываем  в базу, отправляем на почту сообщение ...)

 ?>
