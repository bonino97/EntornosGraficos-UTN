<?php
    session_start();
?>
<html>
    <head>
        
        <title>Problema</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Panel de Control
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <?php
                                if (isset($_SESSION['Alumno']))
                                {                        
                                    echo "Bienvenido ".$_SESSION['Alumno'];
                                }
                                else
                                {
                                    echo "No tiene permitido visitar esta página.";
                                }
                                session_destroy();
                            ?>

                        </blockquote>
                    </div>
                </div>
            </div>
        </div>


    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>