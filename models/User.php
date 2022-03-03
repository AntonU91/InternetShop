<?php
include_once(ROOT . "/components/DataBase.php");

class User
{
    public static function register($name, $email, $password): bool
    {
        $db = DataBase::getConnection();
        $sqlQuery = "INSERT INTO phpshop.user(name, email, password) " .
            "VALUES(:login, :email, :password)";
        $result = $db->prepare($sqlQuery);
        $result->bindParam(":login", $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        return $result->execute();

    }

    public static function checkName($name)
    {
        if (strlen($name) > 2) {
            return true;
        }
        return false;

    }

    public static function checkPassword($password)
    {
        if (strlen($password) > 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExist($email): bool
    {
        $db = DataBase::getConnection();
        $sqlQuery = "SELECT email FROM phpshop.user WHERE email = :email";
        $result = $db->prepare($sqlQuery);
        $result->bindParam("email", $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }


}