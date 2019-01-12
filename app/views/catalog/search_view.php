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
                                        <a href="/category/<?= $category['id']; ?>/"
                                           class="<?php if ($this->category_id == $category['id']) echo 'active'; ?>">
                                               <?= $category['name']; ?> 
                                        </a>
                                    </h4>
                                </div>
                            <?php endforeach; ?>
                        </div>


                    </div><!--/category-products-->


                    <div class="brands_products">
                        <h2>TODO</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"> <span class="pull-right">(50)</span>TODO</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">РЕЗУЛЬТАТ ПОИСКА</h2>
                    <?php if ($this->error === FALSE): ?>
                        <?php foreach ($this->searchProducts as $product): ?>
                            <a href="/product/<?= $product['id']; ?>/">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="productinfo text-center">
                                            <div class="wrap-img">
                                                <img src="<?= DIRECTORY_SEPARATOR . AdminProduct::$path . $product['id'] . $product['main_image']; ?>" alt="" />
                                            </div>
                                            <div class="wrap-ifo">
                                                <h2><?= $product['price']; ?> грн</h2>
                                                <p><a href="/product/<?= $product['id']; ?>/"><?= $product['name']; ?></a></p>
                                            </div>
                                            <a href="/cart/add/<?= $product['id']; ?>/" class="btn btn-default add-to-cart" data-id="<?= $product['id']; ?>"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?> 
                    <?php else: ?>
                        <h3 class="title text-center">ТОВАРОВ НЕ НАЙДЕНО</h3>
                    <?php endif; ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>