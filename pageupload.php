<?php
require_once 'Utile/db.php';
require_once 'fonctions.php';
logged_only();

    $url = $_SERVER['REQUEST_URI'];
    $parse = parse_url($url);
    if(!empty($parse['query'])){
        $suppfile = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
        $ok = $suppfile->query('SELECT nomfichier FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        while($okok = $ok->fetch()){
            unlink("Uploads/" . $okok['nomfichier']);
        }
        $pdo->exec('DELETE FROM fichiers WHERE id_fichier = "'.$parse['query'].'"');
        ?>
        <script type="text/javascript">
            function notifRed(){
                $(".notifRed").stop(true,true).fadeIn();
            }
            setTimeout(notifRed, 200);

            function notifRedGo(){
                $(".notifRed").stop(true,true).fadeOut();
            }
            setTimeout(notifRedGo, 3000);
        </script>
        <?php
    }

    if(!empty($_FILES)){
        $errors = array();

        $date = date('Y/m/d H:i:s');
        $commentaire = $_POST['commentaire'];

        $file_name = $_FILES['file']['name'];
        $file_extension = strrchr($file_name, ".");
        $extensions_autorisees = array('.docx', '.DOCX','.docm', '.DOCM', '.dotx', '.DOTX', '.doc', '.DOC', '.ppt', '.PPT', '.pptx', '.PPTX','.pdf', '.PDF', '.txt', '.TXT', '.html', '.HTML', '.css', '.CSS', '.js', '.JS', '.afdesign', '.AFDESIGN', '.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.gif', '.GIF', '.zip', '.ZIP', '.rar', '.RAR');
        $file_taille = $_FILES['file']['size'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_dest = 'Uploads/'.$file_name;

        if(in_array($file_extension, $extensions_autorisees)){
            if($file_taille < 25000000){
                if(!preg_match('/[]@#&§!ç¡Çø_°|$*€%£+∞÷≠±•¿#‰/', $_POST['commentaire'])) {
                    if (move_uploaded_file($file_tmp_name, $file_dest)) {
                        $req = $pdo->prepare('INSERT INTO fichiers SET id_user = ?, prenom_user = ?, nom_user = ?, photo_user = ?, nomfichier = ?, extension = ?, taille = ?, dateT = ?, url = ?, commentaire = ?, categorie = ?');
                        $req->execute(array($_SESSION['auth']->id, $_SESSION['auth']->prenom, $_SESSION['auth']->nom, $_SESSION['auth']->photoprofil, $file_name, $file_extension, $file_taille, $date, $file_dest, $commentaire, $_POST['choixCat']));

                        ?>
                        <script type="text/javascript">
                            function notif(){
                                $(".notif").stop(true,true).fadeIn();
                            }
                            setTimeout(notif, 200);

                            function notifGo(){
                                $(".notif").stop(true,true).fadeOut();
                            }
                            setTimeout(notifGo, 3000);
                        </script>
                        <?php
                    }
                    else{
                        $errors['3'] = 'Un problème innatendu est survenu';
                    }
                }
                else{
                    $errors['2'] = 'Veuillez n\'écrire que des caractères alphanumériques en commentaire';
                }
            }
            else{
                $errors['1'] = 'Votre fichier est trop volumineux';
            }
        }
        else{
            $errors['0'] = 'Fichier non séléctionné ou extension non autorisée';
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gérer vos fichiers</title>
        <link rel="stylesheet" href="style.css" />
        <style>#fileup{color: #17e486}</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- Ici c'est le script JS-->
        <script src="js/script.js" type="text/javascript"></script>
    </head>

    <body>

        <?php
            include 'Utile/header.php';
        ?>

        <div class="notif">
            Fichier téléchargé
        </div>

        <div class="notifRed">
            Fichier supprimé
        </div>

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
            C'est ici que vous pourrez télécharger un fichier sur le site,<br>
            mais aussi voir ou supprimer ce que vous avez déjà téléchargé.<br>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alerterror">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div id="upload">
            <div id="titleupload">
                Que le fichier soit...
                <hr>
            </div>
            <div id="formulaireUpload">
                <strong>ATTENTION : veillez à télécharger des fichiers utiles et tolérés. Ne téléchargez pas de fichiers idiots ou inutiles.<br>
                Peu importe la catégorie dans laquelle vous voulez mettre votre fichier, faites attention à son extension :<br>
                Word (.docx, .dotx), Power Point (.ppt, .pptx), PDF (.pdf), texte (.txt), développement Web (.html, .css, .js), Affinity Designer (.afdesign), image (.png, .jpg, .jpeg, .gif), fichier compressé ( .zip, .rar).<br>
                Taille max d'un fichier : 25 Mo.<br>
                Vous pouvez toujours compressé vos fichiers avant de les télécharger sur le site si leur taille est nativement de plus de 25 Mo.<br>
                <br>
                Votre fichier sera supprimé s'il est corrompu, défaillant, ou qu'il n'a aucun rapport avec la catégorie séléctionnée.</strong><br>
                <hr>
                <form method="post" enctype="multipart/form-data" class="formUpload">
                    Séléctionnez un fichier à télécharger :<br>
                    <input type="file" name="file" id="fileToUpload"><br>

                    Séléctionnez la catégorie de votre fichier ('Informatique' par défaut) :<br>
                    <select name="choixCat">
                        <option value="Informatique" selected="selected">Informatique</option>
                        <option value="Développement">Développement</option>
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

        <div id="fichierListe">
            <div id="fichierListeTitre">
                ...et le fichier fut !
                <hr>
            </div>
            <div id="fichierListeListe">
                <?php
                $test = $_SESSION['auth']->id;
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers WHERE id_user='.$test.' ORDER BY id_fichier DESC');

                while($donnees = $reponse->fetch()){?>
                    <div>
                        <?php
                            if($donnees['extension'] == ".docx" || $donnees['extension'] == ".DOCX" || $donnees['extension'] == ".dotx" || $donnees['extension'] == ".DOTX" || $donnees['extension'] == ".doc" || $donnees['extension'] == ".DOC"){
                                $image = "ExtImage/word.png";
                            }
                            if($donnees['extension'] == ".pdf" || $donnees['extension'] == ".PDF"){
                                $image = "ExtImage/pdf.png";
                            }
                            if($donnees['extension'] == ".png" || $donnees['extension'] == ".PNG" || $donnees['extension'] == ".jpg" || $donnees['extension'] == ".JPG" || $donnees['extension'] == ".jpeg" || $donnees['extension'] == ".JPEG"){
                                $image = "ExtImage/image.png";
                            }
                            if($donnees['extension'] == ".gif" || $donnees['extension'] == ".GIF"){
                                $image = "ExtImage/gif.png";
                            }
                            if($donnees['extension'] == ".rar" || $donnees['extension'] == ".RAR"){
                                $image = "ExtImage/rar.png";
                            }
                            if($donnees['extension'] == ".zip" || $donnees['extension'] == ".ZIP"){
                                $image = "ExtImage/zip.png";
                            }
                            if($donnees['extension'] == ".txt" || $donnees['extension'] == ".TXT"){
                                $image = "ExtImage/text.png";
                            }
                            if($donnees['extension'] == ".html" || $donnees['extension'] == ".HTML"){
                                $image = "ExtImage/html.png";
                            }
                            if($donnees['extension'] == ".css" || $donnees['extension'] == ".css"){
                                $image = "ExtImage/css.png";
                            }
                            if($donnees['extension'] == ".js" || $donnees['extension'] == ".JS"){
                                $image = "ExtImage/javascript.png";
                            }
                            if($donnees['extension'] == ".afdesign" || $donnees['extension'] == ".AFDESIGN"){
                                $image = "ExtImage/afdesign.png";
                            }
                            if($donnees['extension'] == ".txt" || $donnees['extension'] == ".TXT"){
                                $image = "ExtImage/text.png";
                            }
                            if($donnees['extension'] == ".ppt" || $donnees['extension'] == ".PPT" || $donnees['extension'] == ".pptx" || $donnees['extension'] == ".PPTX"){
                                $image = "ExtImage/ppt.png";
                            }

                        $datetime = date_create($donnees['dateT']);
                        $date = date_format($datetime,"d/m/Y");
                        $time = date_format($datetime,"H:i");
                        ?>
                        <a href="pageupload.php?<?=$donnees['id_fichier']?>"><img class="suppr" src="Images/suppr.png" alt="Image suppression" title="Supprimer le fichier '<?php echo $donnees['nomfichier']; ?>'"></a>
                        <img class="profilListe" src="<?php echo $donnees['photo_user']; ?>" alt="Image profil"><strong class="fileuser"><strong class="filedate"><?php echo $date; ?> à <?php echo $time; ?></strong><br>
                        <hr>
                        <em class="filecom"><strong><?php echo $donnees['commentaire']; ?></strong></em><br>
                        <div class="divfile">
                            <img class="imagefichierListe" src="<?php echo $image ?>" alt="Image fichier"><a class="filelienListe" href="<?php echo $donnees['url']; ?>"><?php echo $donnees['nomfichier']; ?></a><br>
                            <?php echo ($donnees['taille'] / 1000000); ?> Mo - <?php echo $donnees['categorie']; ?>
                        </div>
                    </div>
                <?php  }
                $reponse->closeCursor();
                ?>
            </div>
            <br>
        </div>

    
    </body>
</html>