<?php
//on prend le contenu du fichier XML
$fichier = simplexml_load_file('../etudiant_devenir.xml');

//test pour prélever 1 champ
//$devenir1 = $fichier->parametre[0];
//echo $devenir1 ,' <br>';

//TABLEAU DEVENIR
/*
for($i=0; $i<5 ; $i++){
    //le tableau prend les valeurs du devenir du fichier XML
    $tab_devenirs[$i] = $fichier->devenir[$i];
    
    //echo $tab_devenirs[$i] , '<br>'; 
//vérif contenu tableau -> on l'affichera dans un foreach
}
 * 
 */


/*//si besoin de mettre les données dans un tableau :
for($k=0;$k<2;$k++){
    $options[$k] = $fichier->option[$k];
}
 * */

?>




<div class="row">
    <div class="col-lg-6">
        <form method="post" action="<?= BASE_URL ?>/devenir/<?=$var_script?>">

           <fieldset>
               <div class="form-group">
                    <legend>Fiche contact</legend> <!-- Titre du fieldset --> 
                    <p>Vous pourrez modifier une fiche contact ou en ajouter une nouvelle.</p>
                    
                    <label for="promo">Quelle promotion ?</label>
                    
                    <select name="promo">
                        <?php
                        foreach ($promotions as $pr): ?>
                            <option value="<?= $pr->pr_code ?>" <?php if($pr->pr_code==$lecodepromo){ echo 'selected';} ?> >
                                    <?= dateShowYear($pr->pr_date_debut)  .' / '. dateShowYear($pr->pr_date_fin) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php //echo $lecodepromo , ' : le code sélectionné.' ?>
                    
                    <br>
                    
                    <label for="option">Quelle option ?</label>
                    <select name="option">
                        <?php 
                        foreach($fichier->option as $op): ?> <!-- utilisation du xml -->
                            <option value="<?= $op ?>" <?php if($op==$loption){ echo 'selected';} ?> >
                                <?= $op ?>
                            </option>
                        <?php endforeach; ?>
                    </select>  
                </div>
            </fieldset>
            <input type="submit" name="submit1" value="Choisir l'élève">
        </form>
          
        
        
        <?php if( isset($_POST['submit1']) || isset($_POST['aff_fiche']) ){ 
            //DEBUT DU DEUXIEME FORMULAIRE : choix d'un étudiant
        ?>

        
        <form method="post" action="<?= BASE_URL ?>/devenir/<?=$var_script?>/">
            <fieldset id="form_eleves_sans_fiche">
               
                <label for="etu">Quel étudiant ?</label><span id="reponse_eleves_sans_fiche"></span>
                
                <select name="code_etudiant" id="eleves_sans_fiche">
                    <?php if(isset($_POST['submit1'])){
                    foreach ($eleves_promo_selected as $ue):?>

                        <option value="<?= $ue->u_code ?>" <?php if($ue->u_code==$lusereleve){ echo 'selected'; }?>>
                            <?= $ue->u_nom .' '. $ue->u_prenom ?>
                        </option>
                    
                    <?php endforeach; ?>
                    <?php } 
                    elseif(isset($_POST['aff_fiche']) && $var_script=='modifier_contact'){ 
                    foreach ($elevefiche as $ef):?>

                        <option value="<?= $ef->u_code ?>">
                            <?= $ef->u_nom .' '. $ef->u_prenom ?>
                        </option>
                    
                    <?php endforeach; ?>    
                        
                    <?php } ?>
                        
                    
                </select>
                
                <?php
                if($var_script=='modifier_contact'){
                    echo '<input type="submit" name="aff_fiche" value="Afficher fiche(s)" id="aff_fiche">';
                }
                ?>
            </fieldset>   
           

            <?php if( ($var_script=='fiche_contact') || ( $var_script=='modifier_contact' &&  isset($_POST['aff_fiche'])   ) ){ ?>
            <fieldset id="details_contact">
               
               <legend>Détails du contact</legend> <!-- Titre du fieldset -->
               <input type="hidden" name="cocode" value="<?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
                   { foreach ($contactseleve as $cc) {
                       echo $cc->co_code;}
                   }?>">
               <label for="date_contact">Date de la prise de contact</label>
               <input type="date" id="dateEntree" name="date_contact" onblur="verifDate();" value="<?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
                   { foreach ($contactseleve as $ce) {
                       echo $ce->co_date;}
                   }elseif($var_script=='modifier_contact'){ echo $contactdevenir->co_date; } else{ echo date("Y-m-d"); }?>" />
               
               <br> 
               
               <label for="info_devenir">Informations Post-BTS SIO</label>
                <select name="info_devenir">
                    <?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche'])){ 
                                foreach ($contactseleve as $ce): ?> 
                                    <?= $ce->d_code ; ?>
                                    <?php foreach ($devenirs as $de): ?>
                                    <option value="<?= $de->d_code ?>" <?php if($de->d_code==$ce->d_code){ echo 'selected';} ?> >
                                        <?= $de->d_devenir ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php 
                                endforeach ;//fin foreach
                        } //fin if
                        else{
                            foreach ($devenirs as $de): ?>

                            <option value="<?= $de->d_code ?>" <?php if($de->d_code==$ledevenir){ echo 'selected';} ?> >
                                <?= $de->d_devenir ?>
                            </option>
                        <?php endforeach; 
                        
                      }//fin else ?>
                    
                </select> 
               
                <br>
               
                <input type="checkbox" class="form-check-input" name="international" id="international" <?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
{ foreach ($contactseleve as $ce) {if($ce->co_international==1){ echo 'checked';}}} ?>>
                <label class="form-check-label" for="international">
                    Poursuite à l'international
                </label>

                <br>
                <p>
                    <label for="precisions">Précisions :</label>
                    <textarea name="precisions" onblur="verifPrecisions();" onkeypress="affTaille();" id="precisions" cols="40" rows="4" class="form-control"><?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
{ foreach ($contactseleve as $ce) { echo $ce->co_precisions;}}?></textarea>   
                </p>
                
                <div id="taillePrecisions"></div>
           </fieldset>
            
            <script type="text/javascript">
                
            </script>
            
            <input type="submit" name="submit2" onclick="verifForm();" class="btn btn-primary" value="Valider la fiche contact" id="valider_fiche">
            <?php } //fin du isset aff_fiche ?>
        </form><!--fin form 2-->
        
        <?php } //fin du isset pour afficher le formulaire 2 ?>
    </div><!--fin col-->
