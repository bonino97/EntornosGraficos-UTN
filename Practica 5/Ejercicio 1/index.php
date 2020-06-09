<?php 
$destinatario = "entornosgraficos@utnfrro.com";
$asunto = "Correo - Ejercicio 1 - Practica 5";
$cuerpo = '
            <html>
            <head>
            <title>Envio de mail</title>
            </head>
                <body>
                    <h1>Entornos Graficos</h1>
                    <p>
                    <b>Ejercicio 1 - Practica 5</b>.
                    </p>
                </body>
            </html>
            ';
$headers .= "Content-type:text/html; charset=iso-8859- 1\r\n"; // Cabecera necesaria para el envio del mail.
$headers .= "From: juanbonino97@gmail.com\r\n";

mail($destinatario,$asunto,$cuerpo,$headers)
?>