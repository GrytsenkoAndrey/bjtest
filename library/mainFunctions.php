<?php
/**
* формирование запрашиваемой страницы
* @param object
* @param string controllerName название контроллера
* @param string actionName название действия
* @param resource $db 
* @param array $params
*/
function loadPage($smarty, $db, string $controllerName, string $actionName, array $params)
{
    require_once PATH_PREFIX. $controllerName .PATH_POSTFIX;

    $function = $actionName .'Action';
    $function($smarty, $db, $params);
}

/**
* загрузка шаблона
* @param object
* @param string имя шаблона
*/
function loadTemplate($smarty, string $templateName)
{
	$smarty->display($templateName.TEMPLATE_POSTFIX);
}

/**
* функция отладки; останавливает работу программы и выводит
* значение переменной $value
* @param variant value переменная для вывода на страницу
*/
function d($value = null, int $die = 1)
{
	echo 'Debug: <br><pre>';
	print_r($value);
	echo '</pre>';

	if ($die): die(); endif;
}
