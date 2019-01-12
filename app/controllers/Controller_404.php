<?php

class Controller_404 extends AbstractController{
    public function __construct() {
        parent::__construct();
    }
    
    public function action_index() {
        $this->view->content_view = '/404/404_view.php';
        $this->view->generate();
    }
}
