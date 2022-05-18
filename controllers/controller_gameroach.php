<?php
class Controller_GameRoach extends Controller{
	function __construct(){
		$this->view = new View;
		$this->model = new Model_GameRoach;	
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_findgame(){
		session_start();
		$id = explode('/', $_SERVER['REQUEST_URI'])[3];
		$data = array(
			'login' => $_SESSION['login'],
			'status' => $_SESSION['status'],
			'theme' => $_SESSION['theme'],
			'header' => true,
			'id' => $id
		);
		$this->view->generate('game_roach_view.php', 'template_view.php', $data);
	}
}