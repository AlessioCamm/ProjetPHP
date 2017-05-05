<?php
    require_once 'Utile/db.php';
    require_once 'fonctions.php';
    logged_only();

    $url = $_SERVER['REQUEST_URI'];
    $parse = parse_url($url);
    if(!empty($parse['query'])){
        $pdo->exec('DELETE FROM utilisateurs WHERE id = "'.$parse['query'].'"');
        ?>
        <div class="uploadok">
            Utilisateur supprimé
        </div>
        <?php
    }

    if(!empty($_POST['message'])){

        $dateM = date('Y/m/d H:i:s');
        $message = $_POST['message'];

        if(!preg_match('/[#&§ç“{¶«¡Çø}_°|¨ô$*€ùÙ%£=+∞…÷≠±\•¿#‰¥ÔØÁÛ»”„Ÿ-]/', $_POST['message'])){
            $req = $pdo->prepare('INSERT INTO messenger SET id_user = ?, prenom_user = ?, nom_user = ?, photo_user = ?, dateMessage = ?, message = ?');
            $req->execute([$_SESSION['auth']->id, $_SESSION['auth']->prenom, $_SESSION['auth']->nom, $_SESSION['auth']->photoprofil, $dateM, $message]);

            ?>
            <div class="uploadok">
                Et voilà !<br>
                Votre message a bien été envoyé à l'administrateur.
            </div>
            <?php
        }
        else{
            ?>
            <div class="uploadnope">
                La zone de commentaire est vide ou<br>
                contient des caractères spéciaux non admis.
            </div>
            <?php
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nouvelles des utilisateurs</title>
        <link rel="stylesheet" href="style.css" />
        <style>.help{background-color: #17d779; border-radius: 15px;}</style>
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

    <!--Partie User-->
    <?php if($_SESSION['auth']->id != '19'){
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', 'root');
        $reponse = $bdd->query('SELECT * FROM utilisateurs');
    ?>
    <div id="divtitre" class="inscription">
        Quelque chose à signaler, <?= $_SESSION['auth']->prenom; ?> ?<br>
        Faites donc un petit message à l'administrateur !<br>
    </div>

    <div id="upload">
        <div id="titleupload">
            Un souci ? Pas de problème.
            <hr>
        </div>
        <div id="formulaireUpload">
            <strong>
                ATTENTION : veillez à écrire un message uniquement en cas de souci, de besoin, voir d'incompréhension. Il sera immédiatement envoyé à l'administrateur.<br>
                N'envoyez pas de message ridicule ou inutile, sous peine de sanction.<br>
                Votre message doit faire maximum 400 caractères, et ne pas contenir de caractères spéciaux<br>
                (sauf le point, la virgule, le point-virgule, le point d'interrogation ou d'exclamation).<br>
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
                while($donnees = $reponse->fetch()){?>
                    <div>
                        <img class="profilNDU" src="<?php echo $donnees['photo_user']; ?>" alt="Image profil">
                        <strong class="messuser"><?php echo $donnees['prenom_user']; ?> <?php echo $donnees['nom_user']; ?></strong>, le <strong class="filedate"><?php echo $donnees['dateMessage']; ?></strong><br>
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
                $reponse = $bdd->query('SELECT * FROM utilisateurs');
                while($donnees = $reponse->fetch()){?>
                    <p class="adminP">
                        <img class="profilicon" src="<?php echo $donnees['photoprofil']; ?>" alt="Image profil">
                        <strong class="nomprenomadmin"><?php echo $donnees['prenom']; ?> <?php echo $donnees['nom']; ?></strong>
                        -
                        <strong class="idadmin">ID n°<?php echo $donnees['id']; ?></strong>
                        -
                        <strong class="mailadmin"><?php echo $donnees['mail']; ?></strong>
                        <a href="ndu.php?<?=$donnees['id']?>"><img class="supprAd" src="Images/suppr.png" alt="Image suppression" title="Supprimer le fichier '<?php echo $donnees['nomfichier']; ?>'"></a>
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