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

    public static function checkUserPhone(string $phoneNumber): bool
    {
        $pattern = "/[+]?[3]?[8]?[0][0-9]{9}/";
        if (preg_match_all($pattern, $phoneNumber)) {
            return true;
        }
        return false;
    }

// Проверяем существует ли такой пользователь
    public static function checkUserData($email, $password)
    {
        $db = DataBase::getConnection();
        $sqlQuery = "SELECT * FROM phpshop.user WHERE email = :email AND password= :password";
        $result = $db->prepare($sqlQuery);
        $result->bindParam("email", $email, PDO::PARAM_STR);
        $result->bindParam("password", $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user ["id"];
        }
        return false;


    }

    /**
     * Запоминаем пользователя
     * @param $userId
     */
    public static function auth($userId)
    {

        $_SESSION ["user"] = $userId;
    }

// проверяем зашел ли пользователь в учетную запись
    public static function checkLogged()
    {

        // вернем сессию и посмотрим есть ли в ней идентификатор пользователя
        if (isset ($_SESSION ['user'])) {
            return $_SESSION ['user'];
        }
        //header("Location: /user/login");

    }

    public static function isGuest(): bool
    {

        if (isset($_SESSION["user"])) {
            return false;
        }
        return true;
    }

// возвращает данные пользователя по id из БД
    public static function getUserById($id)
    {
        if ($id) {
            $db = DataBase::getConnection();
            $sqlQuery = "SELECT * FROM phpshop.user WHERE id = :id ";
            $result = $db->prepare($sqlQuery);
            $result->bindParam("id", $id, PDO::PARAM_STR);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    //// редактирует пароль и имя уже зарегистрированного пользователя
    public static function editUserInfo($userId, $newUserName, $newUserPassword): bool
    {
        $db = DataBase::getConnection();
        $sqlQuery = "UPDATE phpshop.user SET name = :name, password = :password WHERE  id = :id";
        $result = $db->prepare($sqlQuery);
        $result->bindParam("name", $newUserName);
        $result->bindParam("password", $newUserPassword);
        $result->bindParam("id", $userId);
        return $result->execute();

    }


}