<?php
include_once(ROOT . "/components/DataBase.php");

class Product
{
    /**
     * the number of items shown on the front page
     */
    const COUNT_SHOWN_BY_DEFAULT = 10;

    /**
     * Return products` list
     * @param int $countOfItems count of shown items
     */
    public static function getLatestProducts(int $countOfItems = self::COUNT_SHOWN_BY_DEFAULT): array
    {
        $db = DataBase::getConnection();
        $productList = array();
        $result = $db->query("SELECT * FROM phpshop.product WHERE status=1
                            ORDER BY id DESC LIMIT $countOfItems");
        $i = 0;
        while ($row = $result->fetch()) {
            $productList [$i] ["id"] = $row ['id'];
            $productList [$i] ["image"] = $row ["image"];
            $productList [$i] ["is_new"] = $row ["is_new"];
            $productList [$i] ["name"] = $row ['name'];
            $productList [$i] ["price"] = $row ['price'];

            $i++;
        }
        return $productList;
    }

    /**
     * Return products of particular category whose id  is a param
     * @param $categoryId
     **/
    public static function getProductsByCategoryId($categoryId = false)
    {
        if ($categoryId) {
            $db = DataBase::getConnection();
            $categoryProducts = array();
            $result = $db->query("SELECT * FROM phpshop.product WHERE status=1 AND category_id='$categoryId'"
                                    ."ORDER BY id DESC LIMIT ".self::COUNT_SHOWN_BY_DEFAULT);
            $i = 0;
            while ($row = $result->fetch()) {
                $categoryProducts [$i] ["id"] = $row ['id'];
                $categoryProducts [$i] ["image"] = $row ["image"];
                $categoryProducts [$i] ["is_new"] = $row ["is_new"];
                $categoryProducts [$i] ["name"] = $row ['name'];
                $categoryProducts [$i] ["price"] = $row ['price'];

                $i++;
            }
            return $categoryProducts;

        }
    }

    public static function getProductById ($productId) {
        if ($productId) {
            $db = DataBase::getConnection();
            $currentProduct = array();
            $result = $db->query("SELECT * FROM phpshop.product WHERE status=1 AND id= $productId");

             $row = $result->fetch(PDO::FETCH_ASSOC);
                $currentProduct = $row;

             return $currentProduct;
        }
    }


}