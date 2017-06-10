<?php
    session_start();
    unset($_SESSION['auth']);

    header('Location: index.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Alessio Cammarata" />
        <title>Déconnexion</title>
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
