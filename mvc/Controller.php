<?php
namespace mvc;

use mvc\View;
use mvc\UserInputHandler;

abstract class Controller
{
    
    public $route;
    public $view;
    public $model;
    public $post_handler;
    public $get_handler;
    
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        if (!$this->userHasAccess()) {
            $this->view::redirectByName('login');
        }
        $this->model = $this->loadModel($route['controller']);
        $this->post_handler = new UserInputHandler('POST');
        $this->get_handler = new UserInputHandler('GET');
    }
    
    private function userHasAccess()
    {
        $required_perm = $this->route['perm'];
        $user_group = $_SESSION['user_group'];
        if ($required_perm == 'all') {
            return true;
        } elseif ($user_group == $required_perm) {
            return true;
        }
        return false;
    }
    
    private function loadModel($name)
    {
        $path = "{$this->route['app_name']}\models\\" . ucfirst(strtolower($name)) . 'Model';
        if (class_exists($path)) {
            return new $path();
        }
    }
    
    public function handleInput(string $http_method, $required_fields, $process_fields)
    {
        $http_method = strtoupper($http_method);
        $handler = $this->getUserInputHandler($http_method);
        
        $handler->haveRequiredFields($required_fields);
     
        foreach ($process_fields as $field => $funcs) {
            
            // Skip proccesing for that field
            $is_empty_and_not_required = $handler->isEmptyField($field) && !in_array($field, $required_fields);
            if($is_empty_and_not_required){
                continue;
            }
            
            foreach ($funcs as list($func, $params)) {
                $params['field'] = $field;
                call_user_func_array([$handler, $func], $params);
            }
        }
    }
    
    private function getUserInputHandler(string $http_method)
    {
        if ($http_method == 'POST'){
            return $this->post_handler;
        } else if ($http_method == 'GET'){
            return $this->get_handler;
        } else {
            // Throw exception
        }
    }
}
