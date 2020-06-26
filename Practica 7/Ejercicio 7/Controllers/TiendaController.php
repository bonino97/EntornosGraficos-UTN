<?php

session_start();

include './IndexController.php';

$op = $_REQUEST['op'];

switch($op){
    case 1: 
        unset($_SESSION['ListaProductos']);
        $indexMethods = new IndexController();
        $productsList = $indexMethods->GetProducts();
        $_SESSION['ListaProductos'] = $productsList;
        header("Location: ../Views/Catalogo.php");
        break;
    case 2: 
        break;
}

?>
