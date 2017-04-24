<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fichiers PDF</title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuPDF{color:#00aaff}</style>
    </head>

    <body>

        <?php
            include 'Utile/header.php';
        ?>

        <?php
            include 'Utile/barremenu.php';
        ?>

        <div id="listeFond">
            <div id="liste">
                <form class="uploadFileDiv">
                    <a href="pageupload.php">Télécharger un fichier</a>
                </form>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers WHERE extension=".pdf" OR extension=".PDF" ORDER BY id_fichier DESC');

                while($donnees = $reponse->fetch()){?>
                    <div>
                        <?php
                            if($donnees['extension'] == ".pdf" || $donnees['extension'] == ".PDF"){
                                $image = "ExtImage/pdf.png";
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