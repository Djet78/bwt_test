<?php
namespace weather_app\models;

use mvc\Model;

class MainModel extends Model
{
    public function getFeedbacks()
    {
        $result = $this->db->row('SELECT `name`, `body`, `email` FROM feedback;');
        return $result;
    }
    
    public function saveFeedback()
    {
        $sql = <<<'INSERT'
            INSERT INTO `feedback` (`name`, `body`, `email`) 
            VALUES (:name, :body, :email);
INSERT;
        $params = [
            'name' => $_POST['name'],
            'body' => $_POST['body'],
            'email' => $_POST['email'],
        ];
        $res = $this->db->execQuery($sql, $params)['res'];
        return $res;
    }
}
