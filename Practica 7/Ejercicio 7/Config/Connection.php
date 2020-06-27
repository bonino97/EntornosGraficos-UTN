<?php
class Connection {
    public function GetConnection(){
        $db = new PDO("mysql:host=localhost;port=3308;dbname=compras", "root", "");
        return $db;
    }
}
?>