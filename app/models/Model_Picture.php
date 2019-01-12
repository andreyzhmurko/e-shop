<?php

class Model_Picture extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'pictures';
    }

    public function addPicture($path, $id)
    {
        $query = "INSERT INTO " . $this->table . " (image_path, product_id) "
                . "VALUES ('" . $path . "', '" . $id . "')";

        $result = $this->db->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function updatePicture($path, $id, $pictureId)
    {
        $query = "UPDATE " . $this->table . " SET image_path = '" . $path . "' WHERE id = $pictureId AND product_id = $id";
        $result = $this->db->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function getPicturePath($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE product_id = " . $id;

        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

}
