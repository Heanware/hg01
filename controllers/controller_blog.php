<?php

class Controller_Blog extends Controller{

	function __construct(){
		$this->model = new Model_Blog;
		$this->view = new View;
		$this->databaseConnector = new databaseConnector;
		$this->connection = $this->databaseConnector->dbConnect();
	}
	function action_post(){
		$postId = explode('/', $_SERVER['REQUEST_URI'])[3];
		$currentPost = $this->model->getSinglePost($this->connection, $postId);
		$data = array(
			'logged' => '0',
			'currentPost' => $currentPost
		);
		$this->view->generate('blog_view.php', 'template_view.php', $data);
	}
}