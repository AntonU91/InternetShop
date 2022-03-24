<?php
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');
include_once(ROOT . '/models/User.php');


class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        // An array of products list
        $productsList = Product::getLatestProducts(5);
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionContact(): bool
    {
        $userEmail = "";
        $userText = "";
        $result = false;

        if (isset ($_POST ["submit"])) {
            $userEmail = $_POST ['userEmail'];
            $userText = $_POST ['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors[] = "Неправильный email";
            }
            if ($errors == false) {
                $adminEmail = "anton.uzhva@gmail.com";
                $message = "Текст: $userText<br>".  " От: $userEmail";
                $subject = "Тема письма";
                require(ROOT . "/config/phpMailerParam.php");
                $result = true;
            }
        }
        require (ROOT. "/views/site/contact.php" );
        return true;
    }

}