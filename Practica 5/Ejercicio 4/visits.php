<?php
session_start();
?>
<html>
    <body>
        <a href="counter.php"></a>
        <?php
        echo "You have visited " . ($_SESSION["counter"]) . " pages";
        ?>
        <br>
        <br>
        <a href="counter.php">Another Page</a>
    </body>
</html>