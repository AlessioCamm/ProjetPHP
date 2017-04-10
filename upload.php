<?php
require_once 'Utile/db.php';
require_once 'fonctions.php';
logged_only();

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Télécharger</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div id="accueil">
            Télecharger un fichier
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
            C'est ici que vous pourrez télécharger un fichier sur le site.<br>
        </div>

        <div id="upload">
            <div id="titleupload">
                Modifiez votre mot de passe
                <hr>
            </div>
            <div id="formulaireUpload">
                <strong>ATTENTION : veillez à télécharger des fichiers utiles et tolérés. Ne téléchergez pas de fichiers idiots ou inutiles.<br>
                Peu importe la catégorie dans laquelle vous voulez mettre votre fichier, faites attention au type de fichier :<br>
                Word (.docx, .dotx), PDF (.pdf), texte (.txt), développement Web (.html, .css, .js), Affinity Designer (.afdesign), image (.png, .jpg, .jpeg, .gif)<br>
                <br>
                    Votre fichier sera supprimé s'il est corrompu, défaillant, ou qu'il n'a aucun rapport avec la catégorie séléctionnée.</strong>

            </div>
        </div>

    
</body>
</html>