<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 11:16
 */
function mainAction($smarty, $params)
{
    $activeUser = isset($_SESSION['user_id']) ? $_SESSION['user_name'] : '';
    $infoMsg = isset($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

    $smarty->assign('pageTitle', 'Страница не найдена');
    $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
    $smarty->assign('activeUser', $activeUser);
    $smarty->assign('infoMsg', $infoMsg);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'navbar');
    loadTemplate($smarty, 'error');
    loadTemplate($smarty, 'footer');
    $_SESSION['infoMsg'] = '';
}
