<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>КАТЕГОРИИ</h2>

                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <div class="panel panel-default">
                            <?php foreach ($this->categories as $category): ?>
                                <div class="panel-heading">

                                    <h4 class="panel-title">
                                        <a class="category-link" href="/category/<?= $category['id']; ?>/">
                                            <?= $category['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            <?php endforeach; ?>
                        </div>


                    </div><!--/category-products-->

                </div>
            </div>


            <div class="col-sm-9 padding-right">
                <div class="recommended_items">
                    <h2 class="title text-center">Рекомендуемые товары</h2>
                    <div class="slider-autoplay">
                        <?php foreach ($this->recommended_products as $product): ?>
                            <div class="features_items">
                                <a href="/product/<?= $product['id']; ?>">
                                    <div class="main-slider">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?= DIRECTORY_SEPARATOR . AdminProduct::$path . $product['id'] . $product['main_image']; ?>" alt="" />
                                                <div class="main-slider-info">
                                                    <h2><?= $product['price']; ?> грн</h2>
                                                    <p><a href="/product/<?= $product['id']; ?>"><?= $product['name']; ?></a></p>
                                                </div>
                                                <a href="/cart/add/<?= $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?= $product['id']; ?>><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">ПОСЛЕДНИЕ ТОВАРЫ</h2>
                    <?php foreach ($this->products as $product): ?>
                        <a href="/product/<?= $product['id']; ?>">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="wrap-img">
                                                <img src="<?= DIRECTORY_SEPARATOR . AdminProduct::$path . $product['id'] . $product['main_image']; ?>" alt="" />
                                            </div>
                                            <div class="wrap-info">
                                                <h2><?= $product['price']; ?> грн</h2>
                                                <p><a href="/product/<?= $product['id']; ?>"><?= $product['name']; ?></a></p>
                                            </div>
                                            <a href="/cart/add/<?= $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?= $product['id']; ?>><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div><!--/features_items-->

            </div>
        </div>
    </div>
</section>