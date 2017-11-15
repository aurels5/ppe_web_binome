/* 
 * Script qui prévient l'utilisateur du chargement des pages
 */

// document.write('Veuillez patienter durant le chargement de la page... Merci, test chargement js.');
console.log('test console log chargement js');

/*//quand le document est chargé on vide la div
$('document').on('unload', function() {
    document.write("Chargement en cours..."); //mettre ça dans la fonction au chargement
    $('html').css('cursor','Wait');
});
*/

/*if(typeof jQuery !== 'undefined') {
    alert("jQuery est chargée !");//OK
} else {
    alert("jQuery est introuvable !");//OK
}*/

$(document).ready(function() {
    $("#centre_contenu").hide(); //on le cache au cas où
    $("#loader").show(); //on affiche le gif
    $("#centre_contenu").load("consulter_stat.php #container", function() { //au chargement du container (on met tout dans #centre_contenu)...
        $("#loader").fadeOut('fast', function() {   //comme la page est chargée on fadeOut l'image de chargement
            $("#centre_contenu").fadeIn(1000);      //on affiche tout le container qui s'est mis dans #centre_contenu
        });
    });
});


/*
$(document).ready(function(){//début jquery
    
    
    $(document).load(function(){
        $("#chargement_page").html("la page est chargée?");
    });
    $("#chargement_page").html("Test jquery dans la div.");
    
    
    
});//fin jquery
*/




            

