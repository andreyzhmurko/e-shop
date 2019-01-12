<?php

class Model_Product extends AbstractModel
{

    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'products';
    }

    public function selectProductsByCategoryId($id, $start, $limit)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = '1' AND category_id = '" . $id . "' ORDER BY id LIMIT $start, $limit";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function pagination($id = null)
    {
        $limit = Model_Product::SHOW_BY_DEFAULT;
        $page = $_GET['page'];

        if ($id) {
            $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE status = '1' AND category_id = " . $id;
        } else {
            $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE status = '1'";
        }

        $result = $this->db->query($query);
        $result = $result->fetch_all();

        $posts = array_shift($result[0]);
        $total = ceil($posts / $limit);
        $page = intval($page);
        $total = intval($total);

        if (empty($page) or $page < 0) {
            $page = 1;
        }
        if ($page > $total) {
            $page = $total;
        }
        $start = $page * $limit - $limit;

        $paginationItem = array();
        $paginationItem = [$start, $limit, $page, $total];
        return $paginationItem;
    }

    public function getLatestProducts($start = 0, $limit = Model_Product::SHOW_BY_DEFAULT)
    {
        // Текст запроса к БД
        $query = "SELECT id, name, price, main_image FROM " . $this->table
                . " WHERE status = '1' ORDER BY id DESC "
                . "LIMIT $start, $limit";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function getTotalProductsInCategory($categoryId)
    {

        $query = "SELECT count(id) AS count FROM " . $this->table . " WHERE status = '1' AND category_id = " . $categoryId;

        $result = $this->db->query($query);

        // Возвращаем значение count - количество

        $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $item) {
            $count = $item['count'];
        }

        if ($result) {
            return $count;
        }
        return false;
    }

    public function getProdustsById($idArray)
    {
        // Превращаем массив в строку для формирования условия в запросе
        $idString = implode(',', $idArray);
        // Текст запроса к БД
        $query = "SELECT * FROM " . $this->table . " WHERE status='1' AND id IN ($idString)";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function createProduct($product)
    {

        $query = "INSERT INTO " . $this->table
                . " (name, price, category_id, main_image, availability,"
                . " description, specifications, is_recommended, status)"
                . " VALUES "
                . "( '" . $product['name'] . "', '" . $product['price'] . "', '" . $product['category_id'] . "', '" . $product['image'] . "', '" . $product['availability'] . "',"
                . " '" . $product['description'] . "', '" . $product['specifications'] . "', '" . $product['is_recommended'] . "', '" . $product['status'] . "')";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $this->db->query($query);
        $id = $this->db->insert_id;

        if ($result) {
            return $id;
        }
        return false;
    }

    public function updateProductById($id, $product)
    {
        $query = "UPDATE " . $this->table
                . " SET 
                name = '" . $product['name'] . "', 
                price = '" . $product['price'] . "', 
                category_id = '" . $product['category_id'] . "', 
                main_image = '" . $product['image'] . "',
                availability = '" . $product['availability'] . "', 
                description = '" . $product['description'] . "',  
                specifications = '" . $product['specifications'] . "',
                is_recommended = '" . $product['is_recommended'] . "', 
                status = '" . $product['status'] . "' 
            WHERE id = " . $id;

        $result = $this->db->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function getRecommendedProducts()
    {

        // Получение и возврат результатов
        $query = "SELECT id, name, price, main_image FROM " . $this->table
                . " WHERE status = '1' AND is_recommended = '1' "
                . "ORDER BY id ASC LIMIT 25";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public static function getImage($id)
    {
//         Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/app/template/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    public function search($string)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE '%$string%'";

        $result = $this->db->query($query);
        if ($result->num_rows === 0) {
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function getImages($product_id)
    {
        $query = "SELECT * FROM pictures WHERE product_id = " . $product_id;

        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

}
