<?php
setcookie("noticias", $_REQUEST['radio1'], time() + (60 * 60 * 24 * 365), "/");
?>
<html>
<head>
  <title>Confirmar</title>
</head>

<body>
  <h2>Se configuró correctamente</h2>
  <a href="index.php">Volver a inicio</a>
</body>

</html>