function surligne(champ, erreur) {
    if (erreur) {
        champ.style.backgroundColor = "#FFA19E";
    } else {
        champ.style.backgroundColor = "#7B9";
    }
}

function verifPrecisions(champ) {
    var prec = document.getElementById("precisions").value.length; //on récupère la longueur du champs precisions
    var valid=true;
    
    if (prec > 254) {
        surligne(champ, true);
        valid=false;
    } else {
        surligne(champ, false);
        //valid reste true
    }
    console.log("Longueur de précisions : ", prec);
    return valid;
}


function verifForm() { //On vérifie tous les champs
    //alert("est-ce qu'on passe ici? vérif form");
    console.log("est-ce qu'on passe dans le vérif form? Pourquoi ça n'affiche pas ce console.log alors que ça affiche l'alert??");
    var validPrecisions = verifPrecisions();//soit true soit false

    if (validPrecisions) {//si les précisions sont true
        alert("C'est bon.");
        return true; //le formulaire est envoyé
    } else {
        alert("Veuillez remplir correctement tous les champs");
        return false; //le formulaire n'est pas envoyé
    }
}

function cacheListeVide(){
    alert("c'est vide");
    $(document).ready(function(){
        var contenuListe = $("#eleves_sans_fiche").text();
        if(contenuListe==''){
            alert("c'est vide"); 
        }
    });
}

cacheListeVide();