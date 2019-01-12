<?php

class Controller_Contacts extends AbstractController{
    public function __construct() {
        parent::__construct();
    }
    
    public function action_index() {
        $this->view->content_view='/contacts/contacts_view.php';
        $this->view->generate();
    }
}
