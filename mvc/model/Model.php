<?php
namespace mvc\model;

use mvc\model\Db;

/**
 * Implemets connection to database
 */
abstract class Model
{
    /**
     * Configurated and connected PDO instance
     */
    public $db;
    
    function __construct()
    {
        $this->db = Db::getInstance();
    }
}
