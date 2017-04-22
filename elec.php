<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Electronique</title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuElec{color:#00aaff}</style>
    </head>

    <body>

        <?php
            include 'Utile/header.php';
        ?>

        <?php
            include 'Utile/barremenu.php';
        ?>

        <div id="listeFond">
            <div id="listeTitre">
                Fichiers pour l'électronique
                <hr>
            </div>
            <div id="liste">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers WHERE categorie="Electronique" ORDER BY id_fichier DESC');

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
                        <img class="profil" src="<?php echo $donnees['photo_user']; ?>" alt="Image profil"><strong class="fileuser"><?php echo $donnees['prenom_user']; ?> <?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $donnees['dateT']; ?></strong><br>
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