<?php

namespace weather_app\models;

use mvc\Model;

class MainModel extends Model{
    
    function get_feedbacks(){
        $result = $this->db->row('SELECT * FROM feedbacks');
        return $result;
    }
}
?>