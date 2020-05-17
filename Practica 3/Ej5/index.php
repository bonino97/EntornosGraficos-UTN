<?php

$archivo = "contador.dat";

$crear = fopen($archivo, "w");

chmod($archivo, 0644);

fwrite($crear, "0");

fclose($crear);

?>