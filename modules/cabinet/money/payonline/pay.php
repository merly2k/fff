<?php

$Currency='RUB';
$Amount=$_REQUEST['ammount'];
$OrderId=$_REQUEST['orderId'];
$ContentType="text";
$Email=$_REQUEST['email'];
$CardNumber=$_REQUEST['pan'];
$CardExpDate=$_REQUEST['valid_thru_month'].$_REQUEST['valid_thru_year'];
$CardCvv=$_REQUEST['cvv2'];
$Country=$_REQUEST['country'];
$City=$_REQUEST['city'];
$Address=$_REQUEST['address'];
$Zip="";
$State=$_REQUEST['state'];
$Phone=$_REQUEST['phone'];
$Issuer=$_REQUEST['issuer'];
$Ip="92.50.189.146";
$CardHolderName=$_REQUEST['сardholer_name'];

//Создаем новый класс 
    $pay = new GetPayment;
//Вызываем метод Complete (с получением результатов)
    $pay->PaymentAuth(
        $pay->MerchantId=57211,
        $pay->PrivateSecurityKey='3df0c3fa-de74-4548-8a5f-910883691c6f',
        $pay->Ip=$Ip,
        $pay->Email=$Email,
        $pay->CardHolderName=$CardHolderName,
        $pay->CardNumber=$CardNumber,
        $pay->CardExpDate=$CardExpDate,
        $pay->CardCvv=$CardCvv,
        $pay->Country=$Country,
        $pay->City=$City,
        $pay->Address=$Address,
        $pay->Zip=$Zip,
        $pay->State=$State,
        $pay->Phone=$Phone,
        $pay->Issuer=$Issuer,
        $pay->ContentType=$ContentType,
        $pay->OrderId=$OrderId,
        $pay->Amount=number_format($Amount, 2, '.', ''),
        $pay->Currency=$Currency,
        $pay->OrderDescription=$OrderDescription,
        $pay->ValidUntil=$ValidUntil);

// В переменной $Result находится ответ сервера на  команду PaymentAuth

?>

