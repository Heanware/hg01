<?php 
Class Controller_Payment extends Controller{
	function __construct(){
		session_start();
		$this->view = new View;
		$this->model = new Model_Payment;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		$this->data = array(
			'login' => $_SESSION['login'],
			'image' => $_SESSION['image'],
			'status' => $_SESSION['status'],
			'balance' => $_SESSION['balance'],
			'theme' => $_SESSION['theme'],
			'header' => true
		);
	}
	function action_index(){

	}
	function action_transfer(){
		$login = $this->data['login'];
		$user = explode('/', $_SERVER['REQUEST_URI'])[3];
		if ($_POST) {
			$count = $_POST['count'];
			$this->model->transfer($this->connection, $login, $user, $count);
			header('Location: /cabinet');
		}else{
			$this->data['user'] = $user;
			$this->view->generate('transfer_view.php', 'template_view.php', $this->data);
		}

	}	
	function action_history(){
		$login = $this->data['login'];
		$history = $this->model->getHistory($this->connection, $login);
		$this->data['history'] = $history;
		$this->view->generate('history_view.php', 'template_view.php', $this->data);
	}
	function action_request(){
		$sender = $this->data['login'];
		$taker = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->data['user'] = $taker;
		if ($_POST) {
			$count = $_POST['count'];
			$this->model->createRequest($this->connection, $sender, $taker, $count); 	
			header('Location: /cabinet');
		}else{
			$this->data['user'] = $taker;
			$this->view->generate('request_view.php', 'template_view.php', $this->data);
		}
	}
	function action_acceptMoneyRequest(){
		$taker = $this->data['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->acceptMoneyRequest($this->connection, $sender, $taker);
		header('Location: /cabinet');
	}
	function action_ignoreMoneyRequest(){
		$taker = $this->data['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->ignoreMoneyRequest($this->connection, $sender, $taker);
		header('Location: /cabinet');
	}
	function action_cancelMoneyRequest(){
		$taker = $this->data['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->cancelMoneyRequest($this->connection, $sender, $taker);
		header('Location: /cabinet');
	}
}