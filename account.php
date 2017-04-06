<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div id="accueil">
            Accueil
        </div>

        <?php
            include 'Utile/header.php';
        ?>

        <?php
            include 'Utile/barremenu.php';
        ?>

        <div id="listeFond">
            <div id="listeTitre">
                Fichiers récents
                <hr>
            </div>
            <div id="liste">
                <?php
                for ($fichier = 1; $fichier <= 7; $fichier++)
                {
                    echo 'Fichier test n°' . $fichier . '.<br>';
                }
                ?>
            </div>
        </div>

    </body>
</html>