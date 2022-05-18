<?php
class databaseConnector{
	function dbConnect(){
		$config = array(
			'db' => array(
				'server' => 'localhost',
				'username' => 'hg_01company_usr',
				'password' => 'JlPbpXAyxhTt150U',
				'name' => 'hg_01company__db',
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
