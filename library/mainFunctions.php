<?php
/**
 * функция определяет контроллер, действие, параметры
 * если такие есть или присваивает значения по умолчанию
 *
 * @return array
 */
function defineCAP() : array
{
    # parse URI
    $aURI = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    # output array
    $aOUT = [];
    $aOUT['controller'] = !empty($aURI[0]) ? trim(strip_tags($aURI[0])) : 'task';
    $aOUT['action'] = !empty($aURI[1]) ? trim(strip_tags($aURI[1])) : 'main';
    // если количество элементов четное
    if (count($aURI) % 2 == 0 && count($aURI) > 2) {
        // начиная со сторого элемента и до количества
        // ключ => значение пар
        $k = $v = [];
        for ($i = 2, $cnt = count($aURI); $i < $cnt; $i++) {
            if ($i % 2 == 0) {
                $k[] = $aURI[$i];
            } else {
                $v[] = $aURI[$i];
            }
        }
        $aOUT['params'] = array_combine($k, $v);
    } else {
        $aOUT['params'] = [];
    }
    // GET
    if (!empty($_GET)) {
        $aOUT['GET'] = $_GET;
    } else {
        $aOUT['GET'] = [];
    }

    return $aOUT;
}

/**
* формирование запрашиваемой страницы
* @param object
* @param array $params
*/
function loadPage($smarty)
{
    $arrURI = defineCAP();
    require_once PATH_PREFIX . ucfirst($arrURI['controller']) . PATH_POSTFIX;

    $function = $arrURI['action'];
    $function($smarty, $arrURI['params']);
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
