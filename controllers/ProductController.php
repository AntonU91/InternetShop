<?php
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');


class ProductController
{
    public function actionView($productId)
    {
        $categories = Category::getCategoriesList();

        $particularProduct = array();
        $particularProduct =Product::getProductByIds($productId);


//        var_dump($particularProduct);

        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}