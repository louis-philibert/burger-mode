<?php

class DataBase 

{
    private static $dbHost = "localhost";
    private static $dbName = "burgur_code";
    private static $dbUser = "root";
    private static $dbUserPassword = "";

    private static $connection = null;

    public function __construct(PDO $pdo)
    {
      $this->connection = $pdo;
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect(){
        try{
            self::$connection = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUser , self::$dbUserPassword );
        } catch(PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }
    
    public static function disconnect(){
        self::$connection = null;
    }
}



