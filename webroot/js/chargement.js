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
    alert("jQuery est chargée !");
} else {
    alert("jQuery est introuvable !");
}


$(document).ready(function(){//début jquery
    
    $(document).write("test");
    $("#chargement_page").html("encore un test, dans la div");
    
});//fin jquery




            

