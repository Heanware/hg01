<?php
class Route
{
	static function start()
	{
		$controller_name = 'Main'; // default переменные
		$action_name = 'index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1]; //получение названия контроллера
		}
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];//получение названия модели
		}
		$model_name = 'Model_'.$controller_name;// 
		$controller_name = 'Controller_'.$controller_name;// формируются названия для классов(модель и контроллер), и название для действия (action)
		$action_name = 'action_'.$action_name;// 
		$model_file = strtolower($model_name).'.php'; // приведение названий к удобному виду
		$model_path = "models/".$model_file; // приведение названий к удобному виду
		if(file_exists($model_path))
		{
			include "models/".$model_file; // поиск файлов в папках, с нужными названиями
		}
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "controllers/".$controller_file; // поиск файлов в папках, с нужными названиями
		}
		else
		{
			Route::ErrorPage404(); // если ничего не найдено - выводится 404 
		}
		if (class_exists($controller_name)) {
			$controller = new $controller_name; // формируются названия для контроллера и действия
				$action = $action_name; // формируются названия для контроллера и действия
				if(method_exists($controller, $action)){
			$controller->$action(); // вызов того самого контроллера и действия в нем (функции)
		}
		else
		{
			Route::ErrorPage404();
		}	
	}


	

}
function ErrorPage404()
{
	$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	header('HTTP/1.1 404 Not Found');
	header("Status: 404 Not Found");
	header('Location:'.$host.'404');
}
}