<?php 
namespace mvc\utils;

/**
 * Autoloader for mvc classes
 */
spl_autoload_register(function($class) {
        $path = "{$class}.php";
        if (file_exists($path)) {
            require $path;
        }
    }
);
