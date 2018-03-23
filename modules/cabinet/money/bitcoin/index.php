<?php
//ini_set("display_errors", 1);
include 'include.php';

$invoice_id = 9001;
$price_in_usd = 150.15;
$product_url = 'nutbolt.jpg';
$price_in_btc = file_get_contents($blockchain_root . "tobtc?currency=USD&value=" . $price_in_usd);

$db = new mysqli($mysql_host, $mysql_username, $mysql_password) or die(__LINE__ . ' Invalid connect: ' . mysqli_error());

$db->select_db($mysql_database) or die( "Unable to select database. Run setup first.");

//Add the invoice to the database
$stmt = $db->prepare("replace INTO invoices (invoice_id, price_in_usd, price_in_btc, product_url) values(?,?,?,?)");
$stmt->bind_param("idds",$invoice_id, $price_in_usd, $price_in_btc, $product_url);
$result = $stmt->execute();

if (!$result) {
    die(__LINE__ . ' Invalid query: ' . mysqli_error($db));
}

$template="newcab1";
 $context="
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js'></script>
    <script type='text/javascript' src='".$blockchain_root."Resources/js/pay-now-button-v2.js'></script>
    
    <script type='text/javascript'>
	$(document).ready(function() {
		$('.stage-paid').on('show', function() {
			window.location.href = '/cabinet/money/bitcoin/order_status/invoice_id/".$invoice_id ."';
		});
	});
	</script>
</head>
    <body>
       <h1>Оплата пакета в Биткоин</h1>
       ".$price_in_usd."$ равноценно ".$price_in_btc."<b class='fa fa-btc'></b>

        <div class='blockchain-btn' style='width:auto' data-create-url='".WWW_BASE_PATH."cabinet/money/bitcoin/create/invoice_id/$invoice_id'> 
            <div class='blockchain stage-begin'>
                <img src='".WWW_IMAGE_PATH."pay_now_64.png'>
            </div>
            <div class='blockchain stage-loading' style='text-align:center'>
                <img src='".$blockchain_root ."loading-large.gif'>
            </div>
            <div class='blockchain stage-ready' style='text-align:center'>
                Please send ".$price_in_btc ." BTC to <br /> <b>[[address]]</b> <br />
                <div class='qr-code'></div>
            </div>
            <div class='blockchain stage-paid'>
                Payment Received <b>[[value]] BTC</b>. Thank You.
            </div>
            <div class='blockchain stage-error'>
                <font color='red'>[[error]]</font>
            </div>
        </div>
";
    include TEMPLATE_DIR . DS . $template . ".html";