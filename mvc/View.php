<?php

namespace mvc;

class View{
    
    private $path;
    private $layout = 'default';
        
    function __construct($route){
        $this->path = "{$route['app_name']}/views/{$route['controller']}/{$route['action']}.php";
    }
    
    /**
     *@param string $title   Used in <title> tag in the '$this->layout'
     *@param array  $context  Used to access extra data in views
     */
    function render($title, $context = []){
        extract($context);
        if (file_exists($this->path)){
            ob_start();
            require $this->path;
            $content = ob_get_clean();
            require BASE_DIR . "/layouts/{$this->layout}.php";
        } else {
            echo 'No such view ' . $this->path;
        }
    }
    
    static function render_error_page($code){
        http_response_code($code);
        $path = BASE_DIR ."/mvc/view_errors/{$code}.php";
        if (file_exists($path)){
            require $path;
        } else {
            echo 'No such error view ' . $path;
        }
        exit;
    }
    
    static function redirect($url){
        header("location: $url");
        exit;
    }
    
    static function redirect_by_name($url_name){
        $routes = require BASE_DIR . '/routes.php';
        foreach ($routes as $url => $params){
            if ($url_name == $params['name']){
                self::redirect($url);
            }
        }
    }
}
?>