<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>КАТЕГОРИИ</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($this->categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id']; ?>/">
                                            <?= $categoryItem['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($this->productsInCart): ?>
                        <p>Вы выбрали такие товары:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стомость, грн</th>
                                <th>Количество, шт</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($this->products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td>
                                        <a href="/product/<?= $product['id']; ?>/">
                                            <?= $product['name']; ?>
                                        </a>
                                    </td>
                                    <td><?= $product['price']; ?></td>
                                    <td><?= $this->productsInCart[$product['id']]; ?></td> 
                                    <td>
                                        <a href="/cart/delete/<?= $product['id']; ?>/">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4">Общая стоимость, грн:</td>
                                <td><?= $this->total_price; ?></td>
                            </tr>

                        </table>

                        <a class="btn btn-default checkout" href="/cart/checkout/"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>
                    <?php else: ?>
                        <h3 class="cart-empty text-center"><i class="fa fa-shopping-cart"></i> Корзина пуста</h3>
                        <div class="text-center">
                            <a class="cart-empty-a btn btn-default checkout" href="/"><h4 class="cart-empty-btn">Вернуться к покупкам</h4></a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>