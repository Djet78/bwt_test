<?php
namespace weather_app\controllers;

use mvc\Controller;

class UserController extends Controller
{
    /**
     * Load login page
     * Handle post data from login form
     */
    public function login()
    {
        $handler = $this->post_handler;
        if (!empty($_POST)) {
            
            $handler->haveRequiredFields(['email', 'password']);
            
            if (empty($handler->validation_errors)) {
                $handler->trim_('email');
                $user = $this->model->getUser('email', $_POST['email'], '`email`, `password`');
                
                if ($user) {
                    $hash = $user[0]['password'];
                    $password = $_POST['password'];
                    $handler->passwordVerify($hash, 'password');
                    
                    if (empty($handler->validation_errors)) {
                        $_SESSION['user_group'] = 'autorized';
                        $this->view::redirectByName('homepage');
                    }
                } 
                $handler->putError('email', 'Wrong email or password');
            }
        }
        $context = ['handler' => $handler];
        $this->view->render('default', 'Login page!', $context);
    }
    
    /**
     * Load register page
     * Handle post data from register form
     */    
    public function register()
    {
        $handler = $this->post_handler;
        
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
                    ['validateLen', ['min' => 2, 'max' => 50]],
                ],
                'lastname' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validateLen', ['min' => 2, 'max' => 50]],
                ],
               'password' => [
                    ['validateLen', ['min' => 6, 'max' => 128]],
                    ['comparePasswords', ['password_field_2' => 'password_2']],
                    ['passwordHash', ['algo' => PASSWORD_DEFAULT]],
                ],
                'email' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validateEmail', []],
                    ['validateLen', ['min' => 5, 'max' => 50]],
                ],
                'gender' => [
                    ['validateChoice', ['choices' => ['m', 'f']]],
                ],
                'birthday' => [
                    ['strToDatetime', ['format' => "!Y-m-d"]],
                    ['validateDatetimeRange', ['format' => "!Y-m-d", 
                                                 'min_date' => (date('Y') - 120).'-01-01', 
                                                 'max_date' => date('Y-m-d'),]],
                ],
            ];
            
            $handler->handleInput($required_fields, $fields_processing);
            
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            if ($email){
                $exist_user = $this->model->getUser('email', $email, '`id`');
                if ($exist_user) {
                    $handler->putError('email', 'User with this email is already exist');
                }
            }
            
            if (empty($handler->validation_errors)) {
                $res = $this->model->saveUser();
                if ($res == true) {
                    $this->view::redirectByName('login');
                } else {
                    $this->view::renderErrorPage(500);
                }
            }
        }
        $context = ['handler' => $handler];
        $this->view->render('default', 'Register page!', $context);
    }
    
    /**
     * Logout user from system and redirects him to login page
     */
    public function logout()
    {
        $_SESSION['user_group'] = 'guest';
        $this->view::redirectByName('login');
    }
}
