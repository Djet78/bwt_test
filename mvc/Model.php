<?php

namespace mvc;

use mvc\Db;
use mvc\UserInputHandler;

abstract class Model{
    
    const REQUIRED_FIELDS = ['POST'=> [], 'GET' => []];
    const FIELDS_PROCESSING = ['POST'=> [], 'GET' => []];
    
    public $db;
    public $post_handler;
    public $get_handler;
    
    function __construct(){
        $this->db = new Db;
        $this->post_handler = new UserInputHandler('POST');
        $this->get_handler = new UserInputHandler('GET');
    }

    function handle_input(string $http_method){
        $http_method = strtoupper($http_method);
        $handler = $this->get_user_input_handler($http_method);
        $cls = get_called_class();
        
        $required_fields = $cls::REQUIRED_FIELDS[$http_method];
        $handler->have_required_fields($required_fields);
        
        $process_fields = $cls::FIELDS_PROCESSING[$http_method];       
        foreach($process_fields as $field =>$funcs){
            
            // Skip proccesing for that field
            $is_empty_and_not_required = $handler->is_empty_field($field) && !in_array($field, $required_fields);
            if($is_empty_and_not_required){
                continue;
            }
            
            foreach($funcs as list($func, $params)){
                $params['field'] = $field;
                call_user_func_array([$handler, $func], $params);
            }
        }
    }
    
    private function get_user_input_handler(string $http_method){
        if ($http_method == 'POST'){
            return $this->post_handler;
        } else if ($http_method == 'GET'){
            return $this->get_handler;
        } else {
            // Throw exception
        }
    }
}
?>