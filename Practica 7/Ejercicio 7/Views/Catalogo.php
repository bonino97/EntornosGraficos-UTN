<!DOCTYPE html>
<?php
    session_start();
    $Products = $_SESSION['ListaProductos'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Catalogo de Productos</title>
</head>
<body>
    <div class="container">

        <br>
        <br>
        <h2 align="center">CATALOGO DE PRODUCTOS</h2>
        <br>
        <br>

        <div class="row">
            <table border="0" width="700" align="center" class="table">
                <tr align="center">
                <?php
                    $num = 0;
                    foreach($Products as $Product){
                        if($num == 3){
                            echo "<tr align='center'>";
                            $num = 1;
                        } else {
                            $num++;
                        }
                        ?>

                        <th>
                            <div class="card border-danger">
                                <br>
                                <img src="../Src/Img/<?php echo $Product[3];?>" width="120" height="120" style="display: block; position: static;">

                                <div class="card-body">
                                    <h5 class="card-title text-secondary"><?php echo $Product[1];?></h5>
                                    <p class="card-text text-secondary">$<?php echo $Product[2];?></p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-danger" onclick="GetTotal(<?php echo $Product[2];?>)">
                                            Agregar
                                    </button>
                                </div>
                            </div>
                        </th>
                    <?php
                    }
                    ?>
            </table>
        </div>
        <hr>
        <div class="row">
            <!-- Carrito -->
            <aside class="col-sm-4">
                <h2>Carrito</h2>
                <!-- Elementos del carrito -->
                <ul id="carrito" class="list-group"></ul>
                <hr>
                <!-- Precio total -->
                <p class="text-right">Total: &dollar;<span id="total"></span></p>
                <button id="boton-vaciar" class="btn btn-danger" onclick="CleanTotal()">Vaciar</button>
            </aside>
        </div>

    </div>
    
    <script>

        var total = 0;

        function GetTotal(price){
            total += price;
            console.log(total);
            document.getElementById("total").innerHTML = total;
        }

        function CleanTotal(){
            total = 0;
            document.getElementById("total").innerHTML = total;
        }

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>