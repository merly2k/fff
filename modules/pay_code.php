<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dbc=new db();

if($_POST['walet']=="fs"){
if($_POST['gate']=="rw"){
    $waletname="реферального";
    $ae="UPDATE `user_money` SET `refmoney`=`refmoney`-".$_POST['ammoumt']." WHERE  `user_id`='".$_SESSION['id']."';";
    echo $ae;
    $dbc->query($ae);
    echo $dbc->lastState;
    $dbc->query("INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".$_SESSION['id']."', 'Покупка пакета с  ".wIco($_POST["gate"])." $waletname кошелька', 'pay');");   
    echo $dbc->lastState;
    $dbc->query("INSERT INTO `user_fundation` (`user_id`, `fund_id`,`invest_summ`, `payments_period`) VALUES ('".$_SESSION['id']."', '".$_POST['packet']."','".$_POST['ammoumt']."', '15');");
    echo $dbc->lastState;
    
$redirectTo=WWW_BASE_PATH."cabinet";
header('Location: ' . $redirectTo);
}else{
    $waletname="личнного";
    $dbc->query("UPDATE `user_money` SET `money`=`money`-".$_POST['ammoumt']." WHERE  `user_id`='".$_SESSION['id']."';");
    $dbc->query("INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".$_SESSION['id']."', 'Покупка пакета с ".wIco($_POST["gate"])." $waletname кошелька', 'pay');");   
    $dbc->query("INSERT INTO `user_fundation` (`user_id`, `fund_id`,`invest_summ`, `payments_period`) VALUES ('".$_SESSION['id']."', '".$_POST['packet']."','".$_POST['ammoumt']."', '15');");

    echo $dbc->lastState;
$redirectTo=WWW_BASE_PATH."cabinet";
header('Location: ' . $redirectTo);
}
}else{

$id=$_SESSION['id'];
if(empty($_POST['code'])):
$code=strToHex($id.":".date(time() + strtotime('+2 hour')));
$cdate=date(time() + strtotime('+2 hour'));
    $q="INSERT INTO `payments_in` (`uid`, `paycode`, `paysumm`, `paysustem`, `paydate`, `status`) VALUES ("
	. "'".$_SESSION[id]."',"
	. " '".$code."',"
	. " '".$_POST['ammoumt']."',"
	. " '".$_POST['gate']."',"
	. " '$cdate',"
	. " 'zapros');";
//print_r($q);
$dbc->query($q);
    
$context="<form method='post' class='form-horizontal card-body' style='background-color:#fcfcfc;padding:20px;'>
<fieldset class='' >
			<p><h4>Внимание, вы собрались оплатить покупку пакета<br></h4>
			На ящик указанный при регистрации направлено письмо с с кодом подтверждения платежа."
	. "В поле ниже вставьте полученный код и нажмите кнопку &quot;Подтвердить&quot;.<br>"
	. "<b>Если письмо не появилось в вашем почтовом ящике в течении 5 минут - проверте папку &quot;Спам&quot;.</b></p>"
	. "<input type='text' name='code'><button>подтвердить</button>"
	. "<input type='hidden' name='ammoumt' value='".$_POST['ammoumt']."'>"
	. "<input type='hidden' name='wallet' value='".$_POST['walet']."'>"
	. "<input type='hidden' name='packet' value='".$_POST['packet']."'>"
	. "<input type='hidden' name='gate' value='".$_POST['gate']."'>"
	. "<input type='hidden' name='uid' value='".$_SESSION['id']."'>"
	. "</fieldset></form>";

$html='<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0">
  <meta name="format-detection" content="telephone=no"><title>Подтверждение платежа</title>
  <style type="text/css">
table.vb-row.fullwidth {  border-spacing: 0;  padding: 0;}
table.vb-container.fullpad {  border-spacing: 18px;  padding-left: 0;  padding-right: 0;}
table.vb-container.fullwidth {  padding-left: 0;  padding-right: 0;}
.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div { line-height: 100%; }
.yshortcuts a {  border-bottom: none !important;}
.vb-outer {  min-width: 0 !important;}
.RMsgBdy,.ExternalClass {  width: 100%;  background-color: #3f3f3f;  background-color: #3f3f3f}
table {  mso-table-rspace: 0pt;  mso-table-lspace: 0pt;}
#outlook a {  padding: 0;}
img {  outline: none;  text-decoration: none;  border: none;  -ms-interpolation-mode: bicubic;}
a img {  border: none;}
@media screen and (max-device-width: 600px), screen and (max-width: 600px) {
table.vb-container,  table.vb-row {width: 95% !important;  }
.mobile-hide {display: none !important;}
.mobile-textcenter {text-align: center !important;  }
  .mobile-full {float: none !important;width: 100% !important;max-width: none !important;padding-right: 0 !important;padding-left: 0 !important;  }
  img.mobile-full {width: 100% !important;max-width: none !important;height: auto !important;  }
}
#ko_sideArticleBlock_3 .links-color a:visited, #ko_sideArticleBlock_3 .links-color a:hover {  color: #3f3f3f;  color: #3f3f3f;  text-decoration: underline;}
#ko_footerBlock_2 .links-color a:visited,#ko_footerBlock_2 .links-color a:hover {  color: #ccc;  color: #ccc;  text-decoration: underline;}
  </style>
</head>

<body alink="#cccccc" bgcolor="#3f3f3f" style="margin: 0;padding: 0;background-color: #3f3f3f;color: #919191;" text="#919191" vlink="#cccccc">
  <center>
<!-- preheaderBlock -->
<table class="vb-outer" style="background-color: #3f3f3f;" id="ko_preheaderBlock_1" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="100%">
  <tbody>
<tr>
  <td class="vb-outer" style="padding-left: 9px;padding-right: 9px;background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">
<div style="display: none; font-size: 1px; color: #333333; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"></div>
<!--[if (gte mso 9)|(lte ie 8)]>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
<div class="oldwebkit" style="max-width: 570px;">
  <table class="vb-row halfpad" style="border-collapse: separate;border-spacing: 0;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;background-color: #3f3f3f;" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="570">
<tbody>
  <tr>
<td style="font-size: 0; background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">
  <!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="552"><tr><![endif]-->
  <!--[if (gte mso 9)|(lte ie 8)]><td align="left" valign="top" width="276"><![endif]-->
  <div style="display: inline-block; max-width: 276px; vertical-align: top; width: 100%;" class="mobile-full">
<table class="vb-content" style="border-collapse: separate;width: 100%;" cellspacing="9" cellpadding="0" border="0" align="left" width="276">
  <tbody>
<tr>
  <td style="font-weight: normal; text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;" align="left" width="100%" valign="top"> </td>
</tr>
  </tbody>
</table>
  </div>
  <!--[if (gte mso 9)|(lte ie 8)]>
</td><td align="left" valign="top" width="276">
<![endif]-->
  <div style="display: inline-block; max-width: 276px; vertical-align: top; width: 100%;" class="mobile-full mobile-hide">
<table class="vb-content" style="border-collapse: separate;width: 100%;text-align: right;" cellspacing="9" cellpadding="0" border="0" align="left" width="276">
  <tbody>
<tr>
  <td style="font-weight: normal; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;" width="100%" valign="top"> </td>
</tr>
  </tbody>
</table>
  </div>
  <!--[if (gte mso 9)|(lte ie 8)]>
</td></tr></table><![endif]-->
</td>
  </tr>
</tbody>
  </table>
</div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
  </td>
</tr>
  </tbody>
</table>
<!-- /preheaderBlock -->
<table class="vb-outer" style="background-color: #bfbfbf;" id="ko_sideArticleBlock_3" cellspacing="0" cellpadding="0" border="0" bgcolor="#bfbfbf" width="100%">
  <tbody>
<tr>
  <td class="vb-outer" style="padding-left: 9px;padding-right: 9px;background-color: #bfbfbf;" bgcolor="#bfbfbf" align="center" valign="top">
<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
<div class="oldwebkit" style="max-width: 570px;">
  <table class="vb-row fullpad" style="border-collapse: separate;border-spacing: 9px;width: 100%;max-width: 570px;background-color: #fff;" cellspacing="9" cellpadding="0" border="0" bgcolor="#ffffff" width="570">
<tbody>
  <tr>
<td class="mobile-row" style="font-size: 0;" align="center" valign="top">
  <table class="vb-content" style="border-collapse: separate;width: 100%;" cellspacing="9" cellpadding="0" border="0" align="left" width="368">
<tbody>
  <tr>
<td style="font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;"> <span style="color: #3f3f3f;">Подтверждение платежа</span> </td>
  </tr>
  <tr>
<td class="long-text links-color" style="text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;" align="left">
  <p style="margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;"> Вы или кто-то другой заказал оплату из доступніх средств на сайте<br> <a href="http://finansicalservice.com" target="_blank" style="color: #3f3f3f;text-decoration: underline;">finansicalservice.com</a>. Для подтверждения платежа
скопируйте код ниже и вставьте егов форму на сайте.<br>ВНИМАНИЕ: КОД ДЕЙСТВИТЕЛЕН 2 ЧАСА!<br> </p>
  <h4>'.$code.'</h4> <br><br> <br> Если это были не вы - просто проигнорируйте это письмо<br>
  <p></p>
</td>
  </tr>
  <tr>
  </tr>
</tbody>
  </table>
  <div class="mobile-full" style="display: inline-block; max-width: 184px; vertical-align: top; width: 100%;"> </div>
</td>
  </tr>
</tbody>
  </table>
</div>
<!--[if (gte mso 9)|(lte ie 8)]></td>
<![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]>
<td align="left" valign="top" width="368">
<![endif]-->
<div class="mobile-full" style="display: inline-block; max-width: 368px; vertical-align: top; width: 100%;"> </div>
<!--[if (gte mso 9)|(lte ie 8)]></td>
<![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->
  </td>
</tr>
  </tbody>
</table>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
<!-- footerBlock -->
<table style="background-color: #3f3f3f;" id="ko_footerBlock_2" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="100%">
  <tbody>
<tr>
  <td style="background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">
<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
<div class="oldwebkit" style="max-width: 570px;">
  <table style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;" class="vb-container halfpad" cellspacing="9" cellpadding="0" border="0" align="center" width="570">
<tbody>
  <tr>
<td class="long-text links-color" style="text-align: center; font-size: 13px; color: #919191; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif;"></td>
  </tr>
</tbody>
  </table>
</div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
  </td>
</tr>
  </tbody>
</table>
<!-- /footerBlock -->
  </center>  </body>

</html>';
//print_r($_SESSION);
$mail=$_SESSION['email'];
$message=pismo("You payment code", $mail, $html);
else:
$code=$_POST['code'];
$a=hexToStr($code);
//print_r($a);

$preop="select * from payments_in where `paycode`='".$code."';";
//echo $preop;
$st=$dbc->get_result($preop);
if (isset($st[0]));
$qz="INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".$_SESSION['id']."', 'Покупка пакета из ".wIco($waletname)." кошелька', 'pay');";   
//echo $qz;
$dbc->query($qz);
//echo $dbc->lastState;

$dbc->query("UPDATE `payments_in` SET `status`='ok' WHERE  `paycode`='".$code."';");

$mref1=$_POST['ammoumt']*1;
$mref2=$_POST['ammoumt']*0.5;
$dbc->query("UPDATE `user_money` SET `refmoney` =`refmoney`+'".$mref1."' WHERE `id` = '".$_SESSION['apiKey']."';");
$dbc->query("UPDATE `user_money` SET `refmoney` =`refmoney`+'".$mref2."' WHERE `id` = '".getTopparent($_SESSION['apiKey'])."';");
$dbc->query("INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".$_SESSION['id']."', 'реферальные за покупку пакета ".$_SESSION['login']."', 'refmoney');");
$dbc->query("INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ('".getTopparent($_SESSION['apiKey'])."', 'реферальные за покупку пакета ".$_SESSION['login']."', 'refmoney');");

$dbc->query("INSERT INTO `user_fundation` (`user_id`, `fund_id`,`invest_summ`, `payments_period`) VALUES ('".$_SESSION['id']."', '".$_POST['packet']."','".$_POST['ammoumt']."', '15');");
//$_POST['ammoumt'];
$redirectTo=WWW_BASE_PATH."cabinet";
header('Location: ' . $redirectTo);
endif;



$template="blank";
include TEMPLATE_DIR.$template.".html";
}
