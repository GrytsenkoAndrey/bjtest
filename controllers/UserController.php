<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 16:16
 */

/**
 * страница входа
 *
 * @param object $smarty
 * @param array $params
 */
function main($smarty, $params)
{
    if ($_POST) {
        $_SESSION['infoMsg'] = '';
        $post['name'] = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
        $post['pass'] = isset($_POST['pass']) ? trim(strip_tags($_POST['pass'])) : '';

        if (UserModel::login($post)) {
            header('Location: /task/main/');
            exit();
        } else {
            $_SESSION['infoMsg'] = '<div class="alert alert-danger">Неправильный пароль</div>';
            header("Location: /user/main/");
            exit();
        }

    } else {
        if(isset($_SESSION['user_id'])) {
            $_SESSION['infoMsg'] = '<div class="alert alert-info">Вы уже авторизованы</div>';
            header("Location: /task/main/");
            exit();
        }

        $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
        $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : 'нет';

        $smarty->assign('pageTitle', 'Aвторизация');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);

        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'navbar');
        loadTemplate($smarty, 'login');
        loadTemplate($smarty, 'footer');
        $_SESSION['infoMsg'] = '';
    }
}

/**
 * выход пользователя из системы
 *
 * @param object $smarty
 * @param array $params
 */
function logout($smarty, $params)
{
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time()-3600);
    /**/
    header('Location: /task/main/');
}