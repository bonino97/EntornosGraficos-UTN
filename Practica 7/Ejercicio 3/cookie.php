<?php
if(isset($_POST["enviar"])){
    if ($_POST["nombre"] != ""){
        $nombre = $_POST["nombre"];
        setcookie("nombre_cookie", $nombre, time() + 30*24*60*60);
    }  
}
if (isset($_COOKIE["nombre_cookie"])){
    print "<p>El último usuario ingresado fue: $_COOKIE[nombre_cookie]</p>\n";
} 
else{
    echo "No se han introducido usuarios";
}
?>
<html>
<body>
<form action="" method="post">
<p>Usuario: <input type="text" name="nombre"></p>
<p><input type="submit" name="enviar" value="Enviar"></p>
</form>
</body>
</html>

