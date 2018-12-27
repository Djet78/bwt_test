<?php
namespace mvc\model;

use mvc\model\Db;

abstract class Model
{
    public $db;
    
    function __construct()
    {
        $this->db = Db::getInstance();
    }
}
