<?php
    session_start();
    setcookie('remember', NULL, -1);
    unset($_SESSION['auth']);
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