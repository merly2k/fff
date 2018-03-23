<?php
ini_set("display_errors", 1);
error_reporting(99999);
//print_r($_POST);
//$url = 'https://www.nixmoney.com/send?PASSPHRASE='.urlencode($_POST['PASSPHRASE']).'&PAYER_ACCOUNT='.urlencode($_POST['PAYER_ACCOUNT']).'&PAYEE_ACCOUNT='.urlencode($_POST['PAYEE_ACCOUNT']).'&AMOUNT='.urlencode($_POST['AMOUNT']).'&MEMO='.urlencode($_POST['MEMO']);
$url = 'http://dev.nixmoney.com/send?PASSPHRASE='.urlencode($_POST['PASSPHRASE']).'&PAYER_ACCOUNT='.urlencode($_POST['PAYER_ACCOUNT']).'&PAYEE_ACCOUNT='.urlencode($_POST['PAYEE_ACCOUNT']).'&AMOUNT='.urlencode($_POST['AMOUNT']).'&MEMO='.urlencode($_POST['MEMO']);
if(!file_get_contents($url)){
   echo 'error openning url';
}else{
    echo "Транзакция выполняется";
    
}
?>