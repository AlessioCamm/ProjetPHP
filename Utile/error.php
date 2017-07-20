<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_SESSION['auth'])){
        header('Location: ../account.php');
        exit();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Alessio Cammarata" />
        <title>Erreur</title>
        <link rel="stylesheet" href="../style.css" />
    </head>

    <body>

        <div id="divtitre">
            Erreur de connexion à la base de données<br>
            <br>
            <img class="imageAccueil" src="../Images/Error.png" alt="Image d'accueil">
        </div>

        <div id="divtitre">
            La connexion à la base de données ne s'est pas effectuée comme convenu,<br>
            il est donc impossible d'accéder au site Web.<br>
            Essayez de résoudre le problème, puis <a href="../index.php">réessayez</a> de vous connecter.<br>
            <br>
        </div>



    </body>
</html>