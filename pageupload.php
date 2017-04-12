<?php
require_once 'Utile/db.php';
require_once 'fonctions.php';
logged_only();

    if(!empty($_FILES)){

        $date = date('Y/m/d H:i:s');
        $commentaire = $_POST['commentaire'];

        $file_name = $_FILES['file']['name'];
        $file_extension = strrchr($file_name, ".");
        $extensions_autorisees = array('.docx', '.DOCX', '.dotx', '.DOTX', '.doc', '.DOC', '.pdf', '.PDF', '.txt', '.TXT', '.html', '.HTML', '.css', '.CSS', '.js', '.JS', '.afdesign', '.AFDESIGN', '.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.gif', '.GIF');
        $file_taille = $_FILES['file']['size'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_dest = 'Uploads/'.$file_name;


        if(in_array($file_extension, $extensions_autorisees)){
            if($file_taille < 4000000){
                if(!preg_match('/[@#&"(§!çà)“{¶«¡Çø}_°^¨ô$*€ùÙ%£=+∞…÷≠±\•¿#‰¥ÔØÁÛ»å”„Ÿ-]/', $_POST['commentaire'])) {
                    if (move_uploaded_file($file_tmp_name, $file_dest)) {
                        $req = $pdo->prepare('INSERT INTO fichiers SET nom_user = ?, nomfichier = ?, extension = ?, taille = ?, dateT = ?, url = ?, commentaire = ?, categorie = ?');
                        $req->execute(array($_SESSION['auth']->prenom, $file_name, $file_extension, $file_taille, $date, $file_dest, $commentaire, $_POST['choixCat']));

                        ?>
                        <div class="uploadok">
                            ...ET LE FICHIER FUT !<br>
                            Votre fichier a été téléchargé avec succès.
                        </div>
                        <?php
                    } else {
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
                        Veuillez n'écrire que des caractères alphanumériques en commentaire<br>
                        (ainsi que le point, la virgule, le point-virgule, l'apostrophe et le point d'interrogation).
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="uploadnope">
                    Votre fichier est trop volumineux.
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
        <title>Télécharger</title>
        <link rel="stylesheet" href="style.css" />
        <style>#fileup{color: #17e486}</style>
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
            C'est ici que vous pourrez télécharger un fichier sur le site.<br>
        </div>

        <div id="upload">
            <div id="titleupload">
                Que le fichier soit...
                <hr>
            </div>
            <div id="formulaireUpload">
                <strong>ATTENTION : veillez à télécharger des fichiers utiles et tolérés. Ne téléchergez pas de fichiers idiots ou inutiles.<br>
                Peu importe la catégorie dans laquelle vous voulez mettre votre fichier, faites attention au type de fichier :<br>
                Word (.docx, .dotx), PDF (.pdf), texte (.txt), développement Web (.html, .css, .js), Affinity Designer (.afdesign), image (.png, .jpg, .jpeg, .gif)<br>
                Taille max d'un fichier : 4 Mo.<br>
                <br>
                Votre fichier sera supprimé s'il est corrompu, défaillant, ou qu'il n'a aucun rapport avec la catégorie séléctionnée.</strong><br>
                <hr>
                <form method="post" enctype="multipart/form-data" class="formUpload">
                    Séléctionnez un fichier à télécharger :<br>
                    <input type="file" name="file" id="fileToUpload"><br>

                    Séléctionnez la catégorie de votre fichier ('Informatique' par défaut) :<br>
                    <select name="choixCat">
                        <option value="Informatique" selected="selected">Informatique</option>
                        <option value="Developpement">Développement</option>
                        <option value="Electronique">Electronique</option>
                        <option value="Graphisme">Graphisme</option>s
                    </select><br>

                    Laissez un commentaire (optionnel, 200 caractères max) :<br>
                    <textarea name="commentaire" rows="5" cols="31" maxlength="200"></textarea><br>
                    <br>

                    <input type="submit" value="Télécharger le fichier" name="submit">
                </form>

            </div>
        </div>

    
    </body>
</html>