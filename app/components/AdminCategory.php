<?php

class AdminCategory extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_category = new Model_Category();
    }

    public function action_index()
    {
        ;
    }

    public function getCategory()
    {
        $this->view->categoriesList = $this->model_category->all();
        $this->view->content_view = '/admin/admin_category/index_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function adminCreateCategory()
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $status = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }


            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую категорию
                $this->model_category->createCategory($name, $status);

                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/category");
            }
        }

        $this->view->content_view = '/admin/admin_category/create_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function adminUpdateCategory($id)
    {

        // Получаем данные о конкретной категории
        $category = $this->model_category->selectById($id);
        foreach ($category as $category_item) {
            $this->view->name = $category_item['name'];
            $this->view->status = $category_item['status'];
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Сохраняем изменения
            $this->model_category->updateCategoryById($id, $name, $status);

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/category");
        }

        $this->view->content_view = '/admin/admin_category/update_view.php';
        $this->view->generate();
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function adminDeleteCategory($id)
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            $this->model_category->deleteById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }

        $categoryById = $this->model_category->selectById($id);
        foreach ($categoryById as $category_item) {
            $this->view->name = $category_item['name'];
        }
        
        $this->view->content_view = '/admin/admin_category/delete_view.php';
        $this->view->generate();
    }

}
