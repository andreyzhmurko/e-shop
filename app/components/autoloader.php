<?php

function __autoload($class_name) {
    // Массив папок
    $array_paths = array(
        'app/components/',
        'app/models/',
        'app/core/',
        'app/controllers/',
    );

    foreach ($array_paths as $path) {

        $path = $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
}
