<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin/">Админпанель</a></li>
                    <li><a href="/admin/product/">Управление товарами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>
            <h4>Редактировать товар " <?= $this->name; ?> "</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="<?= $this->name ?>">

                        <p>Стоимость, грн</p>
                        <input type="text" name="price" placeholder="" value="<?= $this->price; ?>">
                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($this->categoriesList)): ?>
                                <?php foreach ($this->categoriesList as $category): ?>
                                    <option value="<?= $category['id']; ?>" 
                                            <?php if ($this->category_id == $category['id']) echo ' selected="selected"'; ?>>
                                                <?= $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>


                        <p>Изображение товара</p>
                        <?php foreach ($this->images_path as $path): ?>
                            <img src="<?= DIRECTORY_SEPARATOR . $path['image_path']; ?>" width="200" alt="" />
                            <input type="file" name="image[]">
                        <?php endforeach; ?>
                        <br/>
                        
                        <p>Детальное описание</p>
                        <textarea name="description" rows="15"><?= $this->description; ?></textarea>

                        <br/><br/>

                        <p>Основные характеристики</p>
                        <textarea name="specifications" rows="15"><?= $this->specifications; ?></textarea>

                        <br/><br/>

                        <p>Наличие на складе</p>
                        <select name="availability">
                            <?php $product['availability'] = $this->availability; ?>
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>

                        <br/><br/>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <?php $product['is_recommended'] = $this->is_recommended; ?>
                            <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <?php $product['status'] = $this->status; ?>
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>