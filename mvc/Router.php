<?php
namespace mvc;

use mvc\view\View;

/**
 * Coordinates application work flow
 *
 * Takes passed url and searches through all specified routes to find corresponding one,
 * pass required data from route to contoller and run controller corresponding method.
 */
class Router
{
    /**
     * @var array  All routes specified in '/routes.php' file pathed through 'addRoute' method
     */
    protected $routes = [];
    
    /**
     * @var array  Matched route params
     */
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
    
    /**
     * MVC starting point
     *
     * Searches for appropriate controller and call its method specified in routes
     *
     * Redirect to 404 error page with 404 responce code if:
     *     No routes match
     *     Controller absent
     *     Controller method absent
     */
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
    
    /**
     * Searches match for url in registered routes
     *
     * @return bool
     */
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
