<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 16:25
 */
class UserModel
{

    public static function login(array $data)
    {
        $conn = DB::getInstance()->getConnection();

        $sql = "SELECT u.id, u.name, u.login, u.password, g.name AS role "
            ."FROM users AS u "
            ."LEFT JOIN users_groups AS ug ON ug.user_id = u.id "
            ."LEFT JOIN groups AS g ON g.id = ug.group_id "
            ."WHERE u.name = :name";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':name' => $data['name'], ]);
        $dat = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($dat) >= 1) {
            if (password_verify($data['pass'], $dat[0]['password']) == true) {
                UserModel::setSessionData($dat);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * заполняем данными массив $_SESSION
     * @param array $data
     */
    public static function setSessionData(array $data)
    {
        $_SESSION['user_id'] = $data[0]['id'];
        $_SESSION['user_name'] = $data[0]['name'];
        $_SESSION['user_login'] = $data[0]['login'];
        $_SESSION['user_role'] = $data[0]['role'];
    }
}