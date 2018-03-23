<?php
$template ="cabinet"; //uncomment this string if not use default template
$module_name="Мои счета>> Пополнение счёта";
$context="";

// регистрационная информация (логин, пароль #1) 
// registration info (login, password #1)
 $mrh_login = "demo";
 $mrh_pass1 = "password_1"; 
// номер заказа 
// number of order
$inv_id = 0;
// описание заказа 
// order description 
$inv_desc = "Пополнение счета ROBOKASSA";
// сумма заказа // sum of order 
$def_sum = "1000"; 
// тип товара 
// code of goods 
$shp_item = 2; 
// язык 
// language 
$culture = "ru"; 
// кодировка 
// encoding 
$encoding = "utf-8";
// формирование подписи 
// generate signature 
$crc = md5("$mrh_login::$inv_id:$mrh_pass1:shp_Item=$shp_item"); 
// HTML-страница с кассой 
// ROBOKASSA HTML-page print 
$context.="<div class='container'><i>для пополнения лицевого счёта воспользуйтесь формой платёжной системы, введя в поле желаемую сумму платежа и нажав кнопку &quot;оплатить&quot;<br>Вы будете направлены на сайт платёжной системы, где сможете выбрать удобный для вас вариант оплаты и произвести её.<br> Деньги будут зачислены на ваш расчётный счёт в нашей системме в течении 1 минуты после подтверждения платежа</1><br>"
	. "<script language=JavaScript ".
	"src='https://auth.robokassa.ru/Merchant/PaymentForm/FormFLS.js?".
	"MerchantLogin=$mrh_login&DefaultSum=$def_sum&InvoiceID=$inv_id".
	"&Description=$inv_desc&SignatureValue=$crc&shp_Item=$shp_item".
	"&Culture=$culture&Encoding=$encoding&shp_user='".$_SESSION['login']."'></script></div>"
	. print_r($_SESSION,true); 
include TEMPLATE_DIR . DS . $template . ".html";

?>