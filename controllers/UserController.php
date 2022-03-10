<?php
include_once(ROOT . "/models/User.php");

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';

        if (isset($_POST ["submit"])) {
            $name = $_POST ["name"];
            $email = $_POST ['email'];
            $password = $_POST ['email'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors [] = "Имя не должно быть короче 2-х символов";
            }

            if (!User::checkEmail($email)) {
                $errors [] = " Email  является некорректным";
            }

            if (!User::checkPassword($password)) {
                $errors [] = "Пароль не должен быть короче 6-ти символов";
            }

        }
        if (User::checkEmailExist($email)) {
            $errors [] = "Такой email уже существует";
        }

        if ($errors == false) {
            $result = User::register($name, $email, $password);
        }
//        if (isset($name)) {
//            echo "<br> $name";
//        }
//        if (isset($email)) {
//            echo "<br> $email";
//        }
//        if (isset($password)) {
//            echo "<br> $password";
//        }
        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = false;
        $password = false;

        if (isset($_POST["submit"])) {
            $email = $_POST ["email"];
            $password = $_POST ["password"];

            $errors = false; // флаг

            if (!User::checkEmail($email)) {
                $errors = 'Неправильный email!';
            }

            if (!User::checkPassword($password)) {
                $errors [] = "Пароль не должен быть короче 6-ти символов";
            }
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                //  если данные неправильные показываем ошибку
                $errors = "Неправильные данные для входа на сайт";
            } else {
                User::auth($userId);
                // перенаправление на закрытую часть сайта с помощью ф-и header
                header("Location:/cabinet/");
            }

        }
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

// Удаляем пользователя (user) с сессии
    public function actionLogout()
    {
        session_start();
        if ($_SESSION ["user"]) {
            unset ($_SESSION ["user"]);
        }

        header("Location: /");

        require_once(ROOT . '/views/user/login.php');
        return true;
    }


}