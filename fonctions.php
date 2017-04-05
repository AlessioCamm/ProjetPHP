<?php

function debug($variable){

    echo '<pre>' . print_r($variable, true) . '</pre>';

}

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){

        header('Location: index.php');
        exit();
    }
}
