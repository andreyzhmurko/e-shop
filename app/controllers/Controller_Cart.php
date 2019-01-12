<?php

class Controller_Cart extends AbstractController {

    public function __construct() {
        parent::__construct();
        $this->model_category = new Model_Category();
        $this->model_product = new Model_Product();
        $this->model_user = new Model_User();
        $this->model_order = new Model_Order();
    }

    public function action_index() {
        $this->view->categories = $this->model_category->all();

        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = $this->view->productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsId = array_keys($productsInCart);

            $products = $this->view->products = $this->model_product->getProdustsById($productsId);

            // Получаем общую стоимость товаров
            $this->view->total_price = Cart::getTotalPrice($products);
        }
        $this->view->content_view = '/cart/cart_view.php';
        $this->view->generate();
    }

    public function action_add($id) {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        echo Cart::addProduct($id);
        return true;
    }

    public function action_delete($id) {
        // Удаляем заданный товар из корзины
        Cart::deleteProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }

    public function action_checkout() {
        // Получием данные из корзины      
        $productsInCart = Cart::getProducts();

        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорий для левого меню
        $this->view->categories = $this->model_category->all();

        // Находим общую стоимость
        $productsId = array_keys($productsInCart);
        $products = $this->view->products = $this->model_product->getProdustsById($productsId);
        $this->view->total_price = Cart::getTotalPrice($products);

        // Количество товаров
        $totalQuantity = $this->view->total_quantity = Cart::countItems();

        // Поля для формы
        $userName = false;
        $userPhone = false;
        $userComment = false;

        // Статус успешного оформления заказа
        $result = false;

        // Проверяем является ли пользователь гостем
        if (!$this->model_user->isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = $this->model_user->checkLogged();
            $user = $this->model_user->selectById($userId);
            foreach ($user as $user_item) {
                $userName = $user_item['name'];
            }
            $this->view->user_name = $userName;
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = 0;
        }
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = $this->view->user_name = $_POST['userName'];
            $userPhone = $this->view->user_phone = $_POST['userPhone'];
            $userComment = $this->view->user_comment = $_POST['userComment'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!$this->model_user->checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!$this->model_user->checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }

            $this->view->errors = $errors;

            if ($errors == false) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных

                $result = $this->view->result = $this->model_order->save($userName, $userPhone, $userComment, $userId, $productsInCart);
                if ($result) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте                
                    $adminEmail = 'php.start@mail.ru';
                    $message = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }
            }
        }
        $this->view->content_view = '/cart/checkout_view.php';
        $this->view->generate();
    }

}
