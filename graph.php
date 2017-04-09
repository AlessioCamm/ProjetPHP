<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Graphisme</title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuGraph{color:#00aaff}</style>
    </head>

    <body>
        <div id="accueil">
            Graphisme
        </div>

        <?php
            include 'Utile/header.php';
        ?>

        <?php
            include 'Utile/barremenu.php';
        ?>

    </body>
</html>