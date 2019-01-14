<?php

class Router
{

    public static $title;

    public static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $url = strtolower($_SERVER['REQUEST_URI']);
        $routes = explode('/', $url);

        $parameters = intval($routes[3]);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            self::$title = $controller_name = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller = 'Controller_' . ucfirst($controller_name);
        $action = 'action_' . $action_name;

        if (class_exists($controller)) {
            $obj = new $controller();
            if (is_numeric($action_name)) {
                //для переадресации числовых методов на __call
                $obj->$action($parameters);
            } else {
                if (method_exists($obj, $action)) {
                    $obj->$action($parameters);
                } else {
                    self::ErrorPage404();
                }
            }
        } else {
            self::ErrorPage404();
        }
    }

    public static function ErrorPage404()
    {
        //$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        //header('HTTP/1.1 404 Not Found');
        //header("Status: 404 Not Found");
        //header('Location:' . $host . '404');
		header('Location:' . '/404');
    }

}
