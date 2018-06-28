<?php

session_start();

class Db extends PDO {
    // Nomes de constantes válidos
/*define("HOST",  "localhosta");
define("USER",    "root");
define("PASSWORD", "12345");
define("DATABASE", "mercado01");*/
/*
    const HOST = "localhosta";
    const USER = "root";
    const PASSWORD = "12345";
    const DATABASE = "mercado01";
*/
    public $conn;


    public function __construct(){

        //$this->conn = new PDO("mysql:host=self::HOST; dbname=self::DATABASE, self::USER, self::PASSWORD");
        $this->conn = new PDO("mysql:host=localhost; dbname=ferramentaDer", "root", "12345");

    }

    private function setParams($statment, $parameters = array()){

        foreach ($parameters as $key => $value) {
            
            $this->setParam($statment, $key, $value);

        }
    }



    private function setParam($statment, $key, $value){

        $statment->bindParam($key, $value);

    }



    public function query($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }




}

?>