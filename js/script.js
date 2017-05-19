function ouverture(){	/* Ouverture et fermeture par clic */
    if($(".fenetrePerso").height() == 68){
        $(".fenetrePerso").animate({height:260},{duration:500});
        $(".fenetrePersoUpload").stop(true,true).fadeIn();
    }
    if($(".fenetrePerso").height() == 260){
        $(".fenetrePerso").animate({height:68},{duration:500});
        $(".fenetrePersoUpload").stop(true,true).fadeOut();
    }
}

function barre(){
    $(".hrPerso").animate({width:140},{duration:300});
}
function barreOut(){
    $(".hrPerso").animate({width:110},{duration:300});
}

/*var filedate = setInterval(
 function () {
 $(".filedate").load('account.php .filedate');
 }, 1000
 );*/
