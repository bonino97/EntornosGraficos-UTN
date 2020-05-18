<!--a) -->
<?php 
$matriz = array("x" => "bar", 12 => true); 
echo $matriz["x"]; #out1: bar
echo $matriz[12];  #out2: 1
echo "<br><br>"
?>

<!--b) -->
<?php 
$matriz = array("unamatriz" => array(6 => 5, 13 => 9, "a" => 42));
echo $matriz["unamatriz"][6]; #out1: 5
echo $matriz["unamatriz"][13]; #out2: 9
echo $matriz["unamatriz"]["a"]; #out3: 42
echo "<br><br>";
 ?>

<!--c) -->
<?php
$matriz = array(5 => 1, 12 => 2); 
$matriz[] = 56; # Agrega el elemento 56 al arreglo con +1 valor del último índice del arreglo en caso que este sea un numero, de otro modo agrega como indice la longitud del array + 1
var_dump($matriz);
$matriz["x"] = 42; # Asigna el valor 42 al array junto con el índice x
unset($matriz[5]); #Elimina el elemento con índice 5 que contiene al valor 1
unset($matriz); #Elimina el array
?>