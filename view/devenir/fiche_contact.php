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
                        foreach($fichier->option as $op): ?>
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
            <fieldset>
               
                <label for="etu">Quel étudiant ?</label>
                
                <select name="code_etudiant">
                    <?php if(isset($_POST['submit1'])){
                    foreach ($usereleve as $ue):?>

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
                    echo '<input type="submit" name="aff_fiche" value="Afficher fiche(s)" >';
                }
                ?>
            </fieldset>   
           

            <?php if( ($var_script=='fiche_contact') || ( $var_script=='modifier_contact' &&  isset($_POST['aff_fiche'])   ) ){ ?>
            <fieldset>
               
               <legend>Détails du contact</legend> <!-- Titre du fieldset -->
               
               <label for="date_contact">Date de la prise de contact</label>
               <input type="date" name="date_contact" value="<?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
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
                                endforeach ;//ferme foreach
                        } //ferme if
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
                    <textarea name="precisions" id="precisions" cols="40" rows="4" class="form-control"><?php if( ($var_script=='modifier_contact') && isset($_POST['aff_fiche']))
{ foreach ($contactseleve as $ce) { echo $ce->co_precisions;}}?></textarea>
                </p>
           </fieldset>

            <input type="submit" name="submit2" class="btn btn-primary" value="Valider la fiche contact">
            <?php } //fin du isset aff_fiche ?>
        </form><!--fin form 2-->
        
        <?php } //fin du isset pour afficher le formulaire 2 ?>
    </div><!--fin col-->
</div><!--fin row-->