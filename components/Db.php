<?php

class Db {

    private static $instance;

    public static function getConnection(){
        
        if(self::$instance == null){
            new self;
        }
        return self::$instance;
    }
    
    protected function __construct() {        
        $params = include ROOT . '/config/db_params.php';
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8"; 
        self::$instance = new PDO($dsn, $params['user'], $params['password']);
    }
    
}
