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
            
            $exist_user = $model->get_user('email', 'email');
            if ($exist_user){
                $model->post_handler->put_error('email', 'User with this email is already exist');
            }
            
            if (empty($model->post_handler->validation_errors)){
                $model->register_user();
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