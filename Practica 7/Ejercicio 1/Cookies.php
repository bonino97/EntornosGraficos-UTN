<?php
    if(isset($_POST["estilo"])){
        //Recibiendo un Estilo nuevo. Lo meto en la cookie.
        $estilo = $_POST["estilo"];
        //Meto el Estilo en una Cookie
        setcookie("estilo", $estilo, time() + (60 * 60 * 24 * 90));
    } else {
        // Si no recibi el estilo que deseaba el usuario en la agina, miro si hay una cookie creada.
        if(isset($_COOKIE["estilo"])){
            //Tengo la cookie
            $estilo = $_COOKIE["estilo"];
        }
    }

    if(isset($estilo)){
        echo '<link rel="STYLESHEET" type="text/css" href="'.$estilo.'.css">';
    }

?>
