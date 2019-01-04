<?php
namespace weather_app\controllers;

use mvc\Controller;

class MainController extends Controller
{
    public function index()
    {   
        $data = file_get_contents('weather_app/weather.json');
        $context = json_decode($data, true);
        
        $this->view->render('Main page!', $context);
    }
    
    public function postFeedback()
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

        $context = ['handler' => $handler];
        $this->view->render('Feedback page!', $context);
    }
    
    public function showFeedbacks()
    {
        $feedbacks = $this->model->getFeedbacks();
        $context = ['feedbacks' => $feedbacks];
        $this->view->render('Feedbacks page!', $context);
    }
}
