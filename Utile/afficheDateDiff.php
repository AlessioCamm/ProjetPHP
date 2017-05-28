<?php
    if($interval->format('%i') < 1 && $interval->format('%h') == 0 && $interval->format('%a') == 0){
        echo "moins d'une minute";
    }
    if($interval->format('%i') == 1 &&  $interval->format('%h') == 0 && $interval->format('%a') == 0){
        echo $interval->format('%i') . " minute";
    }
    if($interval->format('%i') <= 59 && $interval->format('%i') >= 2 &&  $interval->format('%h') == 0 && $interval->format('%a') == 0){
        echo $interval->format('%i') . " minutes";
    }
    if($interval->format('%h') == 1 && $interval->format('%a') == 0){
        echo $interval->format('%h') . " heure";
    }
    if($interval->format('%h') >= 2 && $interval->format('%a') == 0){
        echo $interval->format('%h') . " heures";
    }
    if($interval->format('%a') >= 1 && $interval->format('%a') <= 30){
        echo $interval->format('%a') . " jours";
    }
    if($interval->format('%m') >= 1 && $interval->format('%m') < 12){
        echo $interval->format('%m') . " mois";
    }
    if($interval->format('%y') == 1){
        echo $interval->format('%y') . " an";
    }
    if($interval->format('%y') >= 2){
        echo $interval->format('%y') . " ans";
    }
?>