<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 12:24
 */
class TaskController
{
    private $app;
    private $smarty;
    private $model;

    public function __construct(Front $front, Smarty $smarty)
    {
        $this->app = $front;
        $this->smarty = $smarty;
        $this->model = new TaskModel();
    }

    public function mainAction()
    {
        $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
        $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

        $rsTask = $this->model->getAllTasks();

        $this->smarty->assign('pageTitle', 'Главная');
        $this->smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $this->smarty->assign('activeUser', $activeUser);
        $this->smarty->assign('infoMsg', $infoMsg);
        $this->smarty->assign('rsTask', $rsTask);
        loadTemplate($this->smarty, 'header');
        loadTemplate($this->smarty, 'navbar');
        loadTemplate($this->smarty, 'index');
        loadTemplate($this->smarty, 'footer');
        $_SESSION['infoMsg'] = '';
    }

    public function addAction()
    {
        if ($_POST) {
            #
        } else {

        }
    }
}