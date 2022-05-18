<?php
class databaseConnector{
	function dbConnect(){
		$config = array(
			'db' => array(
				'server' => 'localhost',
				'username' => 
				'password' => 
				'name' => 
			),
		);
		$connection = mysqli_connect(
			$config['db']['server'],
			$config['db']['username'],
			$config['db']['password'],
			$config['db']['name']
		);
		return $connection;
	}
}
