<?php

namespace mvc;

// `````````````````````````````````````````````````````````````
// I will work around possible exeptions handling in the future.
// .............................................................

class UserInputHandler {
    
    /* 
     *  $validation_errors = [
     *           'field_name'=> ['msg_1', 'msg_2', ...], 
     *           'field_name2'=> ['msg_1', 'msg_2', ...],
     *           ...,
     *           ]
     */
    public $http_method_ref;
    public $validation_errors = [];

    function __construct(string $http_method){
        $this->http_method_ref = & $this->get_http_method_ref($http_method);
    }

    private function &get_http_method_ref(string $http_method){
        $http_method = strtoupper($http_method);
        if ($http_method == 'POST'){
            return $_POST;
        } else if ($http_method == 'GET'){
            return $_GET;
        } else {
            // Throw exception
        }
    }
    
    
    // `````````````````````````````````````````````````````````````
    // Filters
    // .............................................................    
    
    function strip_tags_($field){
        $value = strip_tags($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $value;
    }
        
    function trim_($field){
        $value = trim($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $value;
    }    
    
    function htmlspecialchars_($field){
        $value = htmlspecialchars($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $value;
    }
    
    
    // `````````````````````````````````````````````````````````````
    // Validators
    // .............................................................
    
    function have_required_fields($required_fields = []){
        foreach($required_fields as $field){
            if (!isset($this->http_method_ref[$field])){
                // Here I will place error data in '$this->validation_errors'.
            }
        }
    }
    
    function validate_len($min, $max, $field){
        $len = strlen($this->http_method_ref[$field]);
        if (!($min <= $len && $len <= $max)){
            // Here I will place error data in '$this->validation_errors'.
        }   
    }
    
    function compare_passwords($password_field_2, $password_field_1){
        if ($this->http_method_ref[$password_field_1] !== $this->http_method_ref[$password_field_2]){
            // Here I will place error data in '$this->validation_errors'.
        }
    }

    function validate_email($field){
        $email = $this->http_method_ref[$field];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // Here I will place error data in '$this->validation_errors'.
        }
    }

    // `````````````````````````````````````````````````````````````
    // Utility
    // .............................................................
       
    function password_hash_($algo, $field){
        if (!isset($this->validation_errors[$field])){
            $hash = password_hash($this->http_method_ref[$field], $algo);
            if ($hash == False){
                // Here I will place error data in '$this->validation_errors'.
            } else {
                $this->http_method_ref[$field] = $hash;
            }
        }
    }


    // `````````````````````````````````````````````````````````````
    // For errors handling
    // .............................................................    
     
    private function put_error($field, $msg){
       //
    }
    
    function display_errors_if_have($field){
        //
    }    
}

?>
