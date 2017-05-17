<?php

function debug($variable){

    echo '<pre>' . print_r($variable, true) . '</pre>';

}
/*Création de clé utilisée pour un test*/
function str_random($length){
    $alpha = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
    return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
}
/*Fonction utilisée afin de vérifier si un utilisateur est connecté*/
function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){

        header('Location: index.php');
        exit();
    }
}
