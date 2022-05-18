<?php 
class Controller_UserAdding extends Controller
{
	function __construct(){
		$this->model = new Model_UserAdding;
		$this->view = new View;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
	}
	function action_index(){	
		if($_POST){
			$userLogin = $_POST['userLogin'];
			$userPass = $_POST['userPass'];
			$userEmail = $_POST['userEmail'];
			$userImg = $_FILES['userImg']['name'];
			move_uploaded_file($_FILES['userImg']['tmp_name'], 'Templates/users_avatars/' . $userImg);
			$this->model->addUser($this->connection, $userLogin, $userPass, $userEmail, $userImg);
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
			header('Location:'.$host);
		}else{
			$data['header'] = false;
			$data['theme'] = $_SESSION['theme'];
			$this->view->generate('useradding_view.php', 'template_view.php');
		}
	}
}