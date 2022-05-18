<?php
class Controller_Cabinet extends Controller{
	function __construct(){
		$this->view = new View;
		$this->model = new Model_Cabinet;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_index(){
		session_start();
		$login = $_SESSION['login'];
		$user = $this->model->getUser($this->connection, $login);
		$request = $this->model->getMoneyRequest($this->connection, $login);
		$request_avatars = [];
		foreach ($request as $image_request) {
			$request_ava = $image_request['sender'];
			$request_avatar = $this->model->getMoneyRequestAvatar($this->connection, $request_ava);
			array_push($request_avatars, $request_avatar['0']['image']);
		}
			$data = array(
			'login' => $user['login'],
			'name' => $user['name'],
			'surname' => $user['surname'],
			'number' => $user['number'],
			'email' => $user['email'],
			'image' => $user['image'],
			'id' => $user['id'],
			'status' => $user['status'],
			'balance' => $user['balance'],
			'theme' => $_SESSION['theme'],
			'user' => true,
			'header' => true,
			'friendRequest' => null,
			'request' => $request,
			'request_avatar' => $request_avatars,
		);
		$this->view->generate('cabinet_view.php', 'template_view.php', $data);
	}
	function action_user(){
		session_start();
		$user = explode('/', $_SERVER['REQUEST_URI'])[3];	
		$selected = $this->model->getUser($this->connection, $user);
		$login = $_SESSION['login'];
		$user = $selected['login'];
		$friendRequest = $this->model->getRequest($this->connection, $login, $user);
		if($user == $_SESSION['login']){
			$data = array(
				'login' => $_SESSION['login'],
				'name' => $_SESSION['name'],
				'surname' => $_SESSION['surname'],
				'phone' => $_SESSION['phone'],
				'email' => $_SESSION['email'],
				'image' => $_SESSION['image'],
				'id' => $id,
				'status' => $_SESSION['status'],
				'balance' => $_SESSION['balance'],
				'theme' => $_SESSION['theme'],
				'user' => true,
				'header' => true,
				'friendRequest' => null
			);
		}else{		
			$data = array(
				'login' => $selected['login'],
				'name' => $selected['name'],
				'surname' => $selected['surname'],
				'phone' => $selected['number'],
				'email' => $selected['email'],
				'image' => $selected['image'],
				'id' => $user,
				'status' => $_SESSION['status'],
				'theme' => $_SESSION['theme'],
				'balance' => null,
				'header' => true,
				'user' => false,
				'friendRequest' => $friendRequest
			);
			$_SESSION['selected'] = $selected['login'];
		}
		$this->view->generate('cabinet_view.php', 'template_view.php', $data);
	}
	function action_userredact(){
		session_start();
		$login = $_SESSION['login'];
		$user = $this->model->getUser($this->connection, $login);
		$request = $this->model->getMoneyRequest($this->connection, $login);
		$data = array(
			'login' => $_SESSION['login'],
			'name' => $_SESSION['name'],
			'surname' => $_SESSION['surname'],
			'number' => $_SESSION['number'],
			'email' => $_SESSION['email'],
			'image' => $_SESSION['image'],
			'id' => $_SESSION['id'],
			'status' => $_SESSION['status'],
			'balance' => $user['balance'],
			'theme' => $_SESSION['theme'],
			'user' => true,
			'header' => true,
			'friendRequest' => null,
			'request' => $request,
		);
		if($_POST){
			$infoRedact = [];
			if($_POST['name']){
				$infoRedact['name'] = $_POST['name'];
			}
			if($_POST['surname']){
				$infoRedact['surname'] = $_POST['surname'];
			}	
			if($_POST['email']){
				$infoRedact['email'] = $_POST['email'];
			}	
			if($_POST['number']){
				$infoRedact['number'] = $_POST['number'];
			}
			$infoRedact['login'] = $login;
			$this->model->redactInfo($this->connection, $infoRedact);
			$data['redact'] = false;
			header("Location: "."http://hg.01company.ru/cabinet/");
		}else{
			$data['redact'] = true;
			$this->view->generate('cabinet_view.php', 'template_view.php', $data);
			exit();
		}
	}
	function action_imageredact(){
		session_start();
		$login = $_SESSION['login'];
		$user = $this->model->getUser($this->connection, $login);
		$request = $this->model->getMoneyRequest($this->connection, $login);
		$data = array(
			'login' => $_SESSION['login'],
			'name' => $_SESSION['name'],
			'surname' => $_SESSION['surname'],
			'number' => $_SESSION['number'],
			'email' => $_SESSION['email'],
			'image' => $_SESSION['image'],
			'id' => $_SESSION['id'],
			'status' => $_SESSION['status'],
			'balance' => $user['balance'],
			'theme' => $_SESSION['theme'],
			'user' => true,
			'header' => true,
			'friendRequest' => null,
			'request' => $request,
		);
		if($_FILES){
			$userImg = $_FILES['userImg']['name'];
			$old_avatar = $this->model->deleteOldAvatar($this->connection, $login);
			unlink('Templates/users_avatars/' . $old_avatar);
			move_uploaded_file($_FILES['userImg']['tmp_name'], 'Templates/users_avatars/' . $userImg);
			$this->model->updateAvatar($this->connection, $userImg, $login);
			$data['avatar_redact'] = false;
			header("Location: "."http://hg.01company.ru/cabinet/");
			exit();
		}else{
			$data['avatar_redact'] = true;
			$this->view->generate('cabinet_view.php', 'template_view.php', $data);
			exit();
		}
	}
	function action_light(){
		session_start();
		$_SESSION['theme'] = 'light';
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
	function action_dark(){
		session_start();
		$_SESSION['theme'] = 'dark';
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
}