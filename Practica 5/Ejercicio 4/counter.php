<?php
session_start();
?>
<html>
    <body>
    <?php
    if(!isset($_SESSION["counter"])){
        $_SESSION["counter"] = 1;
    }
    else{
        $_SESSION["counter"]++;
    }?>
    <a href="visits.php">Another page</a>
    </body>
</html>