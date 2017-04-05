<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Projet PHP</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div id="accueil">
            Projet PHP
        </div>

        <div id="divtitre">
            Site de partage/sauvegarde en PHP<br>
            <br>
            <img class="imageAccueil" src="Images/projetPHP.png" alt="Image d'accueil">
        </div>

        <div id="connexion">
            <div id="title">
                Connexion
                <hr>
            </div>
            <div id="formulaireCo">
                <form method="POST">
                    Login/mail : <input type="text" name="mail"><br>
                    Mot de passe : <input type="password" name="pass"><br>
                    <a href="login.php">Connexion</a>
                </form>
                <br>
                Pas de compte ? Pas de souci. <a href="register.php" class="boutonCo">Incrivez-vous ici</a> !<br>
                <br>
                Sur ce site, vous pourrez partager (et accessoirement sauvegarder) des fichiers divers avec d'autres utilisateurs.<br>
                Attention de bien respecter les règles mentionnées lors de votre insciption.
            </div>
        </div>

        <?php
            include 'Utile/footer.php';
        ?>

    </body>
</html>

