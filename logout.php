<?php
    session_start();
    unset($_SESSION['auth']); //Déconnexion de la session
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Deconnexion</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div class="inscriptionok">
            Vous êtes déconnecté(e) du site
            <br>
            Retournez à <a href="index.php" class="boutonCo">l'accueil</a> pour vous connecter.
        </div>
    </body>
</html>
