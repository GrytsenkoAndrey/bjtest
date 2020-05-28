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
            $post = [];
            foreach ($_POST as $k => $v) {
                if ($k == 'useremail') {
                    if (!empty(trim(strip_tags($v)))) {
                        if (strpos(trim(strip_tags($v)), '@') > 0) {
                            $post[$k] = trim(strip_tags($v));
                        } else {
                            $_SESSION['infoMsg'] .= "$k не является адресом почты<br>";
                        }
                    } else {
                        $_SESSION['infoMsg'] .= "$k является пустой<br>";
                    }
                } else {
                    if (!empty(trim(strip_tags($v)))) {
                        $post[$k] = trim(strip_tags($v));
                    } else {
                        $_SESSION['infoMsg'] .= "$k является пустой<br>";
                    }
                }
            }

            if (empty(trim($_SESSION['infoMsg']))) {
                if ($this->model->addTask($post)) {
                    $_SESSION['infoMsg'] = '<p class="alert alert-success">Задача добавлена</p>';
                    header("Location: /task/main/");
                    exit();
                } else {
                    $_SESSION['infoMsg'] = '<p class="alert alert-danger">Задача НЕ добавлена</p>';
                    header("Location: /task/main/");
                    exit();
                }
            } else {
                header("Location: /task/add/");
                exit();
            }

        } else {
            $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
            $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

            $this->smarty->assign('pageTitle', 'Новая задача');
            $this->smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
            $this->smarty->assign('activeUser', $activeUser);
            $this->smarty->assign('infoMsg', $infoMsg);
            loadTemplate($this->smarty, 'header');
            loadTemplate($this->smarty, 'navbar');
            loadTemplate($this->smarty, 'add');
            loadTemplate($this->smarty, 'footer');
            $_SESSION['infoMsg'] = '';
        }
    }
}
