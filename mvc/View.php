<?php

namespace mvc;

class View{
    
    public $path;
    public $layout = 'default';
        
    public function __construct($route){
        $this->path = "{$route['app_name']}/views/{$route['controller']}/{$route['action']}.php";
    }

    public function render($title, $vars = []){
        extract($vars);
        if (file_exists($this->path)){
            ob_start();
            require $this->path;
            $content = ob_get_clean();
            require BASE_DIR . "/layouts/{$this->layout}.php";
        } else {
            echo 'No such view ' . $this->path;
        }
    }
    
    public static function error_code($code){
        http_response_code($code);
        $path = BASE_DIR .'/mvc/view_errors/' . $code . '.php';
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
        $urls = require BASE_DIR . '/routes.php';
        foreach ($urls as $url => $params){
            if ($url_name == $params['name']){
                self::redirect($url);
            }
        }
    }
}
?>