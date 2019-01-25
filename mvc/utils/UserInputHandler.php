<?php
namespace mvc\utils;

use DateTime;
use InvalidArgumentException;

/**
 * Contain useful methods for user input handling
 *
 * While construction get reference to $_GET or $_POST array
 * and apply all filters and validators directly on that array.
 *
 * All filters changes values in given array.
 * All validators and handlers puts appropriate error messages into '$validation_errors' array.
 */
class UserInputHandler
{
    /**
     * Reference to  $_GET or $_POST array
     *
     * @var array
     */
    public $http_method_ref;
    
    /** 
     * Collect all validation errors i.e.
     *
     * $validation_errors = [
     *          'field_name'=> ['msg_1', 'msg_2', ...], 
     *          'field_name2'=> ['msg_1', 'msg_2', ...],
     *          ...,
     *     ]
     *
     * @var array
     */
    public $validation_errors = [];
    
    /**
     * Get reference to given $http_method
     *
     * @param string $http_method Values: 'POST', 'GET'
     */
    public function __construct(string $http_method)
    {
        $this->http_method_ref = & $this->getHttpMethodRef($http_method);
    }
    
    /**
     * Check is given $http_method value valid
     *
     * @param   string $http_method Values: 'POST', 'GET'
     * @throws  InvalidArgumentException 
     * @return  array
     */
    private function &getHttpMethodRef(string $http_method)
    {
        $http_method = strtoupper($http_method);
        if ($http_method == 'POST') {
            return $_POST;
        } elseif ($http_method == 'GET') {
            return $_GET;
        } else {
            throw new InvalidArgumentException(get_called_class() . " awaits only 'POST' or 'GET' as argument");
        }
    }
    
    
    // `````````````````````````````````````````````````````````````
    // Cleaners
    // .............................................................    
    
