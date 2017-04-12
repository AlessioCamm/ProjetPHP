<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuAcc{color: #00aaff}</style>
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
                Tous les fichiers
                <hr>
            </div>
            <div id="liste">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM fichiers ORDER BY id_fichier DESC');
                while($donnees = $reponse->fetch()){?>
                    <div>
                        <strong class="fileuser"><?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $donnees['dateT']; ?></strong><br>
                        <hr>
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

<?php
/*$bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
$reponse = $pdo->query('SELECT * FROM fichiers');
while($donnees = $reponse->fetch()){
    */?><!--
    <p>
        Fichier : <?php /*echo $donnees['nomfichier']; */?><br>
        Le fichier a une taile de <?php /*echo $donnees['taille']; */?> octets.<br>
        Il a été téléchargé le <?php /*echo $donnees['dateT']; */?>.<br>
        Il est présent ici : <?php /*echo $donnees['url']; */?>.<br>
        Il est dans la catégorie <?php /*echo $donnees['categorie']; */?>.<br>
        <em>Commentaire : <?php /*echo $donnees['commentaire']; */?></em><br>
    </p>
    --><?php
/*}
$reponse->closeCursor();//Termine le traitement de la requête
*/?>