<?php
namespace mvc;

use mvc\view\View;

class Router
{
    protected $routes = [];
    protected $params = [];
    
    public function __construct()
    {
        $routes = require BASE_DIR . '/routes.php';
        foreach ($routes as $url => $params) {
            $this->addRoute($url, $params);
        }
    }
    
    /** 
     * Transforms url into a string, accepted by 'preg_match()'
     * and save it in '$this->routes'
     */
    private function addRoute($route, $params)
    {
        $route = '#^'.$route.'/?$#';
        $this->routes[$route] = $params;
    }

    public function run()
    {
        if ($this->isMatch()) {
            $controller = "{$this->params['app_name']}\controllers\\" . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($controller)) {
                $method = $this->params['action'];
                if (method_exists($controller, $method)) {
                    $controller= new $controller($this->params);
                    $controller->$method();
                } else {
                    View::renderErrorPage(404);
                }
            } else {
                View::renderErrorPage(404);
            }
        } else {
            View::renderErrorPage(404);
        }
    }   
    
    private function isMatch()
    {
        $url = ltrim($_SERVER['REQUEST_URI'], '/');
        // Remove get prameters from url
        $url = explode('?', $url)[0];
        
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
}
