<?php 
namespace mvc\utils;

spl_autoload_register(function($class){
   $path = $class . '.php';
   if (file_exists($path)){
       require $path;
   }
});

?>