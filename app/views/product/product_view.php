<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>КАТЕГОРИИ</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($this->categories as $category): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= $category['id']; ?>/">
                                            <?= $category['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <?php foreach ($this->product as $productItem): ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="productinfo text-center">
                                    <div class="product-slider disabled">
                                        <?php foreach ($this->images_path as $path): ?>
                                            <div class="view-product">
                                                <img src="<?= DIRECTORY_SEPARATOR . $path['image_path']; ?>" alt="" />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="product-slider-nav">
                                        <?php foreach ($this->images_path as $path): ?>
                                            <div class="view-product">
                                                <img class="ss" src="<?= DIRECTORY_SEPARATOR . $path['image_path']; ?>" alt="" />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="product-information"><!--/product-information-->
                                    <h2><?= $productItem['name']; ?></h2>
                                    <p>Код товара: <?= $productItem['id']; ?></p>
                                    <span>
                                        <span><?= $productItem['price']; ?> грн</span>
                                        <a href="#" data-id="<?= $productItem['id']; ?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </span>
                                    <?php $availability = ($productItem['availability'] == '1') ? 'Есть' : 'Нет'; ?>
                                    <p><b>Наличие: <?= $availability; ?></b></p>
                                    <p><b>Производитель: Apple</b></p>
                                </div><!--/product-information-->
                            </div>
                        </div>
                        <div class="row">                                
                            <div class="col-sm-12">
                                <br/>
                                <h5>Описание <?= $productItem['name']; ?></h5>
                                <?= nl2br($productItem['description']); ?>
                                <br/>
                                <h5>Основные характеристики</h5>
                                <?php
                                $specifications = explode(';;', $productItem['specifications']);
                                ?>
                                <ol class="list-type">
                                    <?php foreach ($specifications as $item): ?>
                                        <li><?= $item; ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--/product-details-->

            </div>
        </div>
        <!--        <ul class="pgwSlider">
                    <li><img src="/app/template/upload/images/products/12165.jpg"></li>
                    <li><img src="/app/template/upload/images/products/montreal_mini.jpg" alt="Montréal, QC, Canada" data-large-src="/app/template/upload/images/products/12166.jpg"></li>
                    <li>
                        <img src="/app/template/upload/images/products/12167.jpg">
                    </li>
                    <li>
                            <img src="/app/template/upload/images/products/12168.jpg">
                    </li>
                </ul>-->
    </div>
</section>