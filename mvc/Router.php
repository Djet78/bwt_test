<?php

namespace mvc;

use mvc\View;

class Router {
    
    protected $routes = [];
    protected $params = [];
    
    function __construct(){
        $routes = require BASE_DIR . '/routes.php';
        foreach($routes as $url => $params){
            $this->add_route($url, $params);
        }
    }
    
    /** 
     * Transforms url into a string, accepted by 'preg_match()'
     * and save it in '$this->routes'
     */
    private function add_route($route, $params){
        $route = '#^'.$route.'/?$#';
        $this->routes[$route] = $params;
    }

    function run(){
        if ($this->is_match()){
            $controller = "{$this->params['app_name']}\controllers\\" . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($controller)){
                $method = $this->params['action'];
                if (method_exists($controller, $method)){
                    $controller= new $controller($this->params);
                    $controller->$method();
                } else {
                    View::render_error_page(404);
                }
            } else {
                View::render_error_page(404);
            }
        } else {
            View::render_error_page(404);
        }
    }   
    
    private function is_match(){
        $url = ltrim($_SERVER['REQUEST_URI'], '/');
        foreach($this->routes as $route => $params){
            if (preg_match($route, $url)){
                $this->params = $params;
                return True;
            }
        }
        return False;
    }
}


?>