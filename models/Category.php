<?php
include_once (ROOT. "/components/DataBase.php");
class Category
{

    /**
     * Returns an array of categories
     */
    public static function getCategoriesList(): array
    {
        $db = DataBase::getConnection();

        $categoryList = array();

        $result = $db->query("SELECT id, name FROM phpshop.category ORDER BY sort_order ASC ");

        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categoryList [$i] ['id'] = $row ['id'];
            $categoryList [$i] ['name'] = $row ['name'];
            $i++;
        }
        return $categoryList;


    }

}