<?php

namespace mvc;

use PDO;

class Db {
    
    protected $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host='.DB['host'].'; dbname='.DB['dbname']. '; charset=utf8', 
                            DB['user'],     
                            DB['password']);
    }
    
    function exec_query($sql, $params = []){
        $query = $this->db->prepare($sql);
        foreach($params as $key => $value){
            $query->bindValue(':'.$key, $value);
        }
        $query->execute();
        return $query;
    }
    
    function row($sql, $params = []){
        $result = $this->exec_query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function column($sql, $params = []){
        $result = $this->exec_query($sql, $params);
        return $result->fetchColumn();
    }
}
?>