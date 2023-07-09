<?php
class Database {
    
    public function getConnect() {
        $host = 'localhost';
        $db = 'android_2';
        $user = 'root';
        $pass = '';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $pdo = new PDO($dsn, $user, $pass);
        
            return $pdo;

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
?>