<?php

class AdminProduct extends AbstractController
{

    public static $path = "app/template/upload/images/products/";

    public function __construct()
    {
        parent::__construct();
        $this->model_product = new Model_Product();
        $this->model_category = new Model_Category();
        $this->model_picture = new Model_Picture();
    }

    public function action_index()
    {
        
    }

    public function getProduct()
    {
        $this->view->productsList = $this->model_product->all();
        $this->view->content_view = '/admin/admin_product/index_view.php';
        $this->view->generate();
    }

    public function adminDeleteProduct($id)
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            $this->model_product->deleteById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product");
        }
        $productById = $this->model_product->selectById($id);
        foreach ($productById as $product_item) {
            $this->view->name = $product_item['name'];
        }
        $this->view->content_view = '/admin/admin_product/delete_view.php';
        $this->view->generate();
    }

    public function adminCreateProduct()
    {

        // Получаем список категорий для выпадающего списка
        $this->view->categoriesList = $this->model_category->all();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $product['name'] = $_POST['name'];
            $price = preg_replace('/\s+/', '', $_POST['price']);
            $product['price'] = number_format($price, 0, '.', ' ');
            $product['category_id'] = $_POST['category_id'];
//            $options['brand'] = $_POST['brand'];
            $product['image'] = '_' . $_FILES['image']['name'][0];
            $product['availability'] = $_POST['availability'];
            $product['description'] = $_POST['description'];
            $product['specifications'] = $_POST['specifications'];
            $product['is_recommended'] = $_POST['is_recommended'];
            $product['status'] = $_POST['status'];
//            var_dump($proudct['image']);
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($product['name']) || empty($product['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = $this->model_product->createProduct($product);

                // Если запись добавлена
                if ($id) {
                    for ($i = 0; $i <= 2; $i++) {
                        $tmp_name = $_FILES["image"]["tmp_name"][$i];
                        // Проверим, загружалось ли через форму изображение
                        if (is_uploaded_file($tmp_name)) {
                            $name = $id . '_' . basename($_FILES['image']['name'][$i]);
                            $path = self::$path . $name;
                            move_uploaded_file($tmp_name, $path);
                        }
                        $this->view->pictures = $this->model_picture->addPicture($path, $id);
                    }
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }
        $this->view->content_view = '/admin/admin_product/create_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function adminUpdateProduct($id)
    {

        // Получаем список категорий для выпадающего списка
        $this->view->categoriesList = $this->model_category->all();

        // Получаем данные о конкретном заказе
        $product = $this->model_product->selectById($id);

        $this->view->id = $id;

        foreach ($product as $product_item) {
            $this->view->name = $product_item['name'];
            $this->view->price = $product_item['price'];
            $this->view->category_id = $product_item['category_id'];
            $this->view->availability = $product_item['availability'];
            $this->view->description = $product_item['description'];
            $this->view->specifications = $product_item['specifications'];
            $this->view->is_recommended = $product_item['is_recommended'];
            $this->view->status = $product_item['status'];
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $product['id'] = $_POST['id'];
            $product['name'] = $_POST['name'];
            $price = preg_replace('/\s+/', '', $_POST['price']);
            $product['price'] = number_format($price, 0, '.', ' ');
            $product['category_id'] = $_POST['category_id'];
            $product['image'] = '_' . $_FILES['image']['name'][0];
            $product['availability'] = $_POST['availability'];
            $product['description'] = $_POST['description'];
            $product['specifications'] = $_POST['specifications'];
            $product['is_recommended'] = $_POST['is_recommended'];
            $product['status'] = $_POST['status'];

            // Сохраняем изменения
            if ($this->model_product->updateProductById($id, $product)) {
                $images = $this->model_picture->getPicturePath($id);
                for ($i = 0; $i <= 2; $i++) {
                    $tmp_name = $_FILES["image"]["tmp_name"][$i];
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($tmp_name)) {
                        $name = $id . '_' . basename($_FILES['image']['name'][$i]);
                        $path = self::$path . $name;
                        $pictureId = $images[$i]['id'];
                        move_uploaded_file($tmp_name, $path);
                    }
                    $this->view->pictures = $this->model_picture->updatePicture($path, $id, $pictureId);
                }
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product");
        }
        $this->view->images_path = $this->model_picture->getPicturePath($id);
        $this->view->content_view = '/admin/admin_product/update_view.php';
        $this->view->generate();
    }

}
