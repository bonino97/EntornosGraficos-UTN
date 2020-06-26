<?php
include '../Config/Connection.php';

class IndexController {
    public function GetProducts(){
        $connection = new Connection();
        $conn = $connection->GetConnection();
        $res = $conn->prepare("SELECT * FROM catalogo");
        $res->execute();

        foreach($res as $row){
            $productsList[]=$row;
        }

        return $productsList;
    }
}