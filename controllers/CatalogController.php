<?php
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');
include_once (ROOT . '/components/Pagination.php');


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

    public function actionCategory($categoryId, $page=1)
    {
        $categories = Category::getCategoriesList();

        $categoryProducts = Product::getProductsByCategoryId($categoryId, $page);
        //Проверяем содержимое
//        echo "<pre>";
//        print_r($categoryProducts);
//        echo "</pre>";

        // Добавляем необходимые переменные для создания обьекта класса Pagination
        $total = Product::getTotalCountOfItemsInCategory($categoryId);
        print_r($total);
        $pagination = new Pagination($total, $page, Product::COUNT_SHOWN_BY_DEFAULT, 'page-' );

        require_once(ROOT . '/views/catalog/category.php');
        //print_r($categoryProducts);

        return true;
    }

}