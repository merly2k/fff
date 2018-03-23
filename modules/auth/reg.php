<?php
//ini_set("display_errors", 1);
//error_reporting(99999);
if($_POST):
    $referer=  userRefID($this->_DATA['Referal']);
    saveUser($referer);
    endif;

function saveUser($referer=0) {
    
    $dbs=new db();
    
    extract($_POST);
$q="INSERT INTO `users` ("
	. " `login`,"
	. " `password`,"
	. " `role`,"
	. " `name`,"
	. " `fname`,"
	. " `email`,"
	. " `apiKey`,"
	. " `regDate`)"
	. " VALUES ("
	. "'$login',"
	. " MD5('$pass'),"
	. " '1',"
	. " '$fname',"
	. " '$lname',"
	. " '$mail',"
	. " '".$referer."'"
	. " ,"
	. " now()); "; 
$dbs->query($q);
$dbs->query("INSERT INTO `history` (`uid`, `sobytie`, `stype`) VALUES ((select id from users where login ='".$login."'), 'Регистрация', 'history');");
    
    $reflink=WWW_BASE_PATH.'flogin/'.strToHex("$login:$pass:".date(time() + strtotime('+1 day')));
    $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="initial-scale=1.0"><meta name="format-detection" content="telephone=no"><title>MOSAICO Responsive Email Designer</title><style type="text/css">.socialLinks {font-size: 6px;}
.socialLinks a {display: inline-block;}
.socialIcon {display: inline-block;vertical-align: top;padding-bottom: 0px;border-radius: 100%;}
table.vb-row.fullwidth {border-spacing: 0;padding: 0;}
table.vb-container.fullpad {border-spacing: 18px;padding-left: 0;padding-right: 0;}
table.vb-container.fullwidth {padding-left: 0;padding-right: 0;}</style><style type="text/css">
    /* yahoo, hotmail */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }
    .yshortcuts a{ border-bottom: none !important; }
    .vb-outer{ min-width: 0 !important; }
    .RMsgBdy, .ExternalClass{
      width: 100%;
      background-color: #3f3f3f;
      background-color: #3f3f3f}

    /* outlook */
    table{ mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
    #outlook a{ padding: 0; }
    img{ outline: none; text-decoration: none; border: none; -ms-interpolation-mode: bicubic; }
    a img{ border: none; }

    @media screen and (max-device-width: 600px), screen and (max-width: 600px) {
      table.vb-container, table.vb-row{
        width: 95% !important;
      }

      .mobile-hide{ display: none !important; }
      .mobile-textcenter{ text-align: center !important; }

      .mobile-full{
        float: none !important;
        width: 100% !important;
        max-width: none !important;
        padding-right: 0 !important;
        padding-left: 0 !important;
      }
      img.mobile-full{
        width: 100% !important;
        max-width: none !important;
        height: auto !important;
      }   
    }
  </style><style type="text/css">#ko_sideArticleBlock_3 .links-color a:visited, #ko_sideArticleBlock_3 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}
#ko_footerBlock_2 .links-color a:visited, #ko_footerBlock_2 .links-color a:hover {color: #ccc;color: #ccc;text-decoration: underline;}</style></head><body style="margin: 0;padding: 0;background-color: #3f3f3f;color: #919191;" bgcolor="#3f3f3f" alink="#cccccc" vlink="#cccccc" text="#919191">

  <center>

  <!-- preheaderBlock -->
  

  <table class="vb-outer" style="background-color: #3f3f3f;" id="ko_preheaderBlock_1" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="100%"><tbody><tr><td class="vb-outer" style="padding-left: 9px;padding-right: 9px;background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">
        <div style="display: none; font-size: 1px; color: #333333; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"></div>

<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
        <div class="oldwebkit" style="max-width: 570px;">
        <table class="vb-row halfpad" style="border-collapse: separate;border-spacing: 0;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;background-color: #3f3f3f;" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="570"><tbody><tr><td style="font-size: 0; background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">

<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="552"><tr><![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]><td align="left" valign="top" width="276"><![endif]--> 
<div style="display: inline-block; max-width: 276px; vertical-align: top; width: 100%;" class="mobile-full"> 
                    <table class="vb-content" style="border-collapse: separate;width: 100%;" cellspacing="9" cellpadding="0" border="0" align="left" width="276"><tbody><tr><td style="font-weight: normal; text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;" align="left" width="100%" valign="top">
                          <a style="text-decoration: underline; color: #ffffff;" target="_new" href="%5Bunsubscribe_link%5D">Unsubscribe</a> 
                          
                        </td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]>
</td><td align="left" valign="top" width="276">
<![endif]--><div style="display: inline-block; max-width: 276px; vertical-align: top; width: 100%;" class="mobile-full mobile-hide"> 

                    <table class="vb-content" style="border-collapse: separate;width: 100%;text-align: right;" cellspacing="9" cellpadding="0" border="0" align="left" width="276"><tbody><tr><td style="font-weight: normal; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;" width="100%" valign="top">
                      <span style="color: #ffffff; text-decoration: underline;">
                          <a href="%5Bshow_link%5D" style="text-decoration: underline; color: #ffffff;" target="_new">View in your browser</a>
                         </span>
                       </td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]>
