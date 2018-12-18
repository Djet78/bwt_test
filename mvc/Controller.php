<?php

namespace mvc;

use mvc\View;

abstract class Controller{
    
    public $route;
    public $view;
    public $user_group;
    
    function __construct($route){
        $this->route = $route;
        $this->user_group = $_SESSION['user_group'];
        if (!$this->has_access()){
            View::redirect_by_name('login');
        }
        $this->view = new View($route);
        $this->model = $this->load_model($route['controller']);
    }
    
    private function has_access(){
        $required_perm = $this->route['perm'];
        if ($required_perm == 'all'){
            return True;
        } else if ($this->user_group == $required_perm){
            return True;
        }
        return False;
    }
    
    private function load_model($name){
        $path = "{$this->route['app_name']}\models\\" . ucfirst(strtolower($name)) . 'Model';
        if (class_exists($path)){
            return new $path();
        }
    }
}
?>