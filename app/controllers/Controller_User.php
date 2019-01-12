<?php

class Controller_User extends AbstractController {

    public function __construct() {
        parent::__construct();
        $this->model_user = new Model_User();
    }

    public function action_index() {
        
    }

    public function action_register() {
        if (isset($_POST['submit'])) {
            $name = $this->view->name = $_POST['name'];
            $email = $this->view->email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!$this->model_user->checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!$this->model_user->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!$this->model_user->checkPassword($password, $password_confirm)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (!$this->model_user->checkPasswordCompare($password, $password_confirm)) {
                $errors[] = 'Пароли не совпадают';
            }
            if (!$this->model_user->checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Регистрируем пользователя
                $this->view->user = $this->model_user->register($name, $email, $password);
                $userId = $this->model_user->checkUserData($email, $password);
                $this->model_user->userAuth($userId);
                $this->view->content_view = '/auth/register_view.php';
                $this->view->generate();
            } else {
                $this->view->errors = $errors;
                $this->view->content_view = '/auth/register_view.php';
                $this->view->generate();
            }
        }

        $this->view->content_view = '/auth/register_view.php';
        $this->view->generate();
    }

    public function action_login() {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $email = $this->view->email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if ($this->model_user->checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!$this->model_user->checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $userId = $this->model_user->checkUserData($email, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
                $this->view->errors = $errors;
                $this->view->content_view = '/auth/login_view.php';
                $this->view->generate();
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                $this->model_user->userAuth($userId);

//                // Перенаправляем пользователя в закрытую часть - кабинет 
                header("Location: /cabinet");
            }
        }
        $this->view->content_view = '/auth/login_view.php';
        $this->view->generate();
    }

    public function action_logout() {
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);

        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}
