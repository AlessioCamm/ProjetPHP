<?php

    $pdo = new PDO('mysql:host=localhost;dbname=projetphp', 'root', 'root');//connexion à la BDD

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Rapport d'erreurs

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>