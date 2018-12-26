<?php
namespace mvc;

use mvc\view\View;
use mvc\utils\UserInputHandler;

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
            if ($_SESSION['user_group'] != 'autorized') {
                $this->view::redirectByName('login');
            } else {
                $this->view::redirectByName('homepage');
            }
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
}
