<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 12:24
 */

function main($smarty, $params)
{
    $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
    $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

    $rsTask = TaskModel::getAllTasksPage($params);
    $rsPagination = pagination(TaskModel::getAllTasks());

    if (count($_GET) > 0 ) {
        $user = isset($_GET['user']) ? trim(strip_tags($_GET['user'])) : '';
        $email = isset($_GET['email']) ? trim(strip_tags($_GET['email'])) : '';
        $status = isset($_GET['status']) ? trim(strip_tags($_GET['status'])) : '';
    } else {
        $user = '';
        $email = '';
        $status = '';
    }

    $smarty->assign('pageTitle', 'Главная');
    $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
    $smarty->assign('activeUser', $activeUser);
    $smarty->assign('infoMsg', $infoMsg);
    $smarty->assign('rsTask', $rsTask);
    $smarty->assign('rsPag', $rsPagination);
    $smarty->assign('user', $user);
    $smarty->assign('email', $email);
    $smarty->assign('status', $status);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'navbar');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');

    $_SESSION['infoMsg'] = '';
}

function add($smarty, $params)
{
    if ($_POST) {
        $post = [];
        foreach ($_POST as $k => $v) {
            if ($k == 'useremail') {
                if (!empty(trim(strip_tags($v)))) {
                    if (strpos(trim(strip_tags($v)), '@') > 0) {
                        $post[$k] = trim(strip_tags($v));
                    } else {
                        $_SESSION['infoMsg'] .= "<p class='alert alert-danger'>$k не является адресом почты</p><br>";
                    }
                } else {
                    $_SESSION['infoMsg'] .= "<p class='alert alert-danger'>$k является пустой</p><br>";
                }
            } else {
                if (!empty(trim(strip_tags($v)))) {
                    $post[$k] = trim(strip_tags($v));
                } else {
                    $_SESSION['infoMsg'] .= "<p class='alert alert-danger'>$k является пустой</p><br>";
                }
            }
        }

        if (empty(trim($_SESSION['infoMsg']))) {
            if (TaskModel::addTask($post)) {
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

        $smarty->assign('pageTitle', 'Новая задача');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('infoMsg', $infoMsg);
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'navbar');
        loadTemplate($smarty, 'add');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

function edit($smarty, $params)
{
    if ($_POST) {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['infoMsg'] = '<p class="alert alert-danger">Для внесения изменений необходимо авторизоваться!</p>';
            header("Location: /task/main/");
            exit();
        }
        $post = [];
        foreach ($_POST as $k => $v) {
            if (!empty(trim(strip_tags($v)))) {
                $post[$k] = trim(strip_tags($v));
            } else {
                $_SESSION['infoMsg'] .= "<p class='alert alert-danger'>$k является пустой</p><br>";
            }
        }

        if (empty(trim($_SESSION['infoMsg']))) {
            if (TaskModel::editTask($post)) {
                $_SESSION['infoMsg'] = '<p class="alert alert-success">Задача изменена</p>';
                header("Location: /task/main/");
                exit();
            } else {
                $_SESSION['infoMsg'] = '<p class="alert alert-danger">Задача НЕ изменена</p>';
                header("Location: /task/main/");
                exit();
            }
        } else {
            header("Location: /task/edit/");
            exit();
        }

    } else {
        $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
        $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

        if (isset($params['id'])) {
            $id = (int)trim(strip_tags($params['id']));

            if (TaskModel::checkId($id) != -1) {

                $rsTask = TaskModel::getTaskById($id);

                $smarty->assign('pageTitle', 'Новая задача');
                $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
                $smarty->assign('activeUser', $activeUser);
                $smarty->assign('infoMsg', $infoMsg);
                $smarty->assign('rsTask', $rsTask);
                loadTemplate($smarty, 'header');
                loadTemplate($smarty, 'navbar');
                loadTemplate($smarty, 'edit');
                loadTemplate($smarty, 'footer');

                $_SESSION['infoMsg'] = '';
            } else {
                $_SESSION['infoMsg'] = '<p class="alert alert-danger">Задачи с таким ID не существует</p>';
            }
        } else {
            $_SESSION['infoMsg'] = '<p class="alert alert-danger">Неверный параметр</p>';
        }
    }
}
