<?php
/**
 * function to explode URI
 * @return array after explode
 *
 */
function parseUri() : array
{
    // check address
    $arrUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $arrUri = explode('/', $arrUri);
    
    return $arrUri;
}

/**
* функция определяет контроллер, действие, параметры
* если такие есть или присваивает значения по умолчанию
* 
* @return array 
*/
function defineCAP() : array
{
	# parse URI
	$aURI = parseUri();
    # output array
	$aOUT = [];
	$aOUT['controller'] = !empty($aURI[0]) ? trim(strip_tags($aURI[0])) : 'orders';
	$aOUT['action'] = !empty($aURI[1]) ? trim(strip_tags($aURI[1])) : 'index';
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

/**
* определяем дату понедельника по номеру недели и году
* @param int $week_number
* @param int $year
* @return string $result
*/
function getMonday(int $week, int $year) : string
{
      $first_date = strtotime("1 january ".($year ? $year : date("Y")));
         if(date("D", $first_date)=="Mon") {
              $monday = $first_date;
         } else {
              $monday = strtotime("next Monday", $first_date)-604800;
         }
         $plus_week = "+".($week-1)." week";
    return strtotime($plus_week, $monday);
}

/**
* определяем дату понедельника по номеру недели и году
* @param int $week_number
* @param int $year
* @return string $result
*/
function getSunday(int $week, int $year) : string
{
    return getMonday($week, $year)+604799;
}

/**
* диапазон дат для номера недели
* @param int $week_number
* @param int $year
* @return string $result
*/
function getWeekRange(int $week, int $year) : string
{
    return date('d\'m', getMonday($week, $year))." - ".date('d\'m', getSunday($week, $year));
}

/**
* изменяем цвет в файле color.css
* значение берем из базы данных, таблицы setting
* 
* @param resource $dbn
*/
function changeColor($dbn)
{
    $css = file('templates/default/style/color.css');
    $sql = "SELECT value FROM setting WHERE id = 1";
    $stmt = $dbn->query($sql);
    $row = $stmt->fetch();
    $css[5] = '--button-link-clr: '.$row['value'].";\n";
    $strCss = implode('', $css);
    file_put_contents('templates/default/style/color.css', $strCss);
}

##
/**
* проверяем пользователей и выставляем активность в 0
* если время последней активности > 720 (12 min)
*
* @param resource $db
*/
function updateActivityUserInDb($db)
{
    $sql = "UPDATE users SET active = 0 WHERE NOW() - last_visit > 720";
    $stmt = $db->query($sql);
}

/**    такая же в пользователях  - надо было использовать пространство имен, чтобы не было конфликта editUser.....
* обновить данные пользователя - активность "1"
* @param resource $db
* @param int $id
*/
function setActOn($db, int $id)
{
    $sql = "UPDATE users SET active=1, last_visit=:act_time WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':act_time' => date("Y-m-d H:i:s", time()),
                    ':id' => $id,
                    ]);
}