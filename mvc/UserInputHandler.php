<?php

namespace mvc;

use DateTime;

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
    // Cleaners
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
    
    function have_required_fields($required_fields){
        foreach($required_fields as $field){
            if($this->is_empty_field($field)){
                $this->put_error($field, 'Field is required.');
            }
        }
    }
    
    function validate_len($min, $max, $field){
        $len = strlen($this->http_method_ref[$field]);
        if (!($min <= $len)){
            $this->put_error($field, "Too short. Must be at least $min characters");
        } else if(!($len <= $max)){
            $this->put_error($field, "Too long. Must be no longer than $max characters");
        }
    }
    
    function compare_passwords($password_field_2, $password_field_1){
        if ($this->http_method_ref[$password_field_1] !== $this->http_method_ref[$password_field_2]){
            $this->put_error($password_field_1, 'Passwords don`t match');
        }
    }

    function validate_email($field){
        $email = $this->http_method_ref[$field];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->put_error($field, 'It`s not valid email');
        }
    }
    
    function validate_choice($choices_arr, $field){
        $choice = $this->http_method_ref[$field];
        if (!in_array($choice, $choices_arr)){
            $this->put_error($field, 'We have no such choice');
        }
    }
    
    function validate_datetime_range($format, $min_date, $max_date, $field){
        $date = $this->http_method_ref[$field];
        $min_date = DateTime::createFromFormat($format, $min_date);
        $max_date = DateTime::createFromFormat($format, $max_date);
        if (!($min_date <= $date)){
            $this->put_error($field, "Date cannot be less than: {$min_date->Format('d-M-Y')}");
        } else if (!($date <= $max_date)) {
            $this->put_error($field, "Date cannot be bigger than: {$max_date->Format('d-M-Y')}");
        }
    }
    
    function is_empty_field($field){
        if (!isset($this->http_method_ref[$field])){
            return True;
        }
        return ($this->http_method_ref[$field] == '');
    }

    // `````````````````````````````````````````````````````````````
    // Handlers
    // .............................................................
       
    function password_hash_($algo, $field){
        if (empty($this->validation_errors)){
            $hash = password_hash($this->http_method_ref[$field], $algo);
            if ($hash == False){
                // It's not final desion for this case.
                $this->put_error($field, 'Problems occured while password hashing');
            } else {
                $this->http_method_ref[$field] = $hash;
            }
        }
    }
    
    function str_to_datetime($format, $field){
        $str_date = $this->http_method_ref[$field];
        $date = DateTime::createFromFormat($format, $str_date);
        if($date == False){
            $this->put_error($field, 'It`s not a valid date');
        } else {
            $this->http_method_ref[$field] = $date;
        }
    }
    
    function password_verify_($hash, $field){
        $password = $this->http_method_ref[$field];
        $res = password_verify($password, $hash);
        if($res == False){
            $this->put_error($field, 'Passwords don`t match');
        }
    }


    // `````````````````````````````````````````````````````````````
    // For errors handling
    // .............................................................    
     
    function put_error($field, $msg){
       $this->validation_errors[$field][] = $msg;
    }
    
    function display_errors_if_have($field){
        if (isset($this->validation_errors[$field])){
            foreach($this->validation_errors[$field] as $err){
                echo "$err <br>";
            }
        }
    }    
}

?>
