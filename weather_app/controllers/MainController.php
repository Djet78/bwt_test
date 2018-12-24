<?php

namespace weather_app\controllers;

use mvc\Controller;

class MainController extends Controller{
    
    function index(){
        $this->view->render('Main page!');
    }
    
    function feedback(){
        $handler = $this->post_handler;
        
        if (!empty($_POST)){
            
            $required_fields = [
                'name',
                'body',
                'email',
            ];
            
            $fields_processing = [
                'name' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validate_len', ['min' => 2, 'max' => 50]],
                ],
                'body' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                ],
                'email' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validate_email', []],
                    ['validate_len', ['min' => 5, 'max' => 50]],
                ],
            ];
               
            $this->handle_input('POST', $required_fields, $fields_processing);
            
            if(empty($handler->validation_errors)){
                $this->model->add_feedback();
            }
        }
        
        $result = $this->model->get_feedbacks();
        $context = [
            'feedbacks' => $result, 
            'handler' => $handler
        ];
        $this->view->render('Feedback page!', $context);
    }
}
?>