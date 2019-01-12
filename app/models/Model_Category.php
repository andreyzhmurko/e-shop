<?php

class Model_Category extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'categories';
    }

    public function createCategory($name, $status)
    {
        $query = "INSERT INTO " . $this->table . " (name, status) "
                . "VALUES ('" . $name . "', '" . $status . "')";

        $result = $this->db->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function updateCategoryById($id, $name, $status)
    {
        $query = "UPDATE " . $this->table
                . " SET 
                name = '" . $name . "', 
                status = '" . $status . "'
            WHERE id = " . $id;

        $result = $this->db->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

}
