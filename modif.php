<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();

    if(!empty($_POST)){
        if(empty($_POST['pass']) || mb_strlen($_POST['pass']) < 4 || ($_POST['pass'] != $_POST['passconfirm']) || !preg_match('/^[a-zA-Z0-9]/', $_POST['pass'])){
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionerror">
                Les mots de passe ne correspondent pas<br>
                Veillez à écrire des mots de passes identiques en respéctant les règles
            </div>
            </body>
            </html>
            <?php
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $pdo->prepare('UPDATE utilisateurs SET pass = ? WHERE id = ?')->execute([$pass, $user_id]);
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionok">
                Votre mot de passe a bien été mis à jour
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
        <title>Modifier vos infos</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div id="accueil">
            Modifier vos informations
        </div>

        <?php
            include 'Utile/header.php';
        ?>

        <div class="barrenom">
            <a href="account.php">Retour à l'accueil</a>
        </div>

        <div id="divtitre" class="inscription">
            Vous voulez modifier des informations ?<br>
            Allez-y, c'est simple.<br>
        </div>

        <div id="connexion">
            <div id="title">
                Formulaire de modification
                <hr>
            </div>
            <div id="formulaireCo">
                <form method="post" action="">
                    <br>
                    <input class="entree" type="password" name="pass" placeholder="Changer votre mot de passe"><br>
                    <input class="entree" type="password" name="passconfirm" placeholder="Confirmez votre nouveau mot de passe"><br>
                    <button type="submit">Changer de mot de passe</button>
                </form>
                <br>
            </div>
        </div>

    </body>
</html>