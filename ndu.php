<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();

    $url = $_SERVER['REQUEST_URI'];
    $parse = parse_url($url);
    if(!empty($parse['query'])){
        $suppfile = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
        $ok = $suppfile->query('SELECT nomfichier FROM fichiers WHERE id_user = "'.$parse['query'].'"');
        $suppfile->exec('DELETE FROM fichiers WHERE id_user = "'.$parse['query'].'"');
        while($okok = $ok->fetch()){
            unlink("Uploads/" . $okok['nomfichier']);
        }
        $pdo->exec('DELETE FROM utilisateurs WHERE id = "'.$parse['query'].'"');
        ?>
        <script type="text/javascript">
            function notif(){
                $(".notif").stop(true,true).fadeIn();
            }
            setTimeout(notif, 100);

            function notifGo(){
                $(".notif").stop(true,true).fadeOut();
            }
            setTimeout(notifGo, 3000);
        </script>
        <?php
    }

    if(!empty($_POST['message'])){

        $dateM = date('Y/m/d H:i:s');
        $message = $_POST['message'];

        if(preg_match('/[^a-zA-Z0-9\-\ç\é\è\à\?\,\!\.\;\@\(\)\"]/', $_POST['message']) && !preg_match('/<?php/', $_POST['message']) && !preg_match('/<?=/', $_POST['message'])){
            $req = $pdo->prepare('INSERT INTO messenger SET id_user = ?, prenom_user = ?, nom_user = ?, photo_user = ?, dateMessage = ?, message = ?');
            $req->execute([$_SESSION['auth']->id, $_SESSION['auth']->prenom, $_SESSION['auth']->nom, $_SESSION['auth']->photoprofil, $dateM, $message]);

            ?>
            <script type="text/javascript">
                function notifmdp(){
                    $(".notifmdp").stop(true,true).fadeIn();
                }
                setTimeout(notifmdp, 100);

                function notifmdpGo(){
                    $(".notifmdp").stop(true,true).fadeOut();
                }
                setTimeout(notifmdpGo, 3000);
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                function notifRed(){
                    $(".notifRed").stop(true,true).fadeIn();
                }
                setTimeout(notifRed, 100);

                function notifRedGo(){
                    $(".notifRed").stop(true,true).fadeOut();
                }
                setTimeout(notifRedGo, 4000);
            </script>
            <?php
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Alessio Cammarata" />
        <title>Messages</title>
        <link rel="stylesheet" href="style.css" />
        <style>.help{background-color: #17d779; border-radius: 15px;}</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <!-- Ici c'est le script JS-->
        <script src="js/script.js" type="text/javascript"></script>
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

    <div class="notif">
        Utilisateur supprimé
    </div>

    <!--Partie User-->
    <?php if($_SESSION['auth']->id != '19'){
    ?>

        <div class="notifRed">
            La zone de commentaire est vide ou<br>
            contient des caractères spéciaux non admis.
        </div>

        <div class="notifmdp">
            Votre message a été envoyé à l'administrateur.
        </div>

    <div id="divtitre" class="inscription">
        Un souci ? Pas de problème.
    </div>

    <div id="upload">
        <div id="titleupload">
            <?= $_SESSION['auth']->prenom; ?>,
            faites donc un petit message à l'administrateur.
            <hr>
        </div>
        <div id="formulaireUpload">
            <strong>
                ATTENTION : veillez à écrire un message uniquement en cas de souci, de besoin, voir d'incompréhension. Il sera immédiatement envoyé à l'administrateur.<br>
                N'envoyez pas de message ridicule ou inutile, sous peine de sanction.<br>
                Votre message doit faire maximum 400 caractères, et ne pas contenir de caractères spéciaux.<br>
            </strong>
            <hr>

            <form method="post" class="formUpload">
                Laissez un message (400 caractères max) :<br>
                <textarea name="message" rows="5" cols="31" maxlength="400"></textarea><br>
                <br>
                <input type="submit" value="Envoyez votre message" name="submit">
            </form>

        </div>
    </div>
        <?php
    }
    ?>
    <!--Fin partie Admin-->

    <!--Partie Admin-->
    <?php if($_SESSION['auth']->id == '19'){
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
        $reponse = $bdd->query('SELECT * FROM utilisateurs');
        ?>
        <div id="messFond">
            <div id="messTitre">
                Messages des utilisateurs
                <hr>
            </div>
            <div id="mess">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM messenger ORDER BY id_message DESC');
                while($donnees = $reponse->fetch()){
                    $datetime = date_create($donnees['dateMessage']);
                    $date = date_format($datetime,"d/m/Y");
                    $time = date_format($datetime,"H:i");
                    ?>
                    <div>
                        <img class="profilNDU" src="<?php echo $donnees['photo_user']; ?>" alt="Image profil">
                        <strong class="messuser"><?php echo $donnees['prenom_user']; ?> <?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $date; ?> à <?php echo $time; ?></strong><br>
                        <hr>
                        <em class="messcom"><strong><?php echo $donnees['message']; ?></strong></em><br>
                    </div>
                <?php  }
                $reponse->closeCursor();
                ?>
            </div>
            <br>
        </div>

        <div id="admin">
            <div id="title">
                Infos des utilisateurs
                <hr>
            </div>
            <div id="adminIn">
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
                $reponse = $bdd->query('SELECT * FROM utilisateurs WHERE id != 19');
                while($donnees = $reponse->fetch()){?>
                    <p class="adminP">
                        <img class="profilicon" src="<?php echo $donnees['photoprofil']; ?>" alt="Image profil">
                        <strong class="nomprenomadmin"><?php echo $donnees['prenom']; ?> <?php echo $donnees['nom']; ?></strong>
                        -
                        <strong class="idadmin">ID n°<?php echo $donnees['id']; ?></strong>
                        -
                        <strong class="mailadmin"><?php echo $donnees['mail']; ?></strong>
                        <a href="ndu.php?<?=$donnees['id']?>"><img class="supprAd" src="Images/suppr.png" alt="Image suppression" title="Supprimer <?php echo $donnees['prenom']; ?>"></a>
                    </p>
                <?php  }
                $reponse->closeCursor();
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <!--Fin partie Admin-->

    </body>
</html>