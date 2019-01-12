<?php

class AbstractModel
{

    protected $db;
    public $table;

    public function __construct()
    {
        $this->db = Db::getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = '1'";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function selectById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = " . $id;
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = " . $id;
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        }
        return false;
    }

}
