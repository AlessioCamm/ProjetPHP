<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

?>

<div id="header">
    <?php if(isset($_SESSION['auth'])):?>
        <a href="account.php" class="nom" id="sess"><?= $_SESSION['auth']->prenom; ?></a>
        |
        <a href="pageupload.php" class="nom" id="fileup">Télécharger un fichier</a>
        |
        <a href="modif.php" class="nom" id="param">Paramètres</a>
        |
        <a href="ndu.php" class="nom" id="ndu">NDU</a>
        |
        <a href="logout.php" class="boutonDeco">Se déconnecter</a>

    <?php else: ?>
        <a href="register.php" class="boutonIns">S'inscrire</a> | <a href="index.php" class="boutonDeco">Se connecter</a>
    <?php endif; ?>
</div>

<?php if($_SESSION['auth']->id == '19'){
    ?>
    <div id="headeradmin">
        Vous êtes en mode administrateur
    </div>
    <?php
    }
?>