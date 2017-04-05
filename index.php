<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['auth'])){

    header('Location: account.php');
    exit();
}

if(!empty($_POST) && !empty($_POST['mail']) && !empty($_POST['pass'])){
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
    $req->execute(['mail' => $_POST['mail']]);
    $user = $req->fetch();
    if(password_verify($_POST['pass'], $user->pass)){
        session_start();
        $_SESSION['auth'] = $user;
        header('Location: account.php');
        exit();
    }else{
        ?>
        <html>
            <head>
            <meta charset="UTF-8">
            <title>Erreur de connexion</title>
            <link rel="stylesheet" href="style.css" />
            </head>
            <body>
                <div class="connexionerror">
                    Identifiant ou mot de passe incorrect
                </div>
            </body>
        </html>
        <?php
    }
}

?>


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

        <?php
            include 'Utile/header.php';
        ?>

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
                    Mail :<br><input class="entree" type="email" name="mail" placeholder="Entrez votre mail ici"><br>
                    Mot de passe :<br><input class="entree" type="password" name="pass" placeholder="Entrez votre mot de passe ici"><br>
                    <button type="submit">Se connecter</button>
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

