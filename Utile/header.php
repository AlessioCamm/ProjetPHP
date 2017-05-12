<!--Quand la session est démarrée-->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>

<!--Barre placée au-dessus de tout, permettant la navigation de l'utilisateur-->
<div id="header">
    <?php if(isset($_SESSION['auth'])):?>
        <a href="account.php" class="nom" id="sess" title="Accueil"><img class="profilheader" src="<?php echo $_SESSION['auth']->photoprofil; ?>" alt="Image profil">
        <?= $_SESSION['auth']->prenom; ?></a>
        |
        <a href="pageupload.php" class="nom" id="fileup" title="Uploader, visionner, ou supprimer des fichiers">Gérer vos fichiers</a>
        |
        <a href="modif.php" class="nom" id="param" title="Paramètres">Paramètres</a>
        |
        <a href="ndu.php" class="nom" id="ndu" title="Un souci ?"><img class="help" src="Images/help.png" title="Un souci ?"></a>
        |
        <a href="logout.php" class="boutonDeco" title="Se déconnecter du site">Se déconnecter</a>

    <?php else: ?>
        <a href="register.php" class="boutonIns">S'inscrire</a> | <a href="index.php" class="boutonDeco">Se connecter</a>
    <?php endif; ?>
</div>

<!--Barre présente pour l'administrateur (pour notifier qu'il est bien en mode administrateur)-->
<?php if($_SESSION['auth']->id == '19'){
    ?>
    <div id="headeradmin" class="wow flipInX">
        Mode administrateur
    </div>
    <?php
    }
?>