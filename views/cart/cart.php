<?php require ROOT . "/views/layouts/header.php"; ?>
<section>
    <div class="container">
        <div class="row">
            <!--            <div class="col-sm-3">-->
            <!--                <div class="left-sidebar">-->
            <!--                    <h2>Каталог</h2>-->
            <!--                    <div class="panel-group category-products">-->
            <!--                        --><?php //foreach ($categories as $categoryItem): ?>
            <!--                            <div class="panel panel-default">-->
            <!--                                <div class="panel-heading">-->
            <!--                                    <h4 class="panel-title"><a href="/category/-->
            <?php //echo $categoryItem ['id']; ?><!--"-->
            <!--                                                               class="-->
            <?php //if ($categoryId == $categoryItem['id']) echo "active"; ?><!--">-->
            <!--                                            --><?php //echo $categoryItem['name']; ?><!-- </a></h4>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        --><?php //endforeach; ?>
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <div class="col-sm-9 padding-right">
                <div class=" "><!--features_items-->
                    <h2 class="title text-center">Корзина</h2>
                    <?php if ($productsInCart) : ?>
                        <p>Вы выбрали такие товары: </p>
                        <table>
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стоимость, грн</th>
                                <th>Количество, шт</th>
                                <th>Удалить</th>

                            </tr>
                            <?php foreach ($products as $item): ?>
                            <tr>
                                <td><?php echo $item["code"]; ?></td>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["price"]; ?></td>
                                <!--                               Строкой ниже указываем кол-во по каждой товарной позиции в корзине-->

                                <td><?php echo $productsInCart[$item["id"]]; ?></td>
                                <!--                                Вставляем форму, что бы реализовать удаление позиции из списка -->
                                <td>
                                    <form  method="post">
                                        <input type="submit" name ="<?php echo $item["id"];?>" value="&#10006;">
                                    </form></td>
                                <?php endforeach; ?>

                            </tr>
                            <tr>
                                <th colspan="3">Общая стоимость:</th>
                                <td> <?php echo $totalPrice; ?></td>
                            </tr>
                        </table>
                        <button><a href="/cart/checkout/">Оформить заказ</a></button>

                    <?php else: ?>
                        <p><?php echo "Корзина пуста" ?></p>
                        <button><a href="/">На главную</a></button>
                    <?php endif ?>



            </div>
        </div>
    </div>
</section>


<?php require ROOT . "/views/layouts/footer.php"; ?>







