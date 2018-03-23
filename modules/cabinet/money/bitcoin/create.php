<?php
ini_set("display_errors", 1);
error_reporting(9999);
$invoice_id=$this->param[1];
//Proxy to the api/receive method in order to not reveal the callback URL

include 'include.php';

$db = new mysqli($mysql_host, $mysql_username, $mysql_password) or die(__LINE__ . ' Invalid connect: ' . mysqli_error());
$db->select_db($mysql_database) or die( "Unable to select database. Run setup first.");


$callback_url = WWW_BASE_PATH . "cabiner/money/bitcoin/callback/invoice_id/". $invoice_id ."/" . $secret;

$resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);
$response = json_decode($resp);


//Add the invoice to the database
$stmt = $db->prepare("UPDATE invoices SET address = ? WHERE invoice_id = ?");
$stmt->bind_param("si", $response->address, $invoice_id);
$result = $stmt->execute();

if (!$result) {
    die(__LINE__ . ' Invalid query: ' . mysqli_error($db));
}

print json_encode(array('input_address' => $response->address ));


?>