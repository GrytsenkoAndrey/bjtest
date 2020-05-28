<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 10:45
 */
class Front
{
    protected $controller;
    protected $action;
    protected $params;
    protected $activePage;
    static private $instance;

    public static function getInstance()
    {
        if(!(self::$instance instanceOf self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $arrURI = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        // проверяем существует ли файл контроллера
        $fileName = isset($arrURI[0]) ? ucfirst(strip_tags(trim($arrURI[0]))) : '';
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $fileName . 'Controller.php')) {
            // выбор контроллера из адресной строки
            $this->controller = !empty($arrURI[0]) ? $fileName . 'Controller' : 'IndexController';
        } else {
            $this->controller = '';
        }

        /* !!!!!!!!!!!!!!!!!!!!
        // сохраняем значение для выбора класса active в меню (навигации)
        $this->activePage = !empty($arrURI[0]) ? strtolower($fileName) : 'index';
        !!!!!!!!!!!!!!!!!!!!!! */

        // выбор действия
        $this->action = !empty($arrURI[1]) ? strip_tags(trim($arrURI[1])) . 'Action' : 'mainAction';
        // параметры
        $second = isset($arrURI[2]) ? strip_tags(trim($arrURI[2])) : '';
        $third = isset($arrURI[3]) ? strip_tags(trim($arrURI[3])) : '';
        $numParams = !empty($arrURI) ? count($arrURI) : 0;
        if(!empty($second) && !empty($third)) {
            $keys = $values = [];
            for($i = 2, $cnt = $numParams; $i < $cnt; $i++) {
                if($i%2 == 0) {
                    $keys[] = $arrURI[$i];
                } else {
                    $values[] = $arrURI[$i];
                }
            }
            $this->params = array_combine($keys, $values);
        }
    }

    public function route($smarty)
    {
        if(class_exists($this->getController())) {
            // если класс контроллера уже существует, получаем данные о классе
            $rc = new ReflectionClass($this->getController());
            // есть ли у контроллера метод (у класса)
            if($rc->hasMethod($this->getAction())) {
                $controller = $rc->newInstance(self::$instance, $smarty);
                $method = $rc->getMethod($this->getAction());
                // вызываем этот метод
                $method->invoke($controller);
            } else {
                header("Location: " . SITE_INDEX . 'error/main');
            }
        } else {
            header("Location: " . SITE_INDEX . 'error/');
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAPage()
    {
        return $this->activePage;
    }

    public function getAction()
    {
        return $this->action;
    }
}