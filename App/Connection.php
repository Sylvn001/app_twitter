<?php 

namespace App;


class Connection{
    // private $host = "localhost"; 
    // private $dbName = "minframework";
    // private $user = "root"; 
    // private $pass = "";

    public static function getCon(){
        try{
            $con = new \PDO (
                "mysql:host=localhost;dbname=minframework; charset=utf8",
                "root",
                ""
            );
            return $con;
        }catch(\PDOException $e){
            echo $e;
        }
    }

}