<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificacion</title>
</head>
<body>
<?php
    include ("conexion.inc");

    //Captura datos desde el Form anterior
    $vCiudad = $_POST['Ciudad'];
    $vPais = $_POST['Pais'];
    $vHab = $_POST['Hab'];
    $vSup = $_POST['Sup'];
    $vTieneMetro = isset($_POST['TieneMetro']);

    //Arma la instrucción SQL y luego la ejecuta
    $vSql = "UPDATE Capitales set ciudad='$vCiudad', pais='$vPais', habitantes='$vHab', superficie='$vSup', tieneMetro=" . (boolval($vTieneMetro) ? 1 : 0) . " where ciudad='$vCiudad'";
    mysqli_query($link,$vSql) or die (mysqli_error($link));
    
    echo("El Usuario fue Modificado<br>");
    echo("<A href= 'Menu.html'>Volver al Menu del ABM</A>");
    
    // Cerrar la conexion
    mysqli_close($link);
?>
</body>
</html>