<?php

namespace weather_app\models;

use mvc\Model;

class UserModel extends Model{
    
    /**
     *@param array $email should be like : ['email' => 'entered_email'] 
     */
    function get_user($email){
        $result = $this->db->column('SELECT * FROM users WHERE email = :email', $email);
        return $result;
    }
}
?>