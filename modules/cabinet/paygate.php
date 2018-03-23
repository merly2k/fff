<?php

//ini_set("display_errors", 1);
//error_reporting(99999);
extract($_POST);
$user = new mainUser();
$template = "newcab1";
$uid = $_SESSION['id'];
$context = '';
switch ($walet) {
    case "fs":
	$context = "<div class='container'>Оплата из средвств в системе</div>";
	$money = $user->getUserMoney();
	if ($money->money/100 >= $ammoumt):
	    $context.="<div class='card col-md-6'>   <div class='card-block'>
              <h4 class='card-title'>Оплатить с личного счёта</h4>
              <h4 class='card-subtitle'>$ammoumt $</h4>
              <h6 class='card-subtitle text-muted'>Доступно на личном счету: " . $money->money/100 . " $</h6>
		  <form action='".WWW_BASE_PATH."pay_code' method='post'>
		      <input type='hidden' name='walet' value='$walet'>
		      <input type='hidden' name='packet' value='$packet'>
		      <input type='hidden' name='ammoumt' value='$ammoumt'>
		      <input type='hidden' name='gate' value='pw'>
              <button type='submit'>Оплатить</button></form>
              </div>
          </div>
	  </div>";
	endif;
	if ($money->refmoney/100 >= $ammoumt):
	$context.="<div class='card col-md-6'>   <div class='card-block'>
              <h4 class='card-title'>Оплатить с реферального счёта</h4>
	      <h4 class='card-subtitle'>$ammoumt $</h4>
              <h6 class='card-subtitle text-muted'>Доступно на реферальном счету: " . $money->refmoney/100 . " $</h6>
		  <form action='".WWW_BASE_PATH."pay_code' method='post'>
		      <input type='hidden' name='walet' value='$walet'>
		      <input type='hidden' name='packet' value='$packet'>
		      <input type='hidden' name='ammoumt' value='$ammoumt'>
		      <input type='hidden' name='gate' value='rw'>
              <button type='submit'>Оплатить</button></form>
	      </div>
          </div>
	  </div>";
	//$context.=print_r($_POST,true);
	endif;

	break;
    case "prefectmoney" :
	$context = "<div class='panel'>Оплата при помощи Perfect Money"
		. '
<form action="https://perfectmoney.is/api/step1.asp" method="POST">
<input type="hidden" name="PAYEE_ACCOUNT" value="U13071786">
<input type="hidden" name="PAYEE_NAME" value="FinansikalService">
<input type="hidden" name="PAYMENT_ID" value="'.$_SESSION['id'].'">
<input type="hidden" name="PAYMENT_AMOUNT" value="' . $ammoumt . '"><BR>
<input type="hidden" name="PAYMENT_UNITS" value="USD">
<input type="hidden" name="STATUS_URL" value="'.WWW_BASE_PATH.'cabinet/pmstatus/">
<input type="hidden" name="PAYMENT_URL" value="'.WWW_BASE_PATH.'cabinet/pmsuccess/">
<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="NOPAYMENT_URL" value="'.WWW_BASE_PATH.'cabinet/pay_error/">
<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="SUGGESTED_MEMO" value="' . $packet . '">
<input type="hidden" name="uid" value="' . $uid . '">
<input type="hidden" name="BAGGAGE_FIELDS" value="' . $packet . '">
<input type="submit" name="PAYMENT_METHOD" value="Pay Now!">
</form>		    
</div>';
	break;
    case "payeer" :

$m_shop = '359260369';
$m_orderid = '1';
$m_amount = number_format(100, 2, '.', '');
$m_curr = 'USD';
$m_desc = base64_encode("$packet");
$m_key = 'YwrZ8MvN3ZMmLjQs';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc
);


$arParams = array(
	'success_url' => WWW_BASE_PATH.'cabinet/money/payer/success/',
	'fail_url' => WWW_BASE_PATH.'cabinet/money/payer/fail/',
	'status_url' => WWW_BASE_PATH.'cabinet/money/payer/',
	'reference' => array(
		'var1' => '1',
		//'var2' => '2',
		//'var3' => '3',
		//'var4' => '4',
		//'var5' => '5',
	),
);

$key = md5('YwrZ8MvN3ZMmLjQs'.$m_orderid);

$m_params = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, json_encode($arParams), MCRYPT_MODE_ECB)));

$arHash[] = $m_params;


$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));
$context="
<div class='container'>
<div class='panel'>Оплата при помощи Payer
<form method='post' action='https://payeer.com/merchant/'>
<input type='hidden' name='m_shop' value='".$m_shop."'>
<input type='hidden' name='m_orderid' value='".$m_orderid."'>
<input type='hidden' name='m_amount' value='".$m_amount."'>
<input type='hidden' name='m_curr' value='".$m_curr."'>
<input type='hidden' name='m_desc' value='".$m_desc."'>
<input type='hidden' name='m_sign' value='".$sign."'>
<input type='hidden' name='form[ps]' value='2609'>
<input type='hidden' name='form[curr[2609]]' value='USD'>
<button type='submit' name='m_process'>Оплатить</button>
</form>
    </div>
