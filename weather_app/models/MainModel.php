<?php

namespace weather_app\models;

use mvc\Model;

class MainModel extends Model{
    
    function get_feedbacks(){
        $result = $this->db->row('SELECT `name`, `body`, `email` FROM feedbacks');
        return $result;
    }
}
?>