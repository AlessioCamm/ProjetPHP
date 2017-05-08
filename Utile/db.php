<!--Script de connexion à la base de données-->
<?php

    $pdo = new PDO('mysql:host=localhost;dbname=projetphp', 'root', 'root');//connexion à la BDD

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>