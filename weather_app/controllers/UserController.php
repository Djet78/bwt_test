<?php

namespace weather_app\controllers;

use mvc\Controller;

class UserController extends Controller{
    
    function login(){
        $handler = $this->post_handler;
        if (!empty($_POST)){
            
            $required_fields = [
                'email',
                'password',
            ];
            $handler->have_required_fields($required_fields);
            
            if(empty($handler->validation_errors)){
                $handler->trim_('email');
                $user = $this->model->get_user('email', $_POST['email'], '`email`, `password`');
                if($user){
                    $hash = $user[0]['password'];
                    $password = $_POST['password'];
                    $handler->password_verify_($hash, 'password');
                    
                    if(empty($handler->validation_errors)){
                        $_SESSION['user_group'] = 'autorized';
                        $this->view::redirect_by_name('homepage');
                    }
                } 
                $handler->put_error('email', 'Wrong email or password');
            }
        }
        $context = ['handler' => $handler];
        $this->view->render('Login page!', $context);
    }
    
    function register(){
        if (!empty($_POST)){
            
            $required_fields = [
                'firstname',
                'lastname',
                'password',
                'password_2',
                'email',
            ];
            
            $fields_processing = [
                'firstname' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validate_len', ['min' => 2, 'max' => 50]],
                ],
                'lastname' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validate_len', ['min' => 2, 'max' => 50]],
                ],
               'password' => [
                    ['validate_len', ['min' => 6, 'max' => 128]],
                    ['compare_passwords', ['password_field_2' => 'password_2']],
                    ['password_hash_', ['algo' => PASSWORD_DEFAULT]],
                ],
                'email' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validate_email', []],
                    ['validate_len', ['min' => 5, 'max' => 50]],
                ],
                'gender' => [
                    ['validate_choice', ['choices' => ['m', 'f']]],
                ],
                'birthday' => [
                    ['str_to_datetime', ['format' => "!Y-m-d"]],
                    ['validate_datetime_range', ['format' => "!Y-m-d", 
                                                 'min_date' => (date('Y') - 120).'-01-01', 
                                                 'max_date' => date('Y-m-d'),]],
                ],
            ];
            
            $this->handle_input('POST', $required_fields, $fields_processing);
            
            if (empty($this->post_handler->validation_errors)){
                $exist_user = $this->model->get_user('email', 'email');
                if ($exist_user){
                    $this->post_handler->put_error('email', 'User with this email is already exist');
                } else {
                    $res = $this->model->register_user();
                    if ($res == True){
                        $this->view::redirect_by_name('login');
                    }
                }
            }
        }
        $context = ['handler' => $this->post_handler];
        $this->view->render('Register page!', $context);
    }
    
    function logout(){
        $this->view->render('Logout page!');
    }
}
?>