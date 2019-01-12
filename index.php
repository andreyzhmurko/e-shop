<?php

session_start();

//ini_set('display_errors', 1);

require_once 'app/components/autoloader.php';

$router = new Router();
$router->start();