<?php

namespace mvc;

use mvc\View;

abstract class Controller{
    
    public $route;
    public $view;
    
    public function __construct($route){
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->load_model($route['controller']);
    }
    
    private function load_model($name){
        $path = "{$this->route['app_name']}\models\\" . ucfirst($name) . 'Model';
        if (class_exists($path)){
            return new $path();
        }
    }
    
    /* ~~~~~~~~~~~~~~~~~~~~~~~~ Not used yet ~~~~~~~~~~~~~~~~~~~~~~~~
    
    function check_acl(){
        $this->acl = require 'application\acl\\'.$this->route['controller'].'.php';
        if ($this->is_acl('all')){
            return True;
        } else if (isset($_SESSION['autorize']['id']) and $this->is_acl('autorize')){
            return True;
        } else if (!isset($_SESSION['autorize']['id']) and $this->is_acl('guest')){
            return True;
        } else if (isset($_SESSION['admin']) and $this->is_acl('admin')){
            return True;
        }
        return False;
    }
    
    function is_acl($key){
        return in_array($this->route['action'], $this->acl[$key]);
    }
    
    */
}
?>