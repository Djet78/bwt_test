<?php

namespace weather_app\models;

use mvc\model\Model;

class UserModel extends Model
{
    /**
     * Load user from db
     *
     * @return array
     */        
    public function getUser(string $unique_field, $field_val, string $fields)
    {
        $params = ["$unique_field" => $field_val];
        $result = $this->db->getRows("SELECT $fields FROM users WHERE $unique_field = :$unique_field;", $params);
        return $result;
    }
    
    /**
     * Save user in db
     *
     * @return bool
     */        
    public function saveUser()
    {
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
        $res = $this->db->execQuery($sql, $params)['res'];
        return $res;
    }
}
