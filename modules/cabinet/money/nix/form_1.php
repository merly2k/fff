<?PHP
echo "

<form action='https://www.nixmoney.com/merchant.jsp' method='post'>
 
<p><input type='hidden' name='PAYEE_ACCOUNT' value='U51395892824472'/></p>

<p><input type='hidden' name='PAYEE_NAME' value='paket 1' /></p>

<p><input type='hidden' name='PAYMENT_AMOUNT' value='1' /></p>

<p><input type='hidden' name='PAYMENT_URL' value='".WWW_BASE_PATH."cabinet/money/nix/ok.php' /></p>

<p><input type='hidden' name='NOPAYMENT_URL' value='".WWW_BASE_PATH."cabinet/money/nix/no.php' /></p>

<p>BAGGAGE_FIELDS Перечисленные через пробел поля, которые необходимо
передать во все подтверждающие URL: STATUS_URL,
PAYMENT_URL, NOPAYMENT_URL (например: «NAME
SOMEFIELD ANY»): any <input type='hidden' name='BAGGAGE_FIELDS' /></p>
  
<p><input type='hidden' name='PAYMENT_ID' /></p>

<p><input type='hidden' name='STATUS_URL' value='".WWW_BASE_PATH."cabinet/money/nix/status.php' /></p>

<p><input type='hidden' name='SUGGESTED_MEMO' value='".$_POST['code']."' /></p>

 <p><input type='submit' /></p>
</form>";
