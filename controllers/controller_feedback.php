<?php
class Controller_Feedback extends Controller{
	function __construct(){
		$this->view = new View;
		$this->model = new Model_Feedback;	
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
		$this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	function action_index(){

		session_start();
		$data = array(
			'header' => true,
			'theme' => $_SESSION['theme'],
			'status' => $_SESSION['status']
		);
		
		if(!$_POST)
		{
			$this->view->generate('feedback_view.php', 'template_view.php', $data);
		}
		else if($_POST['reviewStars'] != '' && $_POST['feedback-text'] != '')
		{
			$login = $_SESSION['login'];
			$feedback_post = strip_tags((string)$_POST['feedback-text']);
			$review = $_POST['reviewStars'];
			$feedback = $this->model->getFeedback($this->connection, $login, $feedback_post, $review);
			header('Location:'.$this->host.'cabinet');
		}
		else
		{
			$this->view->generate('feedback_view_error.php', 'template_view.php', $data);
		}
	}// доделать страницу благодарности за отзыв
}