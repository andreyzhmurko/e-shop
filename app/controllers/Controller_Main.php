<?php

class Controller_Main extends AbstractController {

    public function __construct() {
        parent::__construct();
        $this->model_category = new Model_Category();
        $this->model_product = new Model_Product();
    }

    public function action_index() {
        $this->view->categories = $this->model_category->all();
        $this->view->products = $this->model_product->getLatestProducts();
        $this->view->recommended_products = $this->model_product->getRecommendedProducts();
        $this->view->content_view = 'main/main_view.php';
        $this->view->generate();
    }
    
}
