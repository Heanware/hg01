<?php 
class Controller_Friends extends Controller{
	function __construct(){
		$this->view = new View;
		$this->databaseConnector = new databaseConnector;
		$this->model = new Model_Friends;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_index(){
		session_start();
		$data['theme'] = $_SESSION['theme'];
		$data['status'] = $_SESSION['status'];
		$data['header'] = true;
		$login = $_SESSION['login'];
		$request = $this->model->getRequest($this->connection, $login);
		$friendsInfo = $this->model->getFriends($this->connection, $login);
		$data['request'] = $request;
		$data['friendsInfo'] = $friendsInfo;
		$data['login'] = $login;
		$this->view->generate('friends_view.php', 'template_view.php', $data);
	}
	function action_add(){
		session_start();
		$sender = $_SESSION['login'];
		$taker = explode('/', $_SERVER['REQUEST_URI'])[3];
		if($sender != ''){
			$this->model->createRequest($this->connection, $sender, $taker); 	
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
		}
	}
	function action_accept(){
		session_start();
		$taker = $_SESSION['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->createFriend($this->connection, $taker, $sender);
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
	function action_ignore(){
		session_start();
		$taker = $_SESSION['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->ignoreFriend($this->connection, $taker, $sender);
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
	function action_cancel(){
		session_start();
		$taker = $_SESSION['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->cancelFriend($this->connection, $taker, $sender);
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
	function action_delete(){
		session_start();
		$taker = $_SESSION['login'];
		$sender = explode('/', $_SERVER['REQUEST_URI'])[3];
		$this->model->deleteFriend($this->connection, $taker, $sender);
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
}