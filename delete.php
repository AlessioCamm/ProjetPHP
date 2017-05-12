<?php
    session_start();
    unset($_SESSION['auth']);

    if(!empty($_POST) && !empty($_POST['mail']) && !empty($_POST['pass'])){
        require_once 'Utile/db.php';
        require_once 'fonctions.php';
        $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
        $req->execute(['mail' => $_POST['mail']]);
        $user = $req->fetch();
        if(password_verify($_POST['pass'], $user->pass)){
            $pdo->exec('DELETE FROM utilisateurs WHERE mail = "'.$_POST['mail'].'"');
            ?>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Suppression effectuée</title>
                    <link rel="stylesheet" href="style.css" />
                </head>
                <body>
                    <div class="inscriptionok">
                        Votre compte a bien été supprimé.
                        <br>
                        <a href="index.php" class="boutonCo">Accueil</a>
                    </div>
                </body>
            </html>
            <?php
        }else{
            ?>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Erreur</title>
                <link rel="stylesheet" href="style.css" />
            </head>
            <body>
            <div class="connexionerror">
                Combinaison mail/mot de passe incorrecte
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

        <?php
        include 'Utile/header.php';
        ?>

        <div id="divtitre">
            Envie de s'en aller ?<br>
            <br>
        </div>

        <div id="connexion">
            <div id="title">
                Supprimer votre compte
                <hr>
            </div>
            <div id="formulaireCo">
                Afin de supprimer votre compte, veuillez entrer votre adresse mail ainsi que votre mot de passe.<br>
                <br>
                <form method="POST">
                    Mail :<br><input class="deletechamp" type="email" name="mail" placeholder="Entrez votre mail ici"><br>
                    Mot de passe :<br><input class="deletechamp" type="password" name="pass" placeholder="Entrez votre mot de passe ici"><br>
                    <br>
                    ATTENTION : une fois votre compte supprimer, vous ne pourrez plus le récupérer.<br>
                    Cependant, vos fichiers resteront sur le site permettant ainsi aux utilisateurs de pouvoir télécharger vos fichiers uploadés.<br>
                    <br>
                    <button type="submit" class="buttonDeleteOk">Supprimer mon compte</button>
                </form>
                <br>
            </div>
        </div>

    </body>
</html>