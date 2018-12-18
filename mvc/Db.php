<?php

namespace mvc;

use PDO;

class Db {
    
    protected $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host='.DB['host'].'; dbname='.DB['dbname'], DB['user'], DB['password']);
    }
    
    function query($sql, $params = []){
        $query = $this->db->prepare($sql);
        foreach($params as $key => $value){
            $query->bindValue(':'.$key, $value);
        }
        $query->execute();
        return $query;
    }
    
    function row($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function column($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchColumn(PDO::FETCH_ASSOC);
    }
}
?>