</div>";


	break;
    case "bitcoin" :
	$context = 'Оплата пакета. Вы собрались купить пакет на сумму '.$ammoumt.'$
	    <form method="GET" action="https://api.cryptonator.com/api/merchant/v1/startpayment">
	    <input type="hidden" name="merchant_id" value="950d970ac2b36bf8e57bef92c8fa74d1">
	    <input type="hidden" name="item_name" value="Пакет '.$packet.'" readonly>
	    <input type="hidden" name="invoice_currency" value="usd">
	    <input type="hidden" name="invoice_amount" value="'.$ammoumt.'" data-type="number">
	    <input type="hidden" name="language" value="ru">
	    <input type="hidden" name="success_url" value="https://finansicalservice.com/cabinet/money/bitcoin/success">
	    <input type="hidden" name="failed_url" value="https://finansicalservice.com/cabinet/money/bitcoin/fail">
	    <input type="submit" value="Оплатить криптовалютой">
	    </form>';

	break;
    case "advcash" :
	$context.="<div class='container'>"
	    . "<div class='card'>"
	    . "<div class='card-header'>Оплата через ADVCASH</div>"
		. "<form action='" . WWW_BASE_PATH . "cabinet/money/advcash/send' method='post'>
<p>E-mail счета-отправителя, с которого будут списаны средства.:
<input type='text' name='mail' value='' /></p>
<p>Сумма к переводу : <input type='text' name='AMOUNT' value='$ammoumt' readonly/></p>
<p>Комментарии к переводу: <input type='text' name='MEMO' value='Покупка пакета' /></p>
 <p><input type='submit' /></p>
</div>
</form></div>";

	$context.="";
	break;
    case "nix" :
	$context = "<br>";
	extract($_POST);
	$context.="<div class='container'><div class='card'><div class='card-header'>Оплата через NixMoney</div>"
		. "<form action='" . WWW_BASE_PATH . "cabinet/money/nix/send' method='post'>
<p>Пароль для доступа в личный кабинет (счета-отправителя): <input type='text' name='PASSPHRASE' value='pasw'/></p>
<p>Номер Вашего счета-отправителя, с которого будут списаны средства.:
<input type='text' name='PAYER_ACCOUNT' value='' /></p>
<input type='hidden' name='PAYEE_ACCOUNT' value='U51395892824472' />
<p>Сумма к переводу : <input type='text' name='AMOUNT' value='$ammoumt' readonly/></p>

<p>Комментарии к переводу: <input type='text' name='MEMO' value='Покупка пакета' /></p>

 <p><input type='submit' /></p>
</div>
</form></div>";

	break;
    case "qiwi" :
	$Qiwi = new qiwi();
	// Создаем экземпляр класса
	$context = "<div class='container'>Оплата через QIWI</div>";

// CОЗДАНИЕ СЧЕТА

	$bill_id = rand(10000000, 99999999);

	$create_result = $Qiwi->create(
		'79001234567', // телефон
		100, // сумма
		date('Y-m-d', strtotime(date('Y-m-d') . " + 1 DAY")) . "T00:00:00", // Дата в формате ISO 8601. Здесь генерируется дата на день позже, чем текущая
		$bill_id, // ID платежа
		'Тестовая оплата' // комментарий
	);

	if ($create_result->result_code !== 0) {
	    $context.='Ошибка в создании счета';
	}

// ПЕРЕАДРЕСАЦИЯ НА СТРАНИЦУ ОПЛАТЫ
	echo 2;
	$Qiwi->redir(
		$bill_id, // ID счета
		WWW_BASE_PATH . '/cabinet/paygate' . '/success_url', // URL, на который пользователь будет переброшен в случае успешного проведения операции (не обязательно)
		WWW_BASE_PATH . '/cabinet/paygate' . '/fail_url' // URL, на который пользователь будет переброшен в случае неудачного завершения операции (не обязательно)
	);


// ПОЛУЧЕНИЕ ИНФОРМАЦИИ О СЧЕТЕ

	$info_result = $Qiwi->info($bill_id);

	if ($info_result->result_code !== 0)
	    echo 'Ошибка в получении информации о счете';
	else
	    echo 'Статус счета: ' . $info_result->bill->status;


// ОТМЕНА СЧЕТА (не должна вызываться после redir(), иначе счет отменяется до того, как появится возможность оплатить его.
// Отмена должна происходить на другой странице, например на тех, которые указываются в success или fail url)

	$reject_result = $Qiwi->reject($bill_id);

	if ($reject_result->bill->status === 'rejected')
	    echo 'Не удалось отменить счет';
	else
	    echo 'Счет отменен';
	break;
    case "self" :
	break;
    default:
	break;
}


include TEMPLATE_DIR . DS . $template . ".html";
