<?php

class DataBase
{

    public static function getConnection(): PDO
    {
        $params = include(ROOT . "/config/db_params.php");
        $dsn = "mysql:host = {$params['host']}; dbname = {$params['dbname']}";
        $db = new PDO ($dsn, $params['user'], $params ['password']);
        return $db;
    }

}