<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_User
 *
 * @author Андрей
 */
class Model_User extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function register($name, $email, $password)
    {
        $query = "INSERT INTO " . $this->table . " (name, email, password) VALUES ('" . $name . "', '" . $email . "', '" . $password . "')";
        return $this->db->query($query);
    }

    public function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public function checkPassword($password, $password_confirm = NULL)
    {
        if ((strlen($password) >= 6) || (strlen($password_confirm) >= 6)) {
            return true;
        }
        return false;
    }

    public function checkPasswordCompare($password, $password_confirm)
    {
        if ($password == $password_confirm) {
            return true;
        }
        return false;
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkEmailExists($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = '" . $email . "'";
        $result = $this->db->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($result)) {
            return true;
        }
        return false;
    }

    public function checkUserData($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = '" . $email . "' AND password = '" . $password . "'";
        $result = $this->db->query($query);

// Обращаемся к записи
        $user = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($user as $value) {
            $user = $value['id'];
        }

        if ($user) {
// Если запись существует, возвращаем id пользователя
            return $user;
        }
        return false;
    }

    public function userAuth($userId)
    {
// Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    public function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login/");
    }

    public function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    public function edit($id, $name, $password)
    {
        $query = "UPDATE " . $this->table . " SET name = '" . $name . "', password = '" . $password . "' WHERE id = " . $id;
        return $this->db->query($query);
    }

}
