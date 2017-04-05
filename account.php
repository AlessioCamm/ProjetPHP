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

        <div class="barrenom">
            Vous êtes connecté(e) en temps que <a href="modif.php"><?= $_SESSION['auth']->prenom; ?></a>
            ---
            <a href="account.php">Retour à l'accueil</a>
        </div>

    </body>
</html>