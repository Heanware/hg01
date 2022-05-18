<?php 
class Controller_UserLogin extends Controller{
	function __construct()
	{
		$this->view = new View;
		$this->model = new Model_UserLogin;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_index(){
		session_start();
		if($_POST){
			$userLogin = $_POST['userLogin'];
			$userPassword = $_POST['userPass'];
			$user = $this->model->getUser($this->connection, $userLogin, $userPassword);
			if($user != false){
				$data['ok'] = true;
				$_SESSION['login'] = $user['login'];
				$_SESSION['image'] = $user['image']; 
				$_SESSION['id'] = $user['id'];		
				$_SESSION['email'] = $user['email'];
				$_SESSION['number'] = $user['number'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['surname'] = $user['surname'];
				$_SESSION['status'] = $user['status'];
				$_SESSION['balance'] = $user['balance'];
				$_SESSION['theme'] = 'light';
				header('Location:'.isset($host).'cabinet');
			}else{
				$data['ok'] = false;
				$this->view->generate('userlogin_view.php', 'template_view.php', $data);
			}
		}else{
			$data['ok'] = true;
			$data['header'] = false;
			$data['theme'] = 'lignt';
			$this->view->generate('userlogin_view.php', 'template_view.php', $data);
		}
	}
}