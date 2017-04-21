function scrollMove(){	/* Animations des barres diverses */
	/*if(window.pageYOffset>670){
		$("#hr").animate({width:750},{duration:800});
	}*/
	/*if(window.pageYOffset>1070){
		$("#hr2").animate({width:800},{duration:500});
	}*/
	/*if(window.pageYOffset>1580){ //Barres
        $("#barre5").animate({width:"90%"},{duration:850});
        $("#barre6").animate({width:"90%"},{duration:850});
        $("#barre7").animate({width:"85%"},{duration:850});
		$("#barre").animate({width:"80%"},{duration:850});
        $("#barreCSS").animate({width:"75%"},{duration:850});
        $("#barreJS").animate({width:"70%"},{duration:850});
        $("#barreAndro").animate({width:"70%"},{duration:850});
        $("#barre2").animate({width:"70%"},{duration:850});
        $("#barre4").animate({width:"70%"},{duration:850});
	}*/
}
window.onscroll=scrollMove

/*-------------------------------------------*/
function ouverture(){	/* Ouverture et fermeture par clic */
    if($("#zone").width() == 15){
        $("#zone").animate({width:296},{duration:600});
        $(".Dedans").stop(true,true).fadeIn();
    }
    if($("#zone").width() == 296){
        $("#zone").animate({width:15},{duration:600});
        $(".Dedans").stop(true,true).fadeOut();
    }
}

function ouvertureAuto(){/* Ouverture auto #zone et photo de profil */
	$("#zone").animate({width:296},{duration:600});
	$(".Dedans").stop(true,true).fadeIn();
}
setTimeout(ouvertureAuto, 4000);

/*-------------------------------------------*/

function bienvenue(){	/* Message BIENVENUE */
    $("#hello").stop(true,true).fadeIn();
}
setTimeout(bienvenue, 1000);

function clear1(){ /* EFFACER MESSAGES */
    $("#hello").stop(true,true).fadeOut();
}
setTimeout(clear1, 3000);

/*-------------------------------------------*/
function Banniere(){
    if(outerWidth < 1235) {
        $("#Banniere").stop(true, true).fadeIn();
    }
}
setTimeout(Banniere, 2000);

function zoneImage(){
    if(outerWidth > 1235) {
        $("#zone").stop(true, true).fadeIn();
    }
}
setTimeout(zoneImage, 2300);

function zone2(){
	$("#zone2").stop(true,true).fadeIn();
}
setTimeout(zone2, 2500);

function label1(){
    $("#label1").stop(true,true).fadeIn();
    $("#label1").typed({
        strings:["Alessio<br>Cammarata"], typeSpeed:50
    });
}
setTimeout(label1, 2500);

function label3(){
    $("#label3").stop(true,true).fadeIn();
}
setTimeout(label3, 3500);

function zone3(){	
	$("#zone3").stop(true,true).fadeIn();
}
setTimeout(zone3, 4000);

function zone4(){	
	$("#zone4").stop(true,true).fadeIn();
}
setTimeout(zone4, 4000);

function Citation(){	
	$("#Citation").stop(true,true).fadeIn();
}
setTimeout(Citation, 4000);

function Ecole(){	
	$("#Ecole").stop(true,true).fadeIn();
}
setTimeout(Ecole, 5000);

function Perso(){	
	$("#Perso").stop(true,true).fadeIn();
}
setTimeout(Perso, 6000);

function footer(){	
	$("#footer").stop(true,true).fadeIn();
}
setTimeout(footer, 7000);