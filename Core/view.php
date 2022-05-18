<?php
class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	function generate($content_view, $template_view, $data = null) //Запихивает вывод в шаблон и выводит пользователю
	{
		if(is_array($data)) {
		// преобразуем элементы массива в переменные
			extract($data);
		}


		include 'views/'.$template_view;
	}
}