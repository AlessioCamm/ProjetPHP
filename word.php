<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();

    include_once "Utile/uploadscript.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fichiers Word | <?= $_SESSION['auth']->prenom; ?></title>
        <link rel="stylesheet" href="style.css" />
        <style>.barrenom .BarreMenuWord{color:#00aaff} .barrenom2 .BarreMenuWord{color:#00aaff}</style>
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
                    <option value="Informatique" selected="selected">Informatique</option>
                    <option value="Développement">Développement</option>
                    <option value="Electronique">Electronique</option>
                    <option value="Graphisme">Graphisme</option>s
                </select><br>
                <textarea name="commentaire" rows="8" cols="20" maxlength="200" placeholder="Fichier de max 20 Mo, catégorie 'Informatique' par défaut, commentaire optionnel de 200 caractères. Plus d'infos dans l'onglet 'Gérer vos fichiers'."></textarea><br>
                <input type="submit" value="Télécharger le fichier" name="submit">
            </form>
        </div>

        <div id="listeFond">
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
                        <?php if($_SESSION['auth']->id == '19'){
                            ?>
                            <a href="word.php"><img class="suppr" src="Images/suppr.png" alt="Image suppression" title="Supprimer le fichier '<?php echo $donnees['nomfichier']; ?>'"></a>
                            <?php
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