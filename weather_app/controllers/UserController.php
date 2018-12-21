<?php

namespace weather_app\controllers;

use mvc\Controller;

class UserController extends Controller{
    
    function login(){
        $context = ['model' => $this->model];
        $this->view->render('Login page!', $context);
    }
    
    function register(){
        $model = $this->model;
        if (!empty($_POST)){
            $model->handle_input('POST');
            if (empty($model->post_handler->validation_errors)){
                //register user
            }
        }
        $context = ['model' => $model];
        $this->view->render('Register page!', $context);
    }
    
    function logout(){
        $this->view->render('Logout page!');
    }
}
?>