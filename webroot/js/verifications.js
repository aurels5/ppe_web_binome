//fonction qui surligne en vert si vrai en rouge si faux
function surligne(champ, erreur) { //mettre erreur à true s'il y a une erreur
    if (erreur) {
        $(document).ready(function(){
            $(champ).css("background-color","#FFA19E"); //faux : rouge
        });
    } else {
        $(document).ready(function(){
            $(champ).css("background-color","#7B9"); //vrai : vert
        });
    }
}

//on vérifie les précisions
function verifPrecisions() {
    var prec = document.getElementById("precisions").value.length; //on récupère la longueur du champ precisions
    var valid=true;
    
    if (prec > 254) {
        surligne("#precisions", true);
        valid=false;
    } else {
        surligne("#precisions", false);
        //valid reste true
    }
    console.log("Longueur de précisions : ", prec);

    return valid;
}

function affTaille(){
    $(document).ready(function(){
        var t=0;
        var max=254;//le maximum
        t += $("textarea").val().length ;
        //console.log("t="+t);
        max-=t; //nb de caractères qui restent à l'utilisateur
        
        //var par = $("<div></div>").text("Coucou");
        //$("#precisions").after(par);
        
        if ( max>1 ){
            $("#taillePrecisions").text("Il vous reste : "+max+" caractères disponibles.");
        }
        else if ( max===1 ){
            $("#taillePrecisions").text("Il vous reste : "+max+" caractère disponible.");
        }
        else if ( max<0 ) {
            oppMax = -max;
            $("#taillePrecisions").text("Vous devez retirer "+ oppMax +" caractères.");
        }
        
        
    });
    
}


function verifDate(){
    var ok=true;
    var now = new Date(); //ex : Mon Nov 20 2017 12:55:06 GMT+0100 (Paris, Madrid)
    
    var anneeCourante= parseInt(now.getFullYear()); //YYY
    var moisCourant= parseInt(now.getMonth() + 1); //MM
    var jourCourant= parseInt(now.getDate()); //DD

    var dateEntree = document.getElementById("dateEntree").value ; //OK, type : YYYY-MM-DD
    var tabDate = dateEntree.split("-");
    //console.log(tabDate); //console.log(tabDate[0]); //ok
    //conversion en chaîne
    var anneeEntree=parseInt(tabDate[0]);
    var moisEntre=parseInt(tabDate[1]);
    var jourEntre=parseInt(tabDate[2]); //alert(jourCourant); alert(jourEntre);
    
    //date entrée supérieure à date courante => false
    if( anneeEntree>anneeCourante ){
        ok=false; //OK //alert("année trop grande");
    }
    else if(anneeEntree===anneeCourante && moisEntre>moisCourant){
        ok=false;//alert("bonne année et mois trop grand");
    }
    else if(anneeEntree===anneeCourante && moisEntre===moisCourant && jourEntre>jourCourant){
        ok=false;//alert("bonne année bon mois mais jour trop grand");
    }
    
    if(ok){
        surligne("#dateEntree", false);
    } else{
        surligne("#dateEntree", true);
    }

    return ok; //bool
}


function verifForm() { //On vérifie tous les champs
    //alert("Vérification du formulaire...");
    console.log("Vérification du formulaire...");
    
    $('#valider_fiche').click(function(){
        var validPrecisions = verifPrecisions();//bool
        var validDate = verifDate(); // bool

        if (validPrecisions && validDate) {//si les précisions sont true
            alert("Le formulaire est valide.");
            return true; //le formulaire est envoyé
        } else {
            alert("Veuillez remplir correctement tous les champs");
            return false; //Empêche le formulaire d'être soumis
        }   
    });
    
}


