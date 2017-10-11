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
        <form method="post" action="ajouter_promo.php">

           <fieldset>
               <div class="form-group">
                    <legend>Ajouter une fiche contact</legend> <!-- Titre du fieldset --> 
                    <p>Vous pourrez modifier cette fiche contact ou en ajouter une nouvelle.</p>
                    
                    <label for="promo">Quelle promotion ?</label>
                    <select>
                        <?php foreach ($promotions as $pr): ?>
                        <?php
                        $selected ='';
                        
                        if ($promotions->pr_code === $pr->pr_code) {
                            $selected = 'selected';
                        }
                        ?>
             
                         
                        <option value="<?= $pr->pr_code ?>" <?= $selected ?> ><?= dateShowYear($pr->pr_date_debut)  .' / '. dateShowYear($pr->pr_date_fin) ?></option>
                    <?php endforeach; ?>
                    </select>
                    
                    <br>
                    
                    <label for="option">Quelle option ?</label>
                    <select>
                        <?php
                        /* //avec le tableau $option créé dans le for
                        foreach($options as $o){
                            echo '<option>';
                            echo $o;
                            echo '</option>';
                        }*/
                        foreach($fichier->option as $op){
                            echo '<option>',$op,'</option>';
                        }
                        ?>
                    </select>
                    
                    <?php
                    
                    if("SLAM"=="SLAM"){//faire "si on a sélectionné SLAM"
                        echo '<br>testslam';
                        echo '<label for="etu">Quel étudiant ?</label>';
                        echo '<select>';
                            foreach ($users as $u){

                                $selected ='';

                                if ($users->pr_code === $u->pr_code) {
                                    $selected = 'selected';
                                }
                            
                            
                            echo '<option value="'. $u->u_code .'"'. $selected .'>'. $u->u_nom .' '. $u->u_prenom .'</option>';
                            }
                        echo '</select>';
                        
                    }
                    elseif($op=="SISR"){
                        
                    }
                    else{
                        echo "Sélectionnez une option pour choisir l'étudiant...";
                    }
                    
                    /////////////////////////// test de where :
                    
                    
                    ?>
                    

               </div>
           </fieldset>

           <fieldset>
               <legend>Détails du contact</legend> <!-- Titre du fieldset -->
               
               <label for="date_contact">Date de la prise de contact</label>
               <input type="date" name="date_contact" value="" />
               
               <br>
               
               <label for="prenom">Informations Post-BTS SIO</label>
                <select>
                    <?php
                    /*
                    foreach($fichier->devenir as $d){ //utilise le XML
                        echo '<option>',$d,'</option>';
                    }
                     * 
                     */
                    
                     foreach ($devenirs as $de): ?>
                        <?php
                        $selected ='';
                        
                        if ($devenirs->d_code === $de->d_code) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="<?= $de->d_code ?>" <?= $selected ?> ><?= $de->d_devenir ?></option>
                    <?php endforeach; ?>
                    
                    
                </select> 
               
                <br>
               
                <input type="checkbox" class="form-check-input" name="international" id="international">
                <label class="form-check-label" for="international">
                    Poursuite à l'international
                </label>
                
              
               
               
                <br>
               <p>
                   <label for="precisions">Précisions :</label>
                   <textarea name="precisions" id="precisions" cols="40" rows="4" class="form-control"></textarea>
               </p>
           </fieldset>

            <button type="submit" class="btn btn-primary">Valider</button>

        </form>
    </div><!--fin col-->
</div><!--fin row-->