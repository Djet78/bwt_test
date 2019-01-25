<?php
namespace weather_app\models;

use mvc\model\Model;

class MainModel extends Model
{   
    /**
     * Load feedbacks from db
     *
     * @return array
     */    
    public function getFeedbacks()
    {
        $result = $this->db->getRows('SELECT `name`, `body`, `email` FROM feedback;');
        return $result;
    }

    /**
     * Save feedback in db
     *
     * @return bool
     */        
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
