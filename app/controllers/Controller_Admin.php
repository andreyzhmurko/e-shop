<?php
class Controller_Admin extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_user = new Model_User();
        $this->component_product = new AdminProduct();
        $this->component_category = new AdminCategory();
        $this->component_order = new AdminOrder();
        $this->checkAdmin();
    }

    public function action_index()
    {
        $this->view->content_view = '/admin/admin_view.php';
        $this->view->generate();
    }

    public function checkAdmin()
    {
        $userId = $this->model_user->checkLogged();

        $user = $this->model_user->selectById($userId);
        foreach ($user as $user_item) {
            if ($user_item['role'] == 'admin') {
                return true;
            }
        }

        // Если роль текущего пользователя "admin", пускаем его в админпанель
        // Иначе завершаем работу с сообщением об закрытом доступе
        die('Access denied');
    }

    // CRUD Products

    public function action_product()
    {
        $this->component_product->getProduct();
    }

    public function action_delete_product($id)
    {
        $this->component_product->adminDeleteProduct($id);
    }

    public function action_create_product()
    {
        $this->component_product->adminCreateProduct();
    }

    public function action_update_product($id)
    {
        $this->component_product->adminUpdateProduct($id);
    }

    // CRUD Categories

    public function action_category()
    {
        $this->component_category->getCategory();
    }

    public function action_create_category()
    {
        $this->component_category->adminCreateCategory();
    }

    public function action_delete_category($id)
    {
        $this->component_category->adminDeleteCategory($id);
    }

    public function action_update_category($id)
    {
        $this->component_category->adminUpdateCategory($id);
    }

    // CRUD Orders
    public function action_order()
    {
        $this->component_order->getOrder();
    }

    public function action_delete_order($id)
    {
        $this->component_order->adminDeleteOrder($id);
    }

    public function action_update_order($id)
    {
        $this->component_order->adminUpdateOrder($id);
    }

    public function action_view_order($id)
    {
        $this->component_order->adminViewOrder($id);
    }

}
