<?php

abstract class AbstractController implements defaulTable {

    protected $view;
    
    protected $model_user;
    protected $model_category;
    protected $model_product;
    protected $model_order;
    protected $model_picture;
    
    protected $component_product;
    protected $component_category;
    protected $component_order;

    public function __construct() {
        $this->view = new View();
    }

    public function __call($name, $arguments) {
//	Router::ErrorPage404();
    }

}
