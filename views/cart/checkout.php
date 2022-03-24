<?php require ROOT . "/views/layouts/header.php"; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/
            <?php echo $categoryItem ['id']; ?>"
                                                               class="
            <?php if ($categoryId == $categoryItem['id']) echo "active"; ?>">
                                            <?php echo $categoryItem['name']; ?> </a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <h2 class="title text-center">Оформление заказа</h2>
                <?php var_dump($result); ?> <br>
                <?php if ($result): ?>
                    <p>Заказ оформлен! Менеджер свяжется с Вами!</p>
                <?php else: ?>
                    <p><?php echo $infoAboutPurchase; ?></p>
                    <?php if (!empty($errors)) : ?>

                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?> </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>


                    <p>Для оформления заказа, заполните поля! Наш менеджер свяжется с Вами</p>
                    <form action="#" method="post">

                        <input type="text" name="userName" placeholder="Имя" value="<?php echo $userName; ?>"><br>
                        <input type="tel" name='userPhoneNumber' placeholder="Номер телефона"
                               value="<?php echo $userPhoneNumber; ?>"><br>
                        <input type="email" name='userEmail' placeholder="E-mail"
                               value="<?php echo $userEmail; ?>"><br>
                        <input type="text" name="userComment" placeholder="Комментарий"
                               value="<?php echo $userComment; ?>"><br>
                        <input type="submit" name="submit" value="Отправить данные">
                    </form>
                <?php endif; ?>

        </div>
    </div>
</section>


<?php require ROOT . "/views/layouts/footer.php"; ?>



