<?php

class View {

    public $template_view = 'template_view.php';
    
    public $content_view;

    public function generate() {
	include_once 'app/views/'. $this->template_view;
    }

}
