<?php
//Si non connecté, redirection vers "account.php"
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['auth'])){
    header('Location: account.php');
    exit();
}

if(!empty($_POST) && !empty($_POST['mail']) && !empty($_POST['pass'])){//Si tous les champs sont remplis, alors
    require_once 'Utile/db.php';//Connexion a la BDD
    require_once 'fonctions.php';
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');//Sélection du mail dans la BDD
    $req->execute(['mail' => $_POST['mail']]);
    $user = $req->fetch();
    if(password_verify($_POST['pass'], $user->pass)){//Vérification du mot de passe
        session_start();//La session démarre
        $_SESSION['auth'] = $user;//Nom de la session = infos utilisateur
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
                    Identifiant/mail ou mot de passe incorrect
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
            Site de partage/sauvegarde de fichiers informatiques en PHP <br>
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
                    <button type="submit" class="buttonCoIndex">Se connecter</button>
                </form>
                <br>
                Pas de compte ? Pas de souci. <a href="register.php" class="lienInd">Incrivez-vous ici</a> !<br>
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

