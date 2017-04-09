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
        <title>Vos infos</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div id="accueil">
            Vos informations
        </div>

        <?php
            include 'Utile/header.php';
        ?>

        <div class="barrenom">
            <a href="account.php">Retour à l'accueil</a>
            <?php if($_SESSION['auth']->id == '19'){
                ?>
                <style>.barrenom{
                        border-top-left-radius: 0px;
                        border-top-right-radius: 0px;
                    }</style>
                <?php
            }
            ?>
        </div>

        <div id="divtitre" class="inscription">
            Alors <?= $_SESSION['auth']->prenom; ?>, vous voulez modifier des informations ?<br>
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
                    <button type="submit" class="buttonCoIndex">Changer de mot de passe</button>
                </form>
                <br>
            </div>
        </div>

        <?php if($_SESSION['auth']->id == '19'){
            $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
            $reponse = $bdd->query('SELECT * FROM utilisateurs');
            ?>
        <div id="admin">
            <div id="title">
                Infos des utilisateurs
                <hr>
            </div>
            <div id="adminIn">
            <?php
            while($donnees = $reponse->fetch()){?>
                <p class="adminP">
                    <strong class="nomprenomadmin"><?php echo $donnees['prenom']; ?> <?php echo $donnees['nom']; ?></strong>
                     -
                    <strong class="idadmin">ID n°<?php echo $donnees['id']; ?></strong>
                    -
                    <strong class="mailadmin">Mail : <?php echo $donnees['mail']; ?></strong><br>
                </p>
            <?php  }
            $reponse->closeCursor();
            ?>
            </div>
        </div>
        <?php
        }
        ?>

    </body>
</html>