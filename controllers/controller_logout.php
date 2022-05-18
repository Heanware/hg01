<?php 
Class Controller_Logout extends Controller{
	function __construct()
	{
		$this->view = new View;
		$this->model = new Model_Logout;
	}
	function action_index(){
		session_start();
		session_destroy();
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('Location:'.$host);
	}
}