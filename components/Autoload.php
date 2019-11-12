<?php

function __autoload($class_name)
{
    $array_paths = array(
        '/models/',
        '/components/',
        '/vendor/intervention/image/src/Intervention/Image/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}

//spl_autoload_register(function ($class_name) {
//    $array_paths = array(
//        '/models/',
//        '/components/'
//    );
//
//    foreach ($array_paths as $path) {
//        $path = ROOT . $path . $class_name . '.php';
//        if (is_file($path)) {
//            include_once $path;
//        }
//    }
//});
