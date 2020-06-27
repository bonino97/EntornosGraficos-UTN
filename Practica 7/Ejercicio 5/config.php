<?php

if(isset($_COOKIE["name"]))
{
  $newURL = "index.php?name=" . $_COOKIE["name"] . "&theme=" . $_COOKIE["theme"];
  header('Location: '. $newURL);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body style="background-color: lightgray;">
    <form method="post">
        <center>
            <div class="card" style="width: 80%; margin-top: 5em;">
                <h5 class="card-header">Ingreso de datos</h5>
                <div class="card-body" style="text-align: left;">
                  <h5 class="card-title">Nombre de usuario</h5>
                  <input type="text" name="name" class="form-control" style="width: 300px;" />
                  <h5 class="card-title" style="margin-top: 20px;">Tema</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="exampleRadios1" value="light" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Claro
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="exampleRadios2" value="dark">
                    <label class="form-check-label" for="exampleRadios2">
                      Oscuro
                    </label>
                  </div>
                  <button type="submit" class="btn btn-primary" style="float: right; margin-top: 10px;">Guardar</button>
                </div>
              </div>
        </center>
    </form>
    <?php
      function saveAndRedirect()
      {
        setcookie("name", $_POST["name"], time()+86400*365);
        setcookie("theme", $_POST["theme"], time()+86400*365);
        
        $newURL = "index.php?name=" . $_POST["name"] . "&theme=" . $_POST["theme"];
        
        header('Location: '. $newURL);
      }
      if($_SERVER['REQUEST_METHOD']=='POST')
      {
        saveAndRedirect();
      } 
    ?>
</body>
</html>