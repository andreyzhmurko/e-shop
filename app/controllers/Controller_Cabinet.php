<?php

class Controller_Cabinet extends AbstractController {

    public function __construct() {
        parent::__construct();
        $this->model_user = new Model_User();
    }

    public function action_index() {
        $userId = $this->model_user->checkLogged();

        // Получаем информацию о пользователе из БД
        $this->view->user = $this->model_user->selectById($userId);
        $this->view->content_view = '/user/cabinet_view.php';
        $this->view->generate();
    }

    public function action_edit() {
        $userId = $this->model_user->checkLogged();

        // Получаем информацию о пользователе из БД
        $user = $this->view->user = $this->model_user->selectById($userId);

        // Заполняем переменные для полей формы
        foreach ($user as $user_item) {
            $this->view->name = $user_item['name'];
        }

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name =  $_POST['name'];
            $password =  $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!$this->model_user->checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!$this->model_user->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            $this->view->errors = $errors;

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = $this->view->result = $this->model_user->edit($userId, $name, $password);
            }
        }
        $this->view->content_view = '/user/edit_view.php';
        $this->view->generate();
    }

}
