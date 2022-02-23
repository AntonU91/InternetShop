<?php include(ROOT . "/views/layouts/header.php") ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <?php foreach ($categories as $particularCategory) : ?>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a
                                                href="/category/<?php echo $particularCategory['id'] ?>"><?php echo $particularCategory['name'] ?></a>
                                    </h4>
                                </div>
                            </div>

                        </div><!--/category-products-->
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <?php //TODO доделать этот блок => в результате должна отображаться страница товара ?>
                <div class="product-details"><!--product-details-->
                    <div class="row">

                        <div class="col-sm-5">
                            <div class="view-product">
                                <?php //TODO строчкой ниже нужно вынимать изображение из таблици phpshop.product ?>
                                <img src="../../template/images/product-details/1.jpg" alt=""/>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

<!--                                --><?php if ($particularProduct["is_new"]) : ?>
                                    <img src="../../template/images/product-details/new.jpg" class="newarrival" alt=""/>
                                <?php  endif;?>
                                <h2><?php echo $particularProduct ["name"];?></h2>
                                <p>Код товара:<?php echo $particularProduct["code"] ?></p>
                                <span>
                                            <span><?php echo $particularProduct["price"] ?></span>
                                            <label>Количество:</label>
                                            <input type="text" value="3"/>
                                            <button type="button" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </button>
                                        </span>
                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?php echo $particularProduct["brand"];?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?php echo $particularProduct ["description"]?></p>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>


<br/>
<br/>

<?php include(ROOT . "/views/layouts/footer.php") ?>
