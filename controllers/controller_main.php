<?php 
class Controller_Main extends Controller
{
	function __construct(){
		$this->model = new Model_Main;
		$this->view = new View;
		$this->databaseConnector = new databaseConnector; // создается экземпляр класса подключения к бд
		$this->connection = $this->databaseConnector->dbConnect(); // вызывается функция, чтобы получить переменную подключения к БД ($connection)
	}
	function action_index(){	
		session_start();
		$bestplayers = $this->model->getBestPlayers($this->connection);
		if($_SESSION){
			$data = array(
				'login' => $_SESSION['login'],
				'status' => $_SESSION['status'],
				'theme' => $_SESSION['theme'],
				'header' => true,
				'best' => $bestplayers
			);   
		}else{
			$data = array(
				'login' => null,
				'status' => null,
				'theme' => 'lignt',
				'header' => true,
				'best' => $bestplayers
			);
		}
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}