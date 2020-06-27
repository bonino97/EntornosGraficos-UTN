<?php
    $link = mysqli_connect("localhost:3308", "root", "") or die ("Problemas de conexión a la base de datos");
    mysqli_select_db($link, "base2");
?>