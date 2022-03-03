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

        if ($errors ==false) {
        $result = User::register($name,$email,$password);
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

}