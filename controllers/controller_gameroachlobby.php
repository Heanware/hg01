<?php 
class Controller_GameRoachLobby extends Controller{
	function __construct(){
		$this->view = new View;
		$this->model = new Model_GameRoachLobby;	
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_index(){
		session_start();
		if(isset($_POST['bet'])){
			$id = $this->model->createRequest($this->connection, $_POST['bet'], $_SESSION['login']);
			header("Location:" .$host.'gameroach/findgame/'.$id);
		}
		if(isset($_SESSION['login'])){
			$gamesRequests = $this->model->getRequests($this->connection);
			$data = array(
				'login' => $_SESSION['login'],
				'status' => $_SESSION['status'],
				'requests' => $gamesRequests,
				'theme' => $_SESSION['theme'],
				'header' => true
			);
			$this->view->generate('gameroachlobby_view.php', 'template_view.php', $data);
		}else{
			header('Location:'.$this->host);
			exit();
		}

	}
}	