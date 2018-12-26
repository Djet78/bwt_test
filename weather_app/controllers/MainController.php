<?php
namespace weather_app\controllers;

use mvc\Controller;

class MainController extends Controller
{
    public function index()
    {
        $this->view->render('Main page!');
    }
    
    public function feedback()
    {
        $handler = $this->post_handler;
        
        if (!empty($_POST)) {
            
            $required_fields = [
                'name',
                'body',
                'email',
            ];
            
            $fields_processing = [
                'name' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validateLen', ['min' => 2, 'max' => 50]],
                ],
                'body' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                ],
                'email' => [
                    ['trim_', []],
                    ['htmlspecialchars_', []],
                    ['validateEmail', []],
                    ['validateLen', ['min' => 5, 'max' => 50]],
                ],
            ];
               
            $handler->handleInput($required_fields, $fields_processing);
            
            if (empty($handler->validation_errors)) {
                $this->model->saveFeedback();
            }
        }
        
        $result = $this->model->getFeedbacks();
        $context = [
            'feedbacks' => $result, 
            'handler' => $handler,
        ];
        $this->view->render('Feedback page!', $context);
    }
}
