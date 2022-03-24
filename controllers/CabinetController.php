<?php
require_once(ROOT . '/models/User.php');

class CabinetController
{
    public function actionIndex()
    {

        $userId = User::checkLogged();

        // проверяем какой пользователь сейчас залогинен по идентификатору

        $user = User::getUserById($userId);

        require_once ROOT . "/views/cabinet/index.php";
        return true;


    }

    public function actionEdit()
    {

        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $name = $user ["name"];
        $password = $user ["password"];
        $errors = false;

        if (isset($_POST ["submit"])) {
            $name = $_POST ["name"];
            $password = $_POST ["password"];
        }

        if (!User::checkName($name)) {
            $errors [] = "Имя не должно быть меньше двух символов";
        }
        if (!User::checkPassword($password)) {
            $errors [] = "Пароль не может быть меньше 6-ти символов";
        }
        if ($errors == false) {
            $result = User::editUserInfo($userId, $name, $password);
        }
        require_once ROOT . "/views/cabinet/edit.php";
        return true;

    }

}