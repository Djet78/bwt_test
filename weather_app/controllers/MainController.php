<?php

namespace weather_app\controllers;

use mvc\Controller;

class MainController extends Controller{
    
    function index(){
        $this->view->render('Main page!');
    }
    
    function feedback(){
        $result = $this->model->get_feedbacks();
        $context = ['feedbacks' => $result];
        $this->view->render('Feedback page!', $context);
    }
}
?>