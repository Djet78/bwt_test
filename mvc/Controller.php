<?php

namespace mvc;

use mvc\View;
use mvc\UserInputHandler;

abstract class Controller{
    
    public $route;
    public $view;
    public $model;
    public $post_handler;
    public $get_handler;
    
    function __construct($route){
        $this->route = $route;
        $this->view = new View($route);
        if (!$this->user_has_access()){
            $this->view::redirect_by_name('login');
        }
        $this->model = $this->load_model($route['controller']);
        $this->post_handler = new UserInputHandler('POST');
        $this->get_handler = new UserInputHandler('GET');
    }
    
    private function user_has_access(){
        $required_perm = $this->route['perm'];
        $user_group = $_SESSION['user_group'];
        if ($required_perm == 'all'){
            return True;
        } else if ($user_group == $required_perm){
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
    
    function handle_input(string $http_method, $required_fields = [], $process_fields = []){
        $http_method = strtoupper($http_method);
        $handler = $this->get_user_input_handler($http_method);
        
        $handler->have_required_fields($required_fields);
     
        foreach($process_fields as $field => $funcs){
            
            // Skip proccesing for that field
            $is_empty_and_not_required = $handler->is_empty_field($field) && !in_array($field, $required_fields);
            if($is_empty_and_not_required){
                continue;
            }
            
            foreach($funcs as list($func, $params)){
                $params['field'] = $field;
                call_user_func_array([$handler, $func], $params);
            }
        }
    }
    
    private function get_user_input_handler(string $http_method){
        if ($http_method == 'POST'){
            return $this->post_handler;
        } else if ($http_method == 'GET'){
            return $this->get_handler;
        } else {
            // Throw exception
        }
    }
}
?>