    public function stripTags($field)
    {
        $input = strip_tags($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $input;
    }
        
    public function trim_($field)
    {
        $input = trim($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $input;
    }    
    
    public function htmlspecialchars_($field)
    {
        $input = htmlspecialchars($this->http_method_ref[$field]);
        $this->http_method_ref[$field] = $input;
    }
    
    
    // `````````````````````````````````````````````````````````````
    // Validators
    // .............................................................
    
    public function haveRequiredFields($required_fields)
    {
        foreach ($required_fields as $field) {
            if ($this->isEmptyField($field)) {
                $this->putError($field, 'Field is required.');
            }
        }
    }
    
    public function validateLen($min, $max, $field)
    {
        $len = strlen($this->http_method_ref[$field]);
        if (!($min <= $len)) {
            $this->putError($field, "Too short. Must be at least $min characters");
        } elseif (!($len <= $max)) {
            $this->putError($field, "Too long. Must be no longer than $max characters");
        }
    }
    
    public function comparePasswords($password_field_2, $password_field_1)
    {
        if ($this->http_method_ref[$password_field_1] !== $this->http_method_ref[$password_field_2]) {
            $this->putError($password_field_1, 'Passwords don`t match');
        }
    }

    public function validateEmail($field)
    {
        $email = $this->http_method_ref[$field];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->putError($field, 'It`s not valid email');
        }
    }
    
    public function validateCaptcha() 
    {
        $g_uri = 'https://www.google.com/recaptcha/api/siteverify';
        $g_cap_resp = $this->http_method_ref['g-recaptcha-response'];
        $query = "{$g_uri}?secret=".CAPTCHA_SEC_KEY."&response={$g_cap_resp}&remoteip={$_SERVER['REMOTE_ADDR']}";

        $response = json_decode(file_get_contents($query), true);
        
        if ($response['success'] == false) {
            $this->putError('captcha', 'Please verify the captcha');
        }
    }
    
    public function validateChoice($choices_arr, $field)
    {
        $choice = $this->http_method_ref[$field];
        if (!in_array($choice, $choices_arr)) {
            $this->putError($field, 'We have no such choice');
        }
    }
    
    public function validateDatetimeRange($format, $min_date, $max_date, $field)
    {
        $date = $this->http_method_ref[$field];
        $min_date = DateTime::createFromFormat($format, $min_date);
        $max_date = DateTime::createFromFormat($format, $max_date);
        if (!($min_date <= $date)) {
            $this->putError($field, "Date cannot be less than: {$min_date->Format('d-M-Y')}");
        } elseif (!($date <= $max_date)) {
            $this->putError($field, "Date cannot be bigger than: {$max_date->Format('d-M-Y')}");
        }
    }
    
    public function isEmptyField($field)
    {
        if (!isset($this->http_method_ref[$field])) {
            return true;
        }
        return ($this->http_method_ref[$field] == '');
    }

    // `````````````````````````````````````````````````````````````
    // Handlers
    // .............................................................
       
    public function passwordHash($algo, $field)
    {
        if (empty($this->validation_errors)){
            $hash = password_hash($this->http_method_ref[$field], $algo);
            if ($hash == false) {
                $this->putError($field, 'Problems occured while password hashing');
            } else {
                $this->http_method_ref[$field] = $hash;
            }
        }
    }
    
    public function strToDatetime($format, $field)
    {
        $str_date = $this->http_method_ref[$field];
        $date = DateTime::createFromFormat($format, $str_date);
        if ($date == false) {
            $this->putError($field, 'It`s not a valid date');
        } else {
            $this->http_method_ref[$field] = $date;
        }
    }
    
    public function passwordVerify($hash, $field)
    {
        $password = $this->http_method_ref[$field];
        $res = password_verify($password, $hash);
        if ($res == false) {
            $this->putError($field, 'Passwords don`t match');
        }
    }
    
    /**
     * Use this method if there no specific validation procesing,
     * when you can simply validate one input after another.
     * Method skip processing for empty and not required fields
     *
     * @param array  $required_fields i.e. ['feield_name_1', 'feield_name_2', 'feield_name_n', ...]
     * @param array  $process_fields
     *
     * $process_fields construction example:
     *   $procces = [                                               $variable = [
     *      'firstname' => [                                            'fieldname_1' => [
     *          ['trim_', []],                                              ['method_name_1', [args]],
     *          ['htmlspecialchars_', []],                                  ['method_name_2', [args]],
     *          ['validateLen', ['min' => 2, 'max' => 50]],                 ['method_name_3', [args]],
     *      ],                                                          ],
     *      'gender' => [                                               'fildname_2' => [
     *              ['validateChoice', [['m', 'f']]],                       ['method_name_1', [args]],
     *      ],                                                          ],
     *   ]                                                          ]   
     *
     * If function don't take any arguments use empty array.
     * As 'args' array you can write both ['min' => 2, 'max' => 50] or [2, 50].
     * You can use 1st variant to be more explicit or 2nd for simplicity
     */
    public function handleInput($required_fields, $process_fields)
    {
        $this->haveRequiredFields($required_fields);
     
        foreach ($process_fields as $field => $funcs) {
            
            // Skip proccesing for that field
            $is_empty_and_not_required = $this->isEmptyField($field) && !in_array($field, $required_fields);
            if ($is_empty_and_not_required) {
                continue;
            }
            
            foreach ($funcs as list($func, $params)) {
                $params['field'] = $field;
                call_user_func_array([$this, $func], $params);
            }
        }
    }
    
    // `````````````````````````````````````````````````````````````
    // For errors handling
    // .............................................................    
     
    public function putError($field, $msg)
    {
       $this->validation_errors[$field][] = $msg;
    }
    
    public function displayErrorsIfErrors($field)
    {
        if (isset($this->validation_errors[$field])) {
            foreach ($this->validation_errors[$field] as $err) {
                echo "$err <br>";
            }
        }
    }
}
