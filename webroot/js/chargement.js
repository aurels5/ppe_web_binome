/* 
 * Script qui prévient l'utilisateur du chargement des pages
 */

document.write('Veuillez patienter durant le chargement de la page... Merci, test chargement js.');
console.log('test console log chargement js');

/*//quand le document est chargé on vide la div
$('document').on('unload', function() {
    document.write("Chargement en cours..."); //mettre ça dans la fonction au chargement
    $('html').css('cursor','Wait');
});
*/

if(typeof jQuery !== 'undefined') {
    //alert("jQuery est chargée !");//OK
} else {
    alert("jQuery est introuvable !");//OK
}


$(document).ready(function(){//début jquery
    
    $(document).load(function(){
        $("#chargement_page").html("la page est chargée?");
    });
    $("#chargement_page").html("Test jquery dans la div.");
    
    
    
});//fin jquery




            

