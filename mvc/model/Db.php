<?php
namespace mvc\model;

use PDO;

class Db 
{
    protected $db;
    private static $instance = null;
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->db = new PDO(
            'mysql:host='.DB['host'].'; dbname='.DB['dbname']. '; charset=utf8', 
            DB['user'],     
            DB['password'],
            [PDO::ATTR_ERRMODE => (DEBUG) ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT]
        );
    }
    
    private function __clone() {}
    
    public function execQuery($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $query->bindValue(':'.$key, $value);
        }
        $res = $query->execute();
        return ['res' => $res, 'query' => $query];
    }
    
    public function getRows($sql, $params = [])
    {
        $query = $this->execQuery($sql, $params)['query'];
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getColumns($sql, $params = [])
    {
        $query = $this->execQuery($sql, $params)['query'];
        return $query->fetchColumn();
    }
}
