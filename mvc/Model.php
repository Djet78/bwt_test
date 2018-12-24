<?php

namespace mvc;

use mvc\Db;

abstract class Model{
    
    public $db;
    
    function __construct(){
        $this->db = new Db;
    }
}
?>