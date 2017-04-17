<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
    $errors = array();

    //Mot de passe
    if(!empty($_POST['pass'])){
        if(empty($_POST['pass']) || mb_strlen($_POST['pass']) < 4 || ($_POST['pass'] != $_POST['passconfirm']) || preg_match('/[@#&é"(§è!çà)ë“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['pass'])){
            $errors['pass'] = "mot de passe invalide, veillez à respecter les règles.";
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

    //Mail
    if(!empty($_POST['mail'])){
        if(empty($_POST['mail']) || ($_POST['mail'] != $_POST['mailconfirm']) || preg_match('/[#&"(§!çà)“‘{¶«¡Çø}°^¨ô$*€ùÙ%`£,?;:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $errors['mail'] = "nouvelle adresse mail invalide.";
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $mail = ($_POST['mail']);
            $pdo->prepare('UPDATE utilisateurs SET mail = ? WHERE id = ?')->execute([$mail, $user_id]);
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionok">
                Votre adresse mail a bien été mise à jour<br>
                (déconnectez-vous puis reconnectez-vous avec votre nouvelle adresse afin que celle-ci prenne effet)
            </div>
            </body>
            </html>
            <?php

        }
    }

    //Nom
    if(!empty($_POST['nom'])){
        if(empty($_POST['nom']) || ($_POST['nom'] != $_POST['nomconfirm']) || preg_match('/[@#&"(§!çà)“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['nom'])){
            $errors['nom'] = "nouveau nom invalide, veillez à respecter les règles.";
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $nom = ($_POST['nom']);
            $pdo->prepare('UPDATE utilisateurs SET nom = ? WHERE id = ?')->execute([$nom, $user_id]);
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionok">
                Votre nom a bien été mis à jour
            </div>
            </body>
            </html>
            <?php

        }
    }

    //Prénom
    if(!empty($_POST['prenom'])){
        if(empty($_POST['prenom']) || ($_POST['prenom'] != $_POST['prenomconfirm']) || preg_match('/[@#&"(§!çà)“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['prenom'])){
            $errors['prenom'] = "nouveau prénom invalide, veillez à respecter les règles.";
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $prenom = ($_POST['prenom']);
            $pdo->prepare('UPDATE utilisateurs SET prenom = ? WHERE id = ?')->execute([$prenom, $user_id]);
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionok">
                Votre prénom a bien été mis à jour
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
        <title>Paramètres</title>
        <link rel="stylesheet" href="style.css" />
        <style>#param{color: #17e486}</style>
    </head>

    <body>

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

        <div id="actuel">
            <strong>Vos infos actuelles :</strong> <?= $_SESSION['auth']->prenom;?> <?= $_SESSION['auth']->nom;?>, <?= $_SESSION['auth']->mail;?>.<br>
            (Vous devrez vous reconnectez pour effectuer les changements correctement)
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alerterror">
                <p>La modification ne s'est pas effectuée :</p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div id="connexion">
            <div id="title">
                Modifiez votre mot de passe
                <hr>
            </div>
            <div id="formulaireCo">
                <form method="post" action="">
                    <br>
                    <input class="entree" type="password" name="pass" placeholder="Changer votre mot de passe"><br>
                    <input class="entree" type="password" name="passconfirm" placeholder="Confirmez votre nouveau mot de passe"><br>
                    <button type="submit" class="buttonCoIndex">Changer de mot de passe</button>
                </form>
                Veillez à avoir un mot de passe de minimum 4 caractères, sans caractères spéciaux.
            </div>
            <div id="formulaireCo">
                <form method="post" action="">
                    <br>
                    <input class="entree" type="email" name="mail" placeholder="Entrez votre nouveau mail"><br>
                    <input class="entree" type="email" name="mailconfirm" placeholder="Confirmez votre nouveau mail"><br>
                    <button type="submit" class="buttonCoIndex">Changer d'adresse mail</button>
                </form>
                Veillez à avoir une adresse mail conforme (sans caractères spéciaux).
            </div>
            <div id="formulaireCo">
                <form method="post" action="">
                    <br>
                    <input class="entree" type="text" name="nom" placeholder="Entrez votre nouveau nom"><br>
                    <input class="entree" type="text" name="nomconfirm" placeholder="Confirmez votre nouveau nom"><br>
                    <button type="submit" class="buttonCoIndex">Changer de nom</button>
                </form>
                Veillez à avoir un nom sans caractères spéciaux.
            </div>
            <div id="formulaireCo">
                <form method="post" action="">
                    <br>
                    <input class="entree" type="text" name="prenom" placeholder="Entrez votre nouveau prénom"><br>
                    <input class="entree" type="text" name="prenomconfirm" placeholder="Confirmez votre nouveau prénom"><br>
                    <button type="submit" class="buttonCoIndex">Changer de prénom</button>
                </form>
                Veillez à avoir un prénom sans caractères spéciaux.
            </div>
        </div>

    </body>
</html>