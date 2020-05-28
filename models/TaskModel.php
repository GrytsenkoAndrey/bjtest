<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 12:58
 */
class TaskModel
{
    public static function getTaskById(int $id): array
    {
        $conn = DB::getInstance()->getConnection();

        $sql = "SELECT id, content, status FROM task WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $row;
        } else {
            return [];
        }
    }
    /**
     * @param int $id
     * @return int
     */
    public static function checkId(int $id): int
    {
        $conn = DB::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) AS quantity FROM task WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $row['quantity'];
        } else {
            return -1;
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function editTask(array $data): bool
    {
        $conn = DB::getInstance()->getConnection();

        $sql = "UPDATE task SET content = :cont, status = :status, edited = 1 WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':cont' => $data['content'],
            ':status' => $data['status'],
            ':id' => $data['id'],
        ]);

        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function addTask(array $data): bool
    {
        $conn = DB::getInstance()->getConnection();

        $sql = "INSERT INTO task (username, useremail, content) VALUES (:user, :email, :content)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':user' => $data['username'],
            ':email' => $data['useremail'],
            ':content' => $data['content'],
        ]);

        if ($conn->lastInsertId() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public static function getAllTasks(): array
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

        $sql = "SELECT id, username, useremail, content, status, edited FROM task {$order}";
        $stmt = $conn->query($sql);

        if ($row = $stmt->fetchAll()) {
            return $row;
        } else {
            return [];
        }
    }
}
