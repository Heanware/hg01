<?php

class Controller_404 extends Controller
{

	function action_index()
	{
		session_start();
		if($_SESSION){
			$data = array(
				'login' => $_SESSION['login'],
				'status' => $_SESSION['status'],
				'theme' => $_SESSION['theme'],
				'header' => true
			);
		}else{
			$data = array(
				'login' => null,
				'status' => null,
				'theme' => 'lignt',
				'header' => true
			);
		}
		$this->view->generate('404_view.php', 'template_view.php', $data);
	}
}