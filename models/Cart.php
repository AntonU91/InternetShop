<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once ROOT . "/components/DataBase.php";

require ROOT . '/PHPMailer-master/src/Exception.php';
require ROOT . '/PHPMailer-master/src/PHPMailer.php';
require ROOT . '/PHPMailer-master/src/SMTP.php';


class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);

        $productsInCart = [];
        // Если товары уже есть в корзине (они хранятся в сессии)
        if (isset($_SESSION ["products"]) && !empty($_SESSION["products"])) {
            // то заполним наш массив товарами
            $productsInCart = $_SESSION ["products"];

        }
        // Если товар уже есть в массиве, но он добавляется еще раз, то нужно увеличить его кол-во
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart [$id]++;

        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION ["products"] = $productsInCart;
//        echo '<pre>';
//        print_r($_SESSION["products"]);
//        echo "</pre>";

    }

    /**
     * Возращает сумму единиц товара, добавленного в корзину
     *
     */
    public static function countOfItems()
    {
        $productsInCart = $_SESSION ["products"];
        $count = 0;
        foreach ($productsInCart as $id => $quantity) {
            $count += $quantity;
        }
        return $count;
    }

    /**
     * Возвращает массив, с кол-вом каждой товарной единицы, добавленной в корзину
     */
    public static function countOfEachItemsInCart()
    {
        $productsInCart = $_SESSION ["products"];
        return array_values($productsInCart);


    }


    /**
     * Возвращаем данные о товарах, которые добавлены в корзину
     */
    public static function getItemsFromCart()
    {

        if (isset($_SESSION ["products"])) {
            $productsInCart = $_SESSION ["products"];
            return $_SESSION ["products"];
        }
        return false;
    }

    /**
     * Подсчитывает суммарную стоимость всех товаров в корзине
     */
    public static function getTotalCostInCart($products)
    {

        $productsInCart = self::getItemsFromCart();
        $totalCost = 0;
        if ($productsInCart) {
            foreach ($products as $item) {
                $totalCost = $item ["price"] * $productsInCart [$item["id"]];
            }

        }
        return $totalCost;
    }


    public static function deleteItemFromCart($id)
    {
        $id = intval($id);
        $productsInCart = Cart::getItemsFromCart();
        $products = Product::getProductByIds($productsInCart);
        $arr = array_keys($productsInCart);

        //$arr2 =array_keys($_POST);

        if (array_key_exists($id, $_POST)) {
            unset($productsInCart[$id]);
            $_SESSION ["products"] = $productsInCart;
            header("Location: /cart/");
        }
    }


    /**
     * @throws Exception
     */
    public static function sendToAdminEmail($userEmail, $message, $adminEmail = "anton_uzhva@ukr.net", $subject = "Оформление заказа")
    {
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';

// Настройки SMTP
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 1;

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'anton.uzhva';
        $mail->SMTPSecure = "ssl";
        $mail->Password = 'Lumen2021';


// От кого
        $mail->setFrom($userEmail);

// Кому
        $mail->addAddress($adminEmail, 'InternetShop');
//
//$mail->isHTML(true);

// Тема письма
        $mail->Subject = $subject;

// Тело письма

        $mail->Body = $message;

// Приложение
//$mail->addAttachment("/Users/mac/PhpstormProjects/VictorZinchenko/InternetShop/template/images/home/gallery1.jpg");

        $mail->send();
    }

    public static function infoAboutPurchase($countOfItems, $totalCost): string
    {

        return "Вы заказали $countOfItems шт. товара на сумму $totalCost грн.";

    }

}