</div><!--fin row-->




<script type="text/javascript">
    // variable globale
     var_script_j = '<?= json_encode($var_script); ?>'; //alert(var_script);//OK
    
     //si on est dans la fonction fiche_contact et non dans modifier_contact
     //En jQuery, on vérifie si le <select> est vide. Si oui, message pour informer l'utilisateur.
     function cacheListeVide(){ 

        var_script_j = '<?= $var_script ?>'; //attention, pas de json encode ici ! 
        //alert(typeof var_script_j + " " + var_script_j);//OK //var_script_j = String(var_script_j);
        
        if(var_script_j==="fiche_contact"){
            //on est dans le traitement fiche_contact
            $(document).ready(function(){
                var contenuListe = $("#eleves_sans_fiche").val(); //alert(contenuListe);//OK

                $("#form_eleves_sans_fiche").mouseover(function(){
                    if(contenuListe===null){
                        alert("Les élèves correspondant à cette promotion et cette option ont tous une fiche contact. \n\Vous pouvez modifier la fiche souhaitée dans Menu > Modifier, ou sélectionner une autre promotion/option."); //on l'informe avec un alert

                        $("#valider_fiche").hide();//on le cache sans délai.
                        $("#eleves_sans_fiche").hide(1000);
                        $("#details_contact").hide(1000);
                        $("#reponse_eleves_sans_fiche").html(" Les étudiants sélectionnés ont tous une fiche contact. Veuillez cliquer dans le Menu > Modifier contact."); //on répète l'information si l'utilisateur réactualise
                    }
                });
            });//fin jQ
        }
        
        
        
        else if(var_script_j==="modifier_contact"){
            //on est dans le traitement modifier_contact
            $(document).ready(function(){
                var contenuListe = $("#eleves_sans_fiche").val(); //alert(contenuListe);//OK

                $("#form_eleves_sans_fiche").mouseover(function(){
                    if(contenuListe===null){
                        alert("Pas de fiche modifiable pour cette promotion et cette option. Vous pouvez créer la fiche souhaitée dans Menu > Ajouter contact étudiant, ou sélectionner une autre promotion/option."); //on l'informe avec un alert
                        
                        $("#aff_fiche").hide();//on cache le bouton sans délai.
                        $("#eleves_sans_fiche").hide();
                        $("#details_contact").hide();
                        $("#reponse_eleves_sans_fiche").html(" Les étudiants sélectionnés n'ont pas encore de fiche contact. Veuillez cliquer dans le Menu > Ajouter contact."); //on répète l'information si l'utilisateur réactualise
                        
                    }
                });
            });//fin jQ
        }
        
    }//fin fonction cacheListeVide()
    
    
    cacheListeVide(); //on lance la fonction
</script>
<script type="text/javascript" src="<?= BASE_SITE . DS . '/js/verifications.js' ?>"></script>



<!-- Informations supplémentaires pour l'utilisateur -->
<button class="transparent" type="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-cog"></span> Informations</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fiche contact : création et modification</h4>
        </div>
        <div class="modal-body">
          <p>Un étudiant possède une fiche contact unique qui peut être modifiée. Si vous ne pouvez pas en créer une, 
              cela signifie que la fiche contact a déjà été créée et est modifiable, ou bien que l'étudiant n'est pas 
              encore dans la base de données, auquel cas, nous vous conseillons de vous adresser à un administrateur du site qui tâchera de 
              répondre au mieux à votre demande.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
      </div>
      
    </div>
  </div>
