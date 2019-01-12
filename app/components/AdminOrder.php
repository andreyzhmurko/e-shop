<?php

class AdminOrder extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_order = new Model_Order();
        $this->model_product = new Model_Product();
    }

    public function action_index()
    {
        ;
    }

    public function getOrder()
    {
        $this->view->ordersList = $this->model_order->all();
        $this->view->content_view = '/admin/admin_order/index_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function adminUpdateOrder($id)
    {
        // Получаем данные о конкретном заказе
        $user = $this->model_order->selectById($id);

        $this->view->id = $id;

        foreach ($user as $user_data) {
            $this->view->user_name = $user_data['user_name'];
            $this->view->user_phone = $user_data['user_phone'];
            $this->view->user_comment = $user_data['user_comment'];
            $this->view->status = $user_data['status'];
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $user_name = $_POST['user_name'];
            $user_phone = $_POST['user_phone'];
            $user_comment = $_POST['user_comment'];
            $status = $_POST['status'];

            // Сохраняем изменения
            $this->model_order->updateOrderById($id, $user_name, $user_phone, $user_comment, $status);

            // Перенаправляем пользователя на страницу управлениями заказами
            header("Location: /admin/view_order/$id");
        }

        // Подключаем вид
        $this->view->content_view = '/admin/admin_order/update_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function adminViewOrder($id)
    {

        // Получаем данные о конкретном заказе
        $order = $this->view->order = $this->model_order->selectById($id);

        foreach ($order as $order_item) {
            // Получаем массив с идентификаторами и количеством товаров
            $productsQuantity = $this->view->productsQuantity = json_decode($order_item['products'], true);
        }

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = $this->view->products = $this->model_product->getProdustsById($productsIds);

        // Подключаем вид
        $this->view->content_view = '/admin/admin_order/view_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function adminDeleteOrder($id)
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            $this->model_order->deleteById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }

        $orderById = $this->model_order->selectById($id);
        foreach ($orderById as $order_item) {
            $this->view->id = $order_item['id'];
        }

        $this->view->content_view = '/admin/admin_order/delete_view.php';
        $this->view->generate();
    }

}
