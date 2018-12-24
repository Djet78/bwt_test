<?php

namespace weather_app\models;

use mvc\Model;

class MainModel extends Model{
    
    function get_feedbacks(){
        $result = $this->db->row('SELECT `name`, `body`, `email` FROM feedback;');
        return $result;
    }
    
    function add_feedback(){
        $sql = <<<'INSERT'
            INSERT INTO `feedback` (`name`, `body`, `email`) 
            VALUES (:name, :body, :email);
INSERT;
        $params = [
            'name' => $_POST['name'],
            'body' => $_POST['body'],
            'email' => $_POST['email'],
        ];
        $res = $this->db->exec_query($sql, $params)['res'];
        return $res;
    }
}
?>