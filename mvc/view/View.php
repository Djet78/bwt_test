<?php
namespace mvc\view;

require 'view_errors.php';

use NoViewError;

/**
 * Implemets page rendering and redirections
 */
class View
{    
    /**
     * @var string  Contain path to specified view
     */
    private $path;
        
    public function __construct($route)
    {
        $this->path = "{$route['app_name']}/views/{$route['controller']}/{$route['action']}.php";
    }
    
    /**
     * Render view from '$this->path' within given $layout
     *
     * @param string   $layout Name for used layout
     * @param string   $title   Used in <title> tag in the 'layout'
     * @param array    $context  Used to pass extra data in views
     *
     * @throws NoViewError
     */
    public function render($layout, $title, $context = [])
    {
        extract($context);
        if (file_exists($this->path)) {
            ob_start();
            require $this->path;
            $content = ob_get_clean();
            require "assets/layouts/{$layout}.php";
        } else {
            throw new NoViewError('No such view ' . $this->path);
        }
    }
    
    public static function renderErrorPage($code)
    {
        http_response_code($code);
        $path = BASE_DIR ."/mvc/view/http_error_pages/{$code}.php";
        if (file_exists($path)) {
            require $path;
        } else {
            require BASE_DIR ."/mvc/view/http_error_pages/default_error_page.php";
        }
        exit;
    }
    
    public static function redirect($url)
    {
        header("location: /$url");
        exit;
    }
    
    /**
     * Simple redirect but it searches url in '/routes.php' by name 
     */
    public static function redirectByName($url_name)
    {
        $routes = require BASE_DIR . '/routes.php';
        foreach ($routes as $url => $params) {
            if ($url_name == $params['name']) {
                self::redirect($url);
            }
        }
    }
}
