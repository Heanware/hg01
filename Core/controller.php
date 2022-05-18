<?php
class Controller{
	public $model;
	public $view;
	public $databaseConnector;
	public $connection;
	public $server;
	public $headersSender;
	public $data;
	function __construct()
	{
		$this->view = new View;
	}
	function action_index()
	{

	}
}