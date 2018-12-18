<?php

namespace weather_app\controllers;

use mvc\Controller;

class UserController extends Controller{
    
    function login(){
        $this->view->render('Login page!');
    }
    
    function register(){
        $this->view->render('Register page!');
    }
    
    function logout(){
        $this->view->render('Logout page!');
    }
}
?>