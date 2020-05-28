<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 28.05.2020
 * Time: 9:41
 */

class DB
{
    protected $connection;
    private static $instance;

    private function __construct()
    {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $opt = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+03:00'",
            ];
            $this->connection = new \PDO($dsn, DB_USER, DB_PASS, $opt);
        } catch (\PDOException $e) {
            print "Не могу подключиться к базе: ". $e->getMessage();
        }
    }

    /**
    * экземпляр класса базы данных
    */
    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    * запрещаем копирование объекта
    */
    private function __clone() {}

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
