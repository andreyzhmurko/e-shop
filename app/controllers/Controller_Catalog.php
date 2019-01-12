<?php

class Controller_Catalog extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_category = new Model_Category();
        $this->model_product = new Model_Product();
    }

    public function action_index()
    {
        $this->view->categories = $this->model_category->all();
        $pagination = $this->model_product->pagination();
        $start = $pagination[0];
        $limit = $pagination[1];
        $this->view->current_page = $this->view->page = $page = $pagination[2];
        $this->view->total = $total = $pagination[3];
        $this->view->products = $this->model_product->getLatestProducts($start, $limit);
        $this->view->content_view = '/catalog/catalog_view.php';
        $this->view->generate();
    }

}
