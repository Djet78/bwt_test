<?php

namespace weather_app\models;

use mvc\Model;

class UserModel extends Model{

    const REQUIRED_FIELDS = [
        'POST'=> [
            'firstname',
            'lastname',
            'password',
            'password_2',
            'email',
        ],
    ];

    const FIELDS_PROCESSING = [
        'POST' => [
            'firstname' => [
                ['trim_', []],
                ['htmlspecialchars_', []],
                ['validate_len', ['min' => 2, 'max' => 50]],
            ],
            'lastname' => [
                ['trim_', []],
                ['htmlspecialchars_', []],
                ['validate_len', ['min' => 2, 'max' => 50]],
            ],
           'password' => [
                ['validate_len', ['min' => 6, 'max' => 128]],
                ['compare_passwords', ['password_field_2' => 'password_2']],
                ['password_hash_', ['algo' => PASSWORD_DEFAULT]],
            ],
            'email' => [
                ['trim_', []],
                ['htmlspecialchars_', []],
                ['validate_email', []],
                ['validate_len', ['min' => 5, 'max' => 50]],
            ],
            'gender' => [
                ['validate_choice', ['choices' => ['m', 'f']]],
            ],
            'birthday' => [
                ['str_to_datetime', ['format' => "!Y-m-d"]],
                ['validate_datetime_range', ['format' => "!Y-m-d", 
                                             'min_date' => '1900-01-01', 
                                             'max_date' => '2018-01-01',]],
            ],
        ],
    ];
    
    function get_user($db_field, $input_field){
        $params = ["$db_field" => $_POST[$input_field],];
        $result = $this->db->column("SELECT `$db_field` FROM users WHERE $db_field = :$db_field;", $params);
        return $result;
    }
    
    function register_user(){
        $sql = <<<'INSERT'
            INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `gender`, `birthday`) 
            VALUES (:firstname, :lastname, :email, :password, :gender, :birthday);
INSERT;
        $params = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'gender' => isset($_POST['gender']) ? $_POST['gender'] : null,
            'birthday' => (isset($_POST['birthday']) && $_POST['birthday'] != "") ? $_POST['birthday']->Format("Y-m-d") : null,
        ];
        $this->db->exec_query($sql, $params);
    }
}
?>