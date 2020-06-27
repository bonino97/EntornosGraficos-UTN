<?php
if(isset($_COOKIE["contador"]))
{
    $counter = $_COOKIE["contador"] + 1;
    setcookie("contador", $counter, time()+86400*365);
    echo 'Ingreso nº: ' . strval($counter);
}
else
{
    setcookie("contador", 1, time()+86400*365);
    echo 'Bienvenido';
}
?>