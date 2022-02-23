<?php
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

class CatalogController
{
    public function actionIndex(): bool
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        // An array of products list
        $productsList = Product::getLatestProducts(5);
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionCategory($categoryId)
    {
        $categories = Category::getCategoriesList();

        $categoryProducts = Product::getProductsByCategoryId($categoryId);
        //Проверяем содержимое
//        echo "<pre>";
//        print_r($categoryProducts);
//        echo "</pre>";

        require_once(ROOT . '/views/catalog/category.php');
        //print_r($categoryProducts);

        return true;
    }

}