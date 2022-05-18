<?php 
class Controller_Admin extends Controller
{
	function __construct(){
		$this->model = new Model_Admin;
		$this->view = new View;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
	}
	function action_index(){	
		session_start();
		$allFeed = $this->model->getAllFeedback($this->connection);
		$users = $this->model->getAllUsers($this->connection);
		$data = array(
			'allFeed' => $allFeed,
			'users' => $users,
			'login' => $_SESSION['login'],
			'status' => $_SESSION['status'],
			'theme' => $_SESSION['theme'],
			'header' => true
		);
		$this->view->generate('admin_view.php', 'template_view.php', $data);
	}
	function action_changeUserStatus(){
		if($_POST['status'] != ''){
			$status = $_POST['status'];
			$userId = $_POST['id'];
			$this->model->changeUserStatus($this->connection, $status, $userId);
		}
		header("Location: /admin");
	}
	function action_deleteFeedbackPost(){
		if($_POST['delete'] != ''){
			$id = $_POST['delete'];
			$this->model->deleteFeedbackPost($this->connection, $id);
		}
		header("Location: /admin");
	}
}