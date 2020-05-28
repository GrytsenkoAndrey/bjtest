<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 9:35
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

require_once 'config/config.php';

/**
* устанавливаем папки для автоподключения
*/
set_include_path(get_include_path()
    .PATH_SEPARATOR.'controllers'
    .PATH_SEPARATOR.'library'
    .PATH_SEPARATOR.'models'
);

/**
* автоподключение требуемых классов/файлов
*/
spl_autoload_register(function($class) {
    require_once $class . ".php";
});

$app = Front::getInstance();
$app->route();