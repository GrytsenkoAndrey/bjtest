<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 12:58
 */
class TaskModel
{
    public function getAllTasks(): array
    {
        $conn = DB::getInstance()->getConnection();

        $order = '';
        if (count($_GET) > 0) {
            $get['username'] = isset($_GET['user']) ? trim(strip_tags($_GET['user'])) : '';
            $get['email'] = isset($_GET['email']) ? trim(strip_tags($_GET['email'])) : '';
            $get['status'] = isset($_GET['status']) ? trim(strip_tags($_GET['status'])) : '';

            $sortString = '';
            foreach ($get as $k => $v) {
                $var = !empty($v) ? trim(strip_tags($v)) : '';
                if ($var == 'ASC' || $var == 'DESC') {
                    $sortString .= "$k $var, ";
                }
            }

            if (!empty(trim($sortString))) {
                $sortString = substr($sortString, 0, strlen($sortString) -2);
                $order = "ORDER BY " . $sortString;
            }
        }

        $sql = "SELECT username, useremail, content, status, edited FROM task {$order}";
        $stmt = $conn->query($sql);

        if ($row = $stmt->fetchAll()) {
            return $row;
        } else {
            return [];
        }
    }
}