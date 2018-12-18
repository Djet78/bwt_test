<?php

namespace mvc;

use mvc\View;

class Router {
    
    protected $routes = [];
    protected $params = [];
    
    function __construct(){
        $arr = require BASE_DIR . '/routes.php';
        foreach($arr as $key => $val){
            $this->add_route($key, $val);
        }
    }
    
    private function add_route($route, $params) {
        $route = '#^'.$route.'/?$#';
        $this->routes[$route] = $params;
    }
 
    private function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach($this->routes as $route => $params){
            if (preg_match($route, $url)){
                $this->params = $params;
                return True;
            }
        }
        return False;
    }

    function run() {
        if ($this->match()){
            $path = "{$this->params['app_name']}\controllers\\" . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)){
                $action = $this->params['action'];
                if (method_exists($path, $action)){
                    $controller= new $path($this->params);
                    $controller->$action();
                } else {
                    View::error_code(404);
                }
            } else {
                View::error_code(404);
            }
        } else {
            View::error_code(404);
        }
    }    
}


?>