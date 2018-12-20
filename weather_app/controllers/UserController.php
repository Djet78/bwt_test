<?php

namespace weather_app\controllers;

use mvc\Controller;

class UserController extends Controller{
    
    function login(){
        $context = ['model' => $this->model];
        $this->view->render('Login page!', $context);
    }
    
    function register(){
        $context = ['model' => $this->model];
        $this->view->render('Register page!', $context);
    }
    
    function logout(){
        $this->view->render('Logout page!');
    }
}
?>