<?php

class Controller_Search extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model_product = new Model_Product();
        $this->model_category = new Model_Category();
    }

    public function action_index()
    {
        $search = trim($_POST['search']);
        $error = false;
        $result = $this->view->searchProducts = $this->model_product->search($search);
        if (!$result) {
            $error = true;
        }

        $this->view->error = $error;
        $this->view->categories = $this->model_category->all();
        $this->view->content_view = '/catalog/search_view.php';
        $this->view->generate();
    }

}
