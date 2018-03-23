<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('max_execution_time', 0);
//print_r($_POST);
require_once("MerchantWebService.php");
$merchantWebService = new MerchantWebService();

$arg0 = new authDTO();
$arg0->apiName = "finservice";
$arg0->accountEmail = $_POST['mail'];
$arg0->authenticationToken = $merchantWebService->getAuthenticationToken("ltyrjgsnfvbcnexbn123");

$arg1 = new sendMoneyRequest();
$arg1->amount = $_POST['AMOUNT'];
$arg1->currency = "USD";
$arg1->email = "merly2k@gmail.com";
$arg1->walletId = "U217088769683";
$arg1->note = "Покупка пакета";
$arg1->savePaymentTemplate = false;

$validationSendMoney = new validationSendMoney();
$validationSendMoney->arg0 = $arg0;
$validationSendMoney->arg1 = $arg1;

$sendMoney = new sendMoney();
$sendMoney->arg0 = $arg0;
$sendMoney->arg1 = $arg1;

try {
    $merchantWebService->validationSendMoney($validationSendMoney);
    $sendMoneyResponse = $merchantWebService->sendMoney($sendMoney);

    echo print_r($sendMoneyResponse, true)."<br/><br/>";
    echo $sendMoneyResponse->return."<br/><br/>";
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>