<?php

namespace weather_app\models;

use mvc\Model;

class UserModel extends Model{
    
    function get_user($unique_field, $field_val, $fields){
        $params = ["$unique_field" => $field_val];
        $result = $this->db->row("SELECT $fields FROM users WHERE $unique_field = :$unique_field;", $params);
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
        $res = $this->db->exec_query($sql, $params)['res'];
        return $res;
    }
}
?>