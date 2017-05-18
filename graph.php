<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();

    include_once "Utile/deletefilescript.php";
    include_once "Utile/uploadscript.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Graphisme | <?= $_SESSION['auth']->prenom; ?></title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuGraph{color:#00aaff} .barrenom2 .BarreMenuGraph{color: #000000; background-color: #ff8d4e; border-radius: 5px;}</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- Ici c'est le script JS-->
        <script src="js/script.js" type="text/javascript"></script>
    </head>

    <body>

        <?php
            include 'Utile/header.php';
        ?>

        <?php
            include 'Utile/barremenu.php';
        ?>

        <?php if (!empty($errors)): ?>
            <div class="alerterror">
                <p>Vous n'avez pas rempli le formulaire correctement</p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="uploadFileDiv">
            <a href="pageupload.php">Télécharger un fichier</a>
        </form>

        <div class="fenetrePerso">
            <img class="fenetrePersoPhoto" src="<?php echo $_SESSION['auth']->photoprofil; ?>" alt="Image profil"><br>
            <form class="fenetrePersoNom">
                <?php echo $_SESSION['auth']->prenom; ?><br>
                <?php echo $_SESSION['auth']->nom; ?>
                <hr class="hrPerso" onclick="ouverture()" onmouseover="barre()" onmouseout="barreOut()">
            </form>
            <form method="post" enctype="multipart/form-data" class="fenetrePersoUpload">
                <input type="file" name="file" id="fileToUpload" class="fenetrePersoButton"><br>
                <select name="choixCat">
                    <option value="Informatique">Informatique</option>
                    <option value="Développement">Développement</option>
                    <option value="Electronique">Electronique</option>
                    <option value="Graphisme" selected="selected">Graphisme</option>s
                </select><br>
                <textarea name="commentaire" rows="8" cols="20" maxlength="200" placeholder="Fichier de max 20 Mo, catégorie 'Graphisme' par défaut, commentaire optionnel de 200 caractères. Plus d'infos dans l'onglet 'Gérer vos fichiers'."></textarea><br>
                <input type="submit" value="Télécharger le fichier" name="submit">
            </form>
        </div>

        <div id="listeFond">
            <div id="liste">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers WHERE categorie="Graphisme" ORDER BY id_fichier DESC');

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
                        ?>
                        <?php if($_SESSION['auth']->id == '19'){
                            ?>
                            <a href="graph.php?<?=$donnees['id_fichier']?>"><img class="suppr" src="Images/suppr.png" alt="Image suppression" title="Supprimer le fichier '<?php echo $donnees['nomfichier']; ?>'"></a>
                            <?php
                        }

                        $datetime = date_create($donnees['dateT']);
                        $date = date_format($datetime,"d/m/Y");
                        $time = date_format($datetime,"H:i");

                        $dateNow = new DateTime($donnees['dateT']);
                        $dateSite = new DateTime(date('Y/m/d H:i:s'));
                        $interval = $dateNow->diff($dateSite);
                        ?>
                        <strong class="filedate2 wow fadeInRight"><?php echo $date; ?><br>
                            <?php echo $time; ?></strong>
                        <img class="profil" src="<?php echo $donnees['photo_user']; ?>" alt="Image profil"><strong class="fileuser"><?php echo $donnees['prenom_user']; ?> <?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $interval->format('%a'); ?> jour(s), <?php echo $interval->format('%h'); ?> h et <?php echo $interval->format('%i'); ?> m</strong><br>
                        <hr>
                        <em class="filecom"><strong><?php echo $donnees['commentaire']; ?></strong></em><br>
                        <div class="divfile">
                            <img class="imagefichier" src="<?php echo $image ?>" alt="Image fichier"><a class="filelien" href="<?php echo $donnees['url']; ?>"><?php echo $donnees['nomfichier']; ?></a><br>
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