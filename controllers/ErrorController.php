<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 11:16
 */
class ErrorController
{
    private $app;
    private $smarty;

    public function __construct(Front $front, Smarty $smarty)
    {
        $this->app = $front;
        $this->smarty = $smarty;
    }

    public function mainAction()
    {
        $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
        $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

        $this->smarty->assign('pageTitle', 'Страница не найдена');
        $this->smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $this->smarty->assign('activeUser', $activeUser);
        $this->smarty->assign('infoMsg', $infoMsg);
        loadTemplate($this->smarty, 'header');
        loadTemplate($this->smarty, 'navbar');
        loadTemplate($this->smarty, 'index');
        loadTemplate($this->smarty, 'footer');
        $_SESSION['infoMsg'] = '';

    }
}