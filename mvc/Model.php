<?php

namespace mvc;

use mvc\Db;

abstract class Model{
    
    public $db;
    
    public function __construct(){
        $this->db = new Db;
    }
}
?>