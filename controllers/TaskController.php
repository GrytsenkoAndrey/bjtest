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

    $rsTask = TaskModel::getAllTasks();
d($rsTask);
    $smarty->assign('pageTitle', 'Главная');
    $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
    $smarty->assign('activeUser', $activeUser);
    $smarty->assign('infoMsg', $infoMsg);
    $smarty->assign('rsTask', $rsTask);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'navbar');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
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

