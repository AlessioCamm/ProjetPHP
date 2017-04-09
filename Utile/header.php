<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

?>

<div id="header">
    <?php if(isset($_SESSION['auth'])): ?>
        Bonjour, <a href="modif.php" class="nom"><?= $_SESSION['auth']->prenom; ?></a>
        --
        <a href="logout.php" class="boutonDeco">Se déconnecter</a>

    <?php else: ?>
        <a href="register.php" class="boutonDeco">S'inscrire</a>
        <a href="index.php" class="boutonDeco">Se connecter</a>
    <?php endif; ?>
</div>