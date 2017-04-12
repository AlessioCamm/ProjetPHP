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
                        <strong class="fileuser"><?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $donnees['dateT']; ?></strong><br>
                        <em class="filecom"><strong><?php echo $donnees['commentaire']; ?></strong></em><br>
                        <a class="filelien" href="<?php $donnees['url']; ?>"><?php echo $donnees['nomfichier']; ?></a>
                        - <?php echo $donnees['taille']; ?> octets - <?php echo $donnees['categorie']; ?>
                    </div>
                <?php  }
                $reponse->closeCursor();
                ?>
            </div>
            <br>
        </div>

    </body>
</html>