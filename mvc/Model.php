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
        
        $handler->have_required_fields($cls::REQUIRED_FIELDS[$http_method]);

        // Get only entered fields which should be processed
        $process_fields = array_intersect_key($cls::FIELDS_PROCESSING[$http_method], $handler->http_method_ref);
        
        foreach($process_fields as $field =>$funcs){
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