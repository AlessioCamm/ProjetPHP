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
            <script type="text/javascript">
                function notifmdp(){
                    $(".notifmdp").stop(true,true).fadeIn();
                }
                setTimeout(notifmdp, 100);

                function notifmdpGo(){
                    $(".notifmdp").stop(true,true).fadeOut();
                }
                setTimeout(notifmdpGo, 6000);
            </script>
            <?php

        }
    }

    //Mail
    if(!empty($_POST['mail'])){
        if(empty($_POST['mail']) || ($_POST['mail'] != $_POST['mailconfirm']) || preg_match('/[#&"(§!çà)“‘{¶«¡Çø}°^¨ô$*€ùÙ%`£,?;:=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å’”„´Ÿ-]/', $_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $errors['mail'] = "nouvelle adresse mail invalide.";
        }
        if($_POST['mail'] == $_POST['mailconfirm']){
            $req = $pdo->prepare('SELECT id FROM utilisateurs WHERE mail = ?');
            $req->execute([$_POST['mail']]);
            $answer = $req->fetch();
            if($answer){
                $errors['mail'] = 'Cette adresse mail est déjà utilisée';
            }
            else{
                $user_id = $_SESSION['auth']->id;
                $mail = ($_POST['mail']);
                $pdo->prepare('UPDATE utilisateurs SET mail = ? WHERE id = ?')->execute([$mail, $user_id]);
                ?>
                <script type="text/javascript">
                    function notifmail(){
                        $(".notifmail").stop(true,true).fadeIn();
                    }
                    setTimeout(notifmail, 100);

                    function notifmailGo(){
                        $(".notifmail").stop(true,true).fadeOut();
                    }
                    setTimeout(notifmailGo, 6000);
                </script>
                <?php

            }
        }

    }

    //Nom
    if(!empty($_POST['nom'])){
        if(empty($_POST['nom']) || ($_POST['nom'] != $_POST['nomconfirm']) || preg_match('/[^a-zA-Z\-\ç\é\è\à]/', $_POST['nom'])){
            $errors['nom'] = "nouveau nom invalide, veillez à respecter les règles.";
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $nom = ($_POST['nom']);
            $pdo->prepare('UPDATE utilisateurs SET nom = ? WHERE id = ?')->execute([$nom, $user_id]);
            ?>
            <script type="text/javascript">
                function notifnom(){
                    $(".notifnom").stop(true,true).fadeIn();
                }
                setTimeout(notifnom, 100);

                function notifnomGo(){
                    $(".notifnom").stop(true,true).fadeOut();
                }
                setTimeout(notifnomGo, 6000);
            </script>
            <?php

        }
    }

    //Prénom
    if(!empty($_POST['prenom'])){
        if(empty($_POST['prenom']) || ($_POST['prenom'] != $_POST['prenomconfirm']) || preg_match('/[^a-zA-Z\-\ç\é\è\à]/', $_POST['prenom'])){
            $errors['prenom'] = "nouveau prénom invalide, veillez à respecter les règles.";
        }
        else{
            $user_id = $_SESSION['auth']->id;
            $prenom = ($_POST['prenom']);
            $pdo->prepare('UPDATE utilisateurs SET prenom = ? WHERE id = ?')->execute([$prenom, $user_id]);
            ?>
            <script type="text/javascript">
                function notifprenom(){
                    $(".notifprenom").stop(true,true).fadeIn();
                }
                setTimeout(notifprenom, 100);

                function notifprenomGo(){
                    $(".notifprenom").stop(true,true).fadeOut();
                }
                setTimeout(notifprenomGo, 6000);
            </script>
            <?php

        }
    }

    //Photo de profil
    if(!empty($_FILES)){
        $file_name = $_FILES['filePhotoProfil']['name'];
        $file_extension = strrchr($file_name, ".");
        $extensions_autorisees = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
        $file_taille = $_FILES['filePhotoProfil']['size'];
        $file_tmp_name = $_FILES['filePhotoProfil']['tmp_name'];
        $file_dest = 'ProfilPic/'.$file_name;

        if(in_array($file_extension, $extensions_autorisees)){
            if($file_taille < 2000000){
                if(move_uploaded_file($file_tmp_name, $file_dest)){
                    $user_id = $_SESSION['auth']->id;
                    $req = $pdo->prepare('UPDATE utilisateurs SET photoprofil = ? WHERE id = ?')->execute([$file_dest, $user_id]);
                    ?>
                    <script type="text/javascript">
                        function notifphoto(){
                            $(".notifphoto").stop(true,true).fadeIn();
                        }
                        setTimeout(notifphoto, 100);

                        function notifphotoGo(){
                            $(".notifphoto").stop(true,true).fadeOut();
                        }
                        setTimeout(notifphotoGo, 6000);
                    </script>
                    <?php
                }
                else {
                    ?>
                    <div class="uploadnope">
                        Un problème innatendu est survenu.
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="uploadnope">
                    Votre photo est trop volumineuse.
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="uploadnope">
                L'extension de votre fichier est incorrecte.
            </div>
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
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- Ici c'est le script JS-->
        <script src="js/script.js" type="text/javascript"></script>
        <script>
            function deleteFunction(){
                var reponse = confirm("Êtes-vous sûr(e) de vouloir supprimer votre compte ?\n" +
                    "Vous allez être deconnecté(e) du site et redirigé(e) sur une autre page.");

                if(reponse == true){
                    window.location="delete.php";
                }
                else{

                }
            }
        </script>
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
            <img class="profilinfo" src="<?php echo $_SESSION['auth']->photoprofil;; ?>" alt="Image profil">
            <strong>Vos infos actuelles :</strong> <?= $_SESSION['auth']->prenom;?> <?= $_SESSION['auth']->nom;?>, <?= $_SESSION['auth']->mail;?><br>
            (Vous devrez vous reconnectez pour effectuer les changements correctement)
        </div>

        <div class="notifmdp">
            Mot de passe mis à jour.<br>
            Déconnectez-vous pour que les changements prennent effets.
        </div>

        <div class="notifmail">
            Adresse mail mise à jour.<br>
            Déconnectez-vous pour que les changements prennent effets.
        </div>

        <div class="notifnom">
            Nom mis à jour.<br>
            Déconnectez-vous pour que les changements prennent effets.
        </div>

        <div class="notifprenom">
            Prénom mis à jour.<br>
            Déconnectez-vous pour que les changements prennent effets.
        </div>

        <div class="notifphoto">
            Photo mise à jour.<br>
            Déconnectez-vous pour que les changements prennent effets.
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
                Modifiez vos informations
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
            <div id="formulaireCo">
                <form method="post" action="" enctype="multipart/form-data">
                    <br>
                    Séléctionnez une nouvelle photo de profil :<br>
                    <input type="file" name="filePhotoProfil"><br>
                    <button type="submit" class="buttonCoIndex">Changer de photo de profil</button>
                </form>
                Veillez à sélectionner une photo de moins de 2 Mo.<br>
                L'image sera affichée en petite taille, prenez donc une photo adaptée.
            </div>

            <?php if($_SESSION['auth']->id != '19'){
                ?>
                <br>
                <button type="submit" class="buttonDelete" onclick="deleteFunction()">
                    Supprimer mon compte
                </button>
                <?php
            }
            ?>
        </div>

    </body>
</html>