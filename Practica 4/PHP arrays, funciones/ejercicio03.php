<!--a) -->
<?php 
$fun = getdate();
echo "Has entrado en esta pagina a las $fun[hours] horas, con $fun[minutes] minutos y $fun[seconds] segundos, del $fun[mday]/$fun[mon]/$fun[year]"; 
# Devuelve las horas,minutos,segundos,dia,mes y año actuales al momento de visitar la pagina
echo "<br><br>"
?>

<!--b) -->
<?php function sumar($sumando1,$sumando2){
$suma=$sumando1+$sumando2;
echo $sumando1."+".$sumando2."=".$suma;
}
sumar(5,6); #out: 5 + 6 = 11
?>