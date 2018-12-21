<?php

namespace weather_app\models;

use mvc\Model;

class UserModel extends Model{
    /*
    const REQUIRED_FIELDS = [
        'POST'=> [
            'firstname',
            'lastname',
            'password',
            'password_2',
            'email',
            ],
    ];
    */
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
    
    /**
     *@param array $email should be like : ['email' => 'entered_email'] 
     */
    function get_user($email){      // 'It's tmp query. '*' char will be replaced'
        $result = $this->db->column('SELECT * FROM users WHERE email = :email', $email);
        return $result;
    }
}
?>