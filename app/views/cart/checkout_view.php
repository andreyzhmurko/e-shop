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
                                        <a href="/category/<?= $categoryItem['id']; ?>/">
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


                    <?php if ($this->result): ?>
                        <p>Ваш заказ оформлен. Наш менеджер свяжется с Вами по телефону.</p>
                    <?php else: ?>

                        <p>Выбрано товаров: <?= $this->total_quantity; ?>, на сумму: <?= $this->total_price; ?>, грн</p><br/>

                        <?php if (!$result): ?>                        

                            <div class="col-sm-4">
                                <?php if (isset($this->errors) && is_array($this->errors)): ?>
                                    <ul>
                                        <?php foreach ($this->errors as $error): ?>
                                            <li> - <?= $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>

                                <div class="login-form">
                                    <form method="post">

                                        <p>Ваша имя</p>
                                        <input type="text" name="userName" placeholder="" value="<?= $this->user_name; ?>"/>

                                        <p>Номер телефона</p>
                                        <input type="text" name="userPhone" placeholder="" value="<?= $this->user_phone; ?>"/>

                                        <p>Комментарий к заказу</p>
                                        <input type="text" name="userComment" placeholder="Сообщение" value="<?= $this->user_comment; ?>"/>

                                        <br/>
                                        <br/>
                                        <input type="submit" name="submit" class="btn btn-default" value="Оформить" />
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

