<?php

class Model_Order extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'orders';
    }

    public function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);

        // Текст запроса к БД
        $query = "INSERT INTO " . $this->table . " (user_name, user_phone, user_comment, user_id, products) "
                . "VALUES ('" . $userName . "', '" . $userPhone . "', '" . $userComment . "', '" . $userId . "', '" . $products . "')";

        $result = $this->db->query($query);

        if ($result) {
            return $result;
        }
        return false;
    }

    public function updateOrderById($id, $user_name, $user_phone, $user_comment, $status)
    {

        // Текст запроса к БД
        $query = "UPDATE " . $this->table
                . " SET 
                user_name = '" . $user_name . "', 
                user_phone = '" . $user_phone . "', 
                user_comment = '" . $user_comment . "',  
                status = '" . $status . "'
            WHERE id = " . $id;

        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }
        return false;
    }

    public function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }

}
