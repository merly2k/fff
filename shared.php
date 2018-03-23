<?php

function translit($string)
  { 
    $table = array( 
                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 
                'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 
                'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 
                'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 
                'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 
                'Ш' => 'SH', 'Щ' => 'SCH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '', 
                'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 
 
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 
                'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 
                'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 
                'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 
                'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 
    ); 
 
    $output = str_replace( 
        array_keys($table), 
        array_values($table),$string 
    ); 
 
    // таеже те символы что неизвестны
    $output = preg_replace('/[^-a-z0-9._\[\]\'"]/i', ' ', $output);
    $output = preg_replace('/ +/', '-', $output);
 
    return $output; 
}
function l($frase) {
    $lang = $_COOKIE['curlang'];
    switch ($lang) {
	case 'en':
	    $lang_file = 'en.php';
	    break;

	case 'ua':
	    $lang_file = 'ua.php';
	    break;

	case 'ru':
	    $lang_file = 'ru.php';
	    break;

	default:
	    $lang_file = 'en.php';
    }

    require 'languages/' . $lang_file;
//print_r($frases);

    return $frases[$frase];
}

function pismo($subject,$usermail,$html){

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "mail.finansicalservice.com"; // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "info@finansicalservice.com"; // SMTP account username example
$mail->Password   = "123123123qweqweqwe";        // SMTP account password example

$mail->From = $email;
$mail->FromName = $name;
$mail->setFrom('info@finansicalservice.com', 'Support of the FinansicalService');
$mail->addReplyTo('info@finansicalservice.com', 'Support of the FinansicalService');
$mail->addAddress($usermail, 'User');
$mail->Subject = $subject;
$mail->msgHTML($html);
$mail->AltBody = strip_tags($html,'');
$mail->send();
}

function strToHex($string){
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}
function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

?>
