<?php
const SECRET_KEY = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6Im1zaWVudS0wMCIsInVzZXJfaWQiOiI3OTIyMDUyNjg3OCIsInNlY3JldCI6ImZkNTRhZDM0OGYwYzg0YTQ1NDFmY2Y2NWQzYTBhNWNiZDdkNGJjYmM0Yjg4YjJiZjdlMDNiZDViOGIyNTI0ZGQifX0=';
const SITE_ID = 'msienu-00';
require __DIR__ . '/autoload.php';
$billPayments = new Qiwi\Api\BillPayments(SECRET_KEY);	
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$validSignatureFromNotificationServer = $_SERVER['HTTP_X_API_SIGNATURE_SHA256'];
$notificationData = [
	'bill' => [
		'siteId' => SITE_ID,
		'billId' => $decoded['bill']['billId'],
		'amount' => ['value' => $decoded['bill']['amount']['value'], 'currency' => $decoded['bill']['amount']['currency']],
		'status' => ['value' => 'PAID']
	],
	'version' => '3'
];
$merchantSecret = SECRET_KEY;
$check = $billPayments->checkNotificationSignature($validSignatureFromNotificationServer, $notificationData, $merchantSecret); 
//Ответ
if($check === true){
	$error = array('response' => 'OK');
	error_log('all fine');
}else{
	$error = array('response' => 'error');
	error_log('got an error');
}
header('Content-Type: application/json');
$jsonres = json_encode($error);
echo $jsonres;
