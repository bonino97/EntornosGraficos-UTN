<?php
function comprobar_nombre_usuario($nombre_usuario){ 
    //compruebo que el tamaño del string sea válido. 
    if (strlen($nombre_usuario)<3 || strlen($nombre_usuario)>20){ 
        echo $nombre_usuario . " no es válido<br>";
        return false; 
    } 
        //compruebo que los caracteres sean los permitidos 
        $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
        for ($i=0; $i<strlen($nombre_usuario); $i++){
            if (strpos($permitidos, substr($nombre_usuario,$i,1))===false){ 
                echo $nombre_usuario . " no es válido<br>";
                 return false; 
            } 
        }
        echo $nombre_usuario . " es válido<br>";
         return true; 
    }

comprobar_nombre_usuario("olivamartin");
echo "<br><br>";
comprobar_nombre_usuario("bonino97");
echo "<br><br>";
comprobar_nombre_usuario("valentinadominguez");
echo "<br><br>";
comprobar_nombre_usuario("salvador");
echo "<br><br>";
comprobar_nombre_usuario("ad");
echo "<br><br>";
comprobar_nombre_usuario("nombremuylargoparaqueelstringnoseavalido");

?>