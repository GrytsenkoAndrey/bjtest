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

/**
 * pagination
 * формируем навигацию по страницам
 *
 * @param array $data - массив после выборки
 * @param int $cnt - количество записей на странице
 * @return array $result
 */
function pagination(array $data, int $cnt = 3) : array
{
    $arrUri = defineCAP();
    # формируем начало строки адреса
    $urlPrefix = "/". $arrUri['controller'] ."/". $arrUri['action'] ."/";
    # формируем конец строки - $_GET
    $urlPostfix = '';
    $urlPostfix = http_build_query($arrUri['GET']);
    if (!empty($urlPostfix)) {
        $urlPostfix = '?' . $urlPostfix;
    }
    # проверяем массивы;
    if (count($data) > 0) {
        # общее количество страниц
        $total = (count($data) > 1) ? intval((count($data)-1) / $cnt) + 1 : 0;
        $page = array_key_exists('page',$arrUri['params']) ? $arrUri['params']['page'] : 1;
        $arrPag = [];
        if ($page - 2 > 0) {
            $arrPag[0]['url'] = $urlPrefix.'page/'. intval($page-2) .'/'.$urlPostfix;
            $arrPag[0]['title'] = intval($page-2);
            $arrPag[0]['active'] = '';
        }
        if ($page - 1 > 0) {
            $arrPag[1]['url'] = $urlPrefix.'page/'. intval($page-1) .'/'.$urlPostfix;
            $arrPag[1]['title'] = intval($page-1);
            $arrPag[1]['active'] = '';
        }
        $cnt = count($arrPag);
        $arrPag[$cnt+1]['url'] = $urlPrefix.'page/'.intval($page).'/'.$urlPostfix;
        $arrPag[$cnt+1]['title'] = (int)$page;
        $arrPag[$cnt+1]['active'] = 'active';
        if ($page + 1 <= $total) {
            $arrPag[$cnt+2]['url'] = $urlPrefix.'page/'. intval($page+1) .'/'.$urlPostfix;
            $arrPag[$cnt+2]['title'] = intval($page+1);
            $arrPag[$cnt+2]['active'] = '';
        }
        if ($page + 2 <= $total) {
            $arrPag[$cnt+3]['url'] = $urlPrefix.'page/'. intval($page+2) .'/'.$urlPostfix;
            $arrPag[$cnt+3]['title'] = intval($page+2);
            $arrPag[$cnt+3]['active'] = '';
        }

        return $arrPag;
    } else {
        return [];
    }
}