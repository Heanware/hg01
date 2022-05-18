<?php
const SECRET_KEY = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6Im1zaWVudS0wMCIsInVzZXJfaWQiOiI3OTIyMDUyNjg3OCIsInNlY3JldCI6ImZkNTRhZDM0OGYwYzg0YTQ1NDFmY2Y2NWQzYTBhNWNiZDdkNGJjYmM0Yjg4YjJiZjdlMDNiZDViOGIyNTI0ZGQifX0=';
const SITE_ID = 'msienu-00';
class Controller_Balance extends Controller
{
	function __construct(){
		$this->model = new Model_Balance;
		$this->view = new View;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
	}
	function action_index(){
		$referer = $_SERVER['HTTP_REFERER'];
		session_start();
		$data = array(
			'login' => $_SESSION['login'],
			'status' => $_SESSION['status'],
			'theme' => $_SESSION['theme'],
			'header' => true,
			'referer' => $referer
		);
		$this->view->generate('balance_view.php', 'template_view.php', $data);
	}
	function action_bill(){
		if(isset($_POST['sum'])){
			if($_POST['sum'] != ''){
				session_start();
				$time = date(DATE_ATOM, time() + (24*60*60));
				$billPayments = new Qiwi\Api\BillPayments(SECRET_KEY);	
				$billId = $billPayments->generateId();
				$publicKey = '48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPugGwGbZNK63g4d8zWFqjEjFrFtZq8JwrMGwMtuLq5h9MZbrd8JYcRPUvbtT7ER1cfpVjybNnF1qqisanWNEvFUgBjUMMP6ak8ciaHs6PB';
				$fields = [
					'amount' => (int)$_POST['sum'],
					'currency' => 'RUB',
					'comment' => $_SESSION['login'],
					'expirationDateTime' => $time,
					'email' => $_SESSION['email'],
					'account' => $_SESSION['login'],
					'phone' => $_SESSION['number'],
					"customFields" => [ 
						"themeCode" => "Andrei-PE0Kqdmdbu"
					],
				];
				$response = $billPayments->createBill($billId, $fields);
				header('Location: ' . $response['payUrl'] . '&paySource=qw');
			}else{
				header('Location: /');
			}
		}
	}
	function action_checkout(){
		if(isset($_SERVER['HTTP_X_API_SIGNATURE_SHA256'])){
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
			if($check === true){
				$checked = $this->model->checkProcessedNotification($this->connection, $decoded['bill']['billId']);
				if($checked == false){
					$this->model->addMoney($this->connection, $decoded['bill']['comment'], $decoded['bill']['amount']['value'], $decoded['bill']['billId']);	
					$error = array('response' => 'OK');
					error_log('all fine');
				}else{
					error_log('twiced notification');
				}
			}else{
				$error = array('response' => 'error');
			}
			header('Content-Type: application/json');
			$jsonres = json_encode($error);
			echo $jsonres;
		}
	}
}