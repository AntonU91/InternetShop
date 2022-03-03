<?php
include_once(ROOT . "/components/DataBase.php");

class Product
{
    /**
     * the number of items shown on the front page
     */
    const COUNT_SHOWN_BY_DEFAULT = 3;

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
    public static function getProductsByCategoryId($categoryId = false, $page = 1)
    {



        if ($categoryId) {
            $db = DataBase::getConnection();
            $categoryProducts = array();
            $offset = ($page - 1) * self::COUNT_SHOWN_BY_DEFAULT;
            $result = $db->query("SELECT * FROM phpshop.product WHERE status=1 AND category_id=$categoryId 
                                ORDER BY id DESC LIMIT " . self::COUNT_SHOWN_BY_DEFAULT . " OFFSET ".$offset);
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

    public static function getProductById($productId)
    {
        if ($productId) {
            $db = DataBase::getConnection();
            $currentProduct = array();
            $result = $db->query("SELECT * FROM phpshop.product WHERE status=1 AND id=$productId");

            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function getTotalCountOfItemsInCategory($categoryId)
    {
        if ($categoryId) {
            $db = DataBase::getConnection();
            $result = $db->query("SELECT COUNT(*) as total_count FROM phpshop.product WHERE status=1 AND category_id=$categoryId");
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row["total_count"];

        }


    }


}