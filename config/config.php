<?php
/**
* файл настроек
*/

define('PATH_PREFIX', 'controllers/');
define('PATH_POSTFIX', 'Controller.php');
define('DB_USER', 'myuser');
define('DB_PASS', 'myuserpass');
define('HOST', 'localhost');
define('DB_NAME', 'bjtest_db');
define('APP_DIR', $_SERVER['DOCUMENT_ROOT']);
define('VIEW_DIR', APP_DIR . DIRECTORY_SEPARATOR . 'view/');
// Smarty
// шаблон по умолчанию
$template = 'default';
// пути к файлам шаблонов
define('TEMPLATE_PREFIX', "views/{$template}/");
define('TEMPLATE_POSTFIX', '.tpl');
// пути к файлам шаблонов в wwww
define('TEMPLATE_WEB_PATH', "/templates/{$template}/");
// инициализация Smarty
require_once('library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir('tmp/smarty/templates_c');
$smarty->setCacheDir('tmp/smarty/cache');
$smarty->setConfigDir('library/Smarty/configs');

$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
// end Smarty