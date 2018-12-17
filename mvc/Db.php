<?php

namespace mvc;

use PDO;

class Db {
    
    protected $db;
    
    public function __construct(){
        $this->db = new PDO('mysql:host='.DB['host'].'; dbname='.DB['dbname'], DB['user'], DB['password']);
    }
    
    public function query($sql, $params = []){
        $query = $this->db->prepare($sql);
        foreach($params as $key => $value){
            echo "$key, $value";
            $query->bindValue(':'.$key, $value);
        }
        $query->execute();
        return $query;
    }
    
    public function row($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function column($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchColumn(PDO::FETCH_ASSOC);
    }
}
?>