<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fichiers Word</title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuWord{color:#00aaff}</style>
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
                Fichiers Word
                <hr>
            </div>
            <div id="liste">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers WHERE extension=".docx" OR extension=".DOCX" OR extension=".dotx" OR extension=".DOTX" ORDER BY id_fichier DESC');

                while($donnees = $reponse->fetch()){?>
                    <div>
                        <?php
                            if($donnees['extension'] == ".docx" || $donnees['extension'] == ".DOCX" || $donnees['extension'] == ".dotx" || $donnees['extension'] == ".DOTX" || $donnees['extension'] == ".doc" || $donnees['extension'] == ".DOC"){
                                $image = "ExtImage/word.png";
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