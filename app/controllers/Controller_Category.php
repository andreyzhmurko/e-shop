<?php

class Controller_Category extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_category = new Model_Category();
        $this->model_product = new Model_Product();
    }

    public function action_index()
    {
        
    }

    public function __call($name, $arguments)
    {
        $this->view->categories = $this->model_category->all();
        $name_components = explode('_', $name);
        $category_id = $name_components[1];
        $this->view->category_id = $category_id;
        $pagination = $this->model_product->pagination($category_id);
        $start = $pagination[0];
        $limit = $pagination[1];
        $this->view->current_page = $this->view->page = $page = $pagination[2];
        $this->view->total = $total = $pagination[3];
        $products = $this->model_product->selectProductsByCategoryId($category_id, $start, $limit);
        if ($products) {
            $this->view->products = $products;
            $this->view->content_view = '/category/category_view.php';
            $this->view->generate();
        } else {
            Router::ErrorPage404();
        }
    }

}
