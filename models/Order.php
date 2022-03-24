<?php
require_once ROOT . "/components/DataBase.php";


class Order
{
    public static function saveOrder($userName, $userPhoneNumber, $userComment, $userId, $infoAboutProductInCart): bool
    {
        $db = DataBase::getConnection();
        $sqlQuery = "INSERT INTO phpshop.product_order (user_name, user_phone, user_comment, user_id, products) VALUES (:userName, :userPhoneNumber, :userComment, :userId, :products)";
        $result = $db->prepare($sqlQuery);
        $result->bindParam("userName", $userName);
        $result->bindParam("userPhoneNumber", $userPhoneNumber);
        $result->bindParam("userComment", $userComment);
        $result->bindParam("userId", $userId);
        $result->bindParam("products", $infoAboutProductInCart);
        return $result->execute();


    }

}