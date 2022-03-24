<?php
require_once(ROOT . "/models/Cart.php");
require_once(ROOT . "/models/Category.php");
require_once(ROOT . "/models/Product.php");
require_once(ROOT . "/models/User.php");
require_once(ROOT . "/models/Order.php");


class CartController
{
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);
        //Возвращаем пользователя на страничку
        $referer = $_SERVER["HTTP_REFERER"];
        header("Location: $referer");
    }

    // Формирует данные для таблиц в разделе "Корзина"
    public function actionIndex()
    {
        // Возвращаем список категорий для показа его на странице
        $categories = [];
        $categories = Category::getCategoriesList();

        $productsInCart = false;
        // Получим данные из корзины
        $productsInCart = Cart::getItemsFromCart();
        print_r($productsInCart);
        if ($productsInCart) {
            //Получаем полную информацию для товаров из списка
            $productsId = array_keys($productsInCart);
            $products = Product::getProductByIds($productsId);
            //print_r($products);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalCostInCart($products);
            if (isset($_POST)) {
                Cart::deleteItemFromCart(array_key_first($_POST));
                // header("Location: /cart/");
            }

        }


        require_once ROOT . "/views/cart/cart.php";
        return true;
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function actionCheckout()
    {

        // Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoriesList();

        // флаг успешного оформления заказа
        $result = false;


        if (isset($_POST["submit"])) {
            //Форма отправлена - ДА!

// Считываем данные формы
            $userName = $_POST['userName'];

            $userPhoneNumber = $_POST['userPhoneNumber'];
            $userComment = $_POST ["userComment"];
            $userEmail = $_POST ["userEmail"];


//Валидация полей
            $errors = false;
            if (!User::checkName($userName)) {
                $errors [] = "Имя должно быть длиннее двух символов";
            }

            if (!User::checkUserPhone($userPhoneNumber)) {
                $errors [] = "Некорректно введен номер телефона";
            }
            if ($errors == false) {
                // Форма заполнена корректно? - Да
                // Сохраняем заказ в базе данных

                $userInfo = $_POST;
                print_r($userInfo);
                $productInCart = Cart::getItemsFromCart();

                if (User::isGuest()) {
                    $userId = false;
                }
                $userId = User::checkLogged();


// Для корректной реализации метода Order::saveOrder отформатируем данные корзины в json формат

                $productInCartToJSON = json_encode($productInCart);
                //  Метод ниже сохраняет заказ в БД
                $result = Order::saveOrder($userName, $userPhoneNumber, $userComment, $userId, $productInCartToJSON);

                // Метод ниже отправляет заказ по e-mail
                if ($result) {

                    // Отправляем письмо
                    Cart::sendToAdminEmail($userEmail, $userComment,"anton_uzhva@ukr.net" ,$productInCartToJSON);

                    // удаляем товары в корзине с сессии (лучше сделать методом!)
                    unset($_SESSION ["products"]);
                }
                //header("Location:/");

            } else {
                // Форма заполнена корректно? - Нет

                // показываем информацию о заказе
                $productInCart = Cart::getItemsFromCart();
                $productsIds = array_keys($productInCart);
                $product = Product::getProductByIds($productsIds);
                $totalCost = Cart::getTotalCostInCart($product);
                $countOfItems = Cart::countOfItems();
                $infoAboutPurchase = Cart::infoAboutPurchase($countOfItems, $totalCost);

            }

        } else {
            //Форма отправлена? - Нет
            // Получаем данные из корзины
            $productInCart = Cart::getItemsFromCart();

            if ($productInCart == false) {
                // В корзине есть товары? - Нет
                // Отправляем пользователя на главную искать товары
                header("Location:/");
            } else {
                // В корзине есть товары? -Да
                // показываем информацию о заказе - итоги (кол-во товаров, общая стоимость заказа)
                $productsIds = array_keys($productInCart);

                $product = Product::getProductByIds($productsIds);
                $totalCost = Cart::getTotalCostInCart($product);
                $countOfItems = Cart::countOfItems();

                $userName = false;
                $userPhoneNumber = false;
                $userComment = false;
                $userEmail = false;

                // Пользователь авторизован?
                if (User::isGuest()) {
                    // НЕТ
                    // Значения для формы пусты
                } else {
                    // ДА, авторизован
                    // Тогда получаем информацию о пользователе
                    $userId = User::checkLogged();
                    /// подставляем полученную информацию ниже в поля
                    $user = User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user["name"];
                    $userEmail = $user["email"];
                }


                $infoAboutPurchase = Cart::infoAboutPurchase($countOfItems, $totalCost);


            }


        }

        require ROOT . "/views/cart/checkout.php";
        return true;


    }


}