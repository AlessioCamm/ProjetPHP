<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['auth'])){

    header('Location: account.php');
    exit();
}

require_once 'fonctions.php';

if(!empty($_POST)){//Vérifier les champs
    $errors = array();
    require_once 'Utile/db.php';

    if(empty($_POST['nom']) || preg_match('/[@#&"(§!çà)“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['nom'])){
        $errors['nom'] = "Votre nom n'est pas valide, veuillez n'entrer que des lettres.";
    }

    if(empty($_POST['prenom']) || preg_match('/[@#&"(§!çà)“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['prenom'])){
        $errors['prenom'] = "Votre prénom n'est pas valide, veuillez n'entrer que des lettres.";
    }

    if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        $errors['mail'] = "Votre mail n'est pas valide.";
    }else{
        $req = $pdo->prepare('SELECT id FROM utilisateurs WHERE mail = ?');
        $req->execute([$_POST['mail']]);
        $answer = $req->fetch();
        if($answer){
            $errors['mail'] = 'Cette adresse mail est déjà utilisée';
        }
    }

    if(empty($_POST['pass']) || mb_strlen($_POST['pass']) < 4 || $_POST['pass'] != $_POST['passconfirm'] || preg_match('/[@#&é"(§è!çà)ë“‘{¶«¡Çø}_°^¨ô$*€ùÙ%`£,?;.:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['pass'])){
        $errors['pass'] = "Vous devez entrer un mot de passe valide (minimum 4 caractères) qui soit identique dans les deux champs.";
    }

    //Inscrire un utilisateur
    if(empty($errors)){
        $req = $pdo->prepare("INSERT INTO utilisateurs SET nom = ?, prenom = ?, mail = ?, pass = ?");
        $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['mail'], $password]);

        ?>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Inscription effectuée</title>
            <link rel="stylesheet" href="style.css" />
        </head>
        <body>
            <div class="inscriptionok">
                Vous voilà inscrit(e) !
                <br>
                Retournez à <a href="index.php" class="boutonCo">l'accueil</a> pour vous connecter.
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
        <title>Inscrivez-vous !</title>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>



    <?php
        include 'Utile/header.php';
    ?>

    <div id="divtitre" class="inscription">
        Donc vous n'avez pas de compte ?<br>
        Mais qu'attendez-vous pour en faire un ?!<br>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alerterror">
            <p>Vous n'avez pas rempli le formulaire correctement.</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div id="connexion">
        <div id="title">
            Formulaire d'inscription
            <hr>
        </div>
        <div id="formulaireCo">
            <form method="post" action="">
                Nous avons besoin de certaines coordonnées pour que votre inscription soit validée.<br>
                <br>
                Nom<br><input class="entreeIns" type="text" name="nom" placeholder="Entrez votre nom"><br>
                Prénom<br><input class="entreeIns" type="text" name="prenom" placeholder="Entrez votre prénom"><br>
                Mail<br><input class="entreeIns" type="email" name="mail" placeholder="Entrez votre adresse mail"><br>
                Mot de passe<br><input class="entreeIns" type="password" name="pass" placeholder="Entrez votre mot de passe"><br>
                Confirmez votre mot de passe<br><input class="entreeIns" type="password" name="passconfirm" placeholder="Confirmez votre mot de passe"><br>
                <button type="submit" class="boutonInsReg">M'inscrire</button>
            </form>
            Vous avez déjà un compte ? <a href="index.php" class="lienInd">Retour à l'accueil</a>.<br>
            <br>
            Veillez à avoir un mail et un mot de passe qui comptent plus de 4 caractères chacun.<br>
            En créant un compte, vous confirmez respecter les règles suivantes :<br>
            - ne pas partager de fichiers explicites ou inconvenants;<br>
            - ne pas partager de fichiers dont vous n'avez pas les droits;<br>
            - respecter les autres utilisateurs.<br>
            <br>
            Si vous ne respectez pas une de ces règles, vous pourrez être banni.<br>
            (Mais en vrai on est cool, ne vous en faites pas.)
        </div>
    </div>

    <?php
    include 'Utile/footer.php';
    ?>

    </body>
</html>

