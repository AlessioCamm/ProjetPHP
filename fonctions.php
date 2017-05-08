<!--Script composé de certaines fonctions-->
<?php

function debug($variable){//Fonction de debug utilisée pour un test

    echo '<pre>' . print_r($variable, true) . '</pre>';

}

function str_random($length){ //Fonction de random utilisée pour un test
    $alpha = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
    return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
}

function logged_only(){ //Fonction utilisée uniquement pour vérifier si l'utilisateur est connecté
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){//S'il ne l'est pas, il est redirigé vers 'index.php'

        header('Location: index.php');
        exit();
    }
}
