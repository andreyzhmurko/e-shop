<?php

class Controller_Product extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_category = new Model_Category();
        $this->model_product = new Model_Product();
        $this->model_picture = new Model_Picture();
    }

    public function action_index()
    {
        
    }

    public function __call($name, $arguments)
    {
        $this->view->categories = $this->model_category->all();
        $name_components = explode('_', $name);
        $product_id = $name_components[1];
        $product = $this->model_product->selectById($product_id);
        $images = $this->model_picture->getPicturePath($product_id);
        if ($product) {
            $this->view->product = $product;
            $this->view->images_path = $images;
            $this->view->content_view = '/product/product_view.php';
            $this->view->generate();
        } else {
            Router::ErrorPage404();
        }
    }

}