</td></tr></table><![endif]-->

            </td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- /preheaderBlock --><table class="vb-outer" style="background-color: #bfbfbf;" id="ko_sideArticleBlock_3" cellspacing="0" cellpadding="0" border="0" bgcolor="#bfbfbf" width="100%"><tbody><tr><td class="vb-outer" style="padding-left: 9px;padding-right: 9px;background-color: #bfbfbf;" bgcolor="#bfbfbf" align="center" valign="top">

<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
        <div class="oldwebkit" style="max-width: 570px;">
        <table class="vb-row fullpad" style="border-collapse: separate;border-spacing: 9px;width: 100%;max-width: 570px;background-color: #fff;" cellspacing="9" cellpadding="0" border="0" bgcolor="#ffffff" width="570"><tbody><tr><td class="mobile-row" style="font-size: 0;" align="center" valign="top">

<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="552"><tr><![endif]-->

<!--[if (gte mso 9)|(lte ie 8)]><td align="left" valign="top" width="184"><![endif]--> 
<div class="mobile-full" style="display: inline-block; max-width: 184px; vertical-align: top; width: 100%;"> 

                    <table class="vb-content" style="border-collapse: separate;width: 100%;" cellspacing="9" cellpadding="0" border="0" align="left" width="184"><tbody><tr><td class="links-color" align="left" width="100%" valign="top">
                          
                            <img class="mobile-full" alt="" style="border: 0px;display: block;vertical-align: top;width: 100%;height: auto;max-width: 166px;" src="https://mosaico.io/srv/f-jcsre96/img?src=https%3A%2F%2Fmosaico.io%2Ffiles%2Fjcsre96%2Flogo-orange.png&amp;method=resize&amp;params=166%2Cnull" hspace="0" border="0" width="166" vspace="0"></td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]></td>
<![endif]--><!--[if (gte mso 9)|(lte ie 8)]>
<td align="left" valign="top" width="368">
<![endif]--><div class="mobile-full" style="display: inline-block; max-width: 368px; vertical-align: top; width: 100%;"> 

                    <table class="vb-content" style="border-collapse: separate;width: 100%;" cellspacing="9" cellpadding="0" border="0" align="left" width="368"><tbody><tr><td style="font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;">
                          <span style="color: #3f3f3f;">Подтверждение регистрации</span>
                        </td>
                      </tr><tr><td class="long-text links-color" style="text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;" align="left"><p style="margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;">Вы или ктото другой зарегистрировали аккаунт на сайте<br><a href="http://finansicalservice.com" target="_blank" style="color: #3f3f3f;text-decoration: underline;">finansicalservice.com</a>. Для подтверждения регистрации перейдите по ссылке ниже.<br>ВНИМАНИЕ: ССЫЛКА ДЕЙСТВИТЕЛЬНА 24 ЧАСА!<br><a href="'.$reflink.'">'.$reflink.'</a><br><br><br> Если это были не вы - просто проигнорируйте это письмо<br></p></td>
                      </tr><tr><td valign="top">
                          <table class="mobile-full" style="padding-top: 4px;" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; color: #3f3f3f; font-weight: normal; padding-left: 18px; padding-right: 18px; background-color: #bfbfbf; border-radius: 4px;" height="26" bgcolor="#bfbfbf" align="center" width="auto" valign="middle">
                                <a style="text-decoration: none; color: #3f3f3f; font-weight: normal;" target="_new" href="'.$reflink.'">перейти на сайт</a>
                              </td>
                            </tr></tbody></table></td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]></td>
<![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->

            </td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- footerBlock --><table style="background-color: #3f3f3f;" id="ko_footerBlock_2" cellspacing="0" cellpadding="0" border="0" bgcolor="#3f3f3f" width="100%"><tbody><tr><td style="background-color: #3f3f3f;" bgcolor="#3f3f3f" align="center" valign="top">

<!--[if (gte mso 9)|(lte ie 8)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]-->
        <div class="oldwebkit" style="max-width: 570px;">
        <table style="border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;" class="vb-container halfpad" cellspacing="9" cellpadding="0" border="0" align="center" width="570"><tbody><tr><td class="long-text links-color" style="text-align: center; font-size: 13px; color: #919191; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif;"><p style="margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;">Email sent to <a href="mailto:%5Bmail%5D" style="color: #ccc;text-decoration: underline;">[mail]</a></p></td>
          </tr><tr><td style="text-align: center;">
              <a href="%5Bunsubscribe_link%5D" style="text-decoration: underline; color: #ffffff; text-align: center; font-size: 13px; font-weight: normal; font-family: Arial, Helvetica, sans-serif;" target="_new"><span>Unsubscribe</span></a>
            </td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- /footerBlock --></center>

</body></html>
';
    
    $content="<form class='form-horizontal panel-body' style='background-color:#fcfcfc;padding:20px;'>
                            <fieldset class='' >
			    <p><h4>Регистрация завершена!</h4>
			    На ящик указанный при регистрации направлено письмо с ссылкой для активации Вашего аккаунта."
	    . "После перехода по ссылке вы можете войти в систему используя ваши учетные данные.<br>"
	    . "<b>Если письмо не появилось в вашем почтовом ящике в течении 5 минут - проверте папку &quot;Спам&quot;.</b></p>"
	    . "</fieldset></form>";
    $futter="<a href='".WWW_BASE_PATH."' class='btn btn-info'>Вернуться на сайт</a>";
    $message=pismo("You registered on the site http://finansicalservice.com", $mail, $html);
    
    $template="login";
    //echo $message;
include TEMPLATE_DIR.$template.".html";
}
?>
