<?php 
class Controller_PostAdding extends Controller{
	function __construct()
	{
		$this->view = new View;
		$this->model = new Model_PostAdding;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
	}
	function action_index(){
		if($_POST){
			session_start();
			$postTitle = $_POST['title'];
			$postDescription = $_POST['description'];
			$postText = $_POST['text'];
			$postImage = $_POST['image'];
			$author = $_SESSION['login'];
			$this->model->addPost($this->connection, $postTitle, $postDescription, $postText, $postImage, $author);
			$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
			header('Location:'.$host);
		}else{
			var_dump($_POST);
			$this->view->generate('postadding_view.php', 'template_view.php');
		}
		
	}
}