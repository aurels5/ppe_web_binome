<h3>Consulter les statistiques</h3>
<small>Ces statistiques concernent le Lycée Merleau-Ponty exclusivement.</small>

<br>


<!-- Choix de la promotion pour afficher les stat -->


<!-- affichage stat sur les infos pour * les élèves --> 
<!--Pour toutes les promotions de BTS SIO -->
<!-- aff %tage d'élèves en CDD ou CDI après BTS-->

<!-- formulaire de choix d'affichage des statistiques -->
<form method="POST" action="<?= BASE_URL ?>/devenir/consulter_stat">
    <select name="stat_choisie">
        <option value="s1" <?php if($value_stat_choisie=='s1'){ echo 'selected'; }?>>Provenance des étudiants</option> <!-- el_diplome_prec -->
        <option value="s2" <?php if($value_stat_choisie=='s2'){ echo 'selected'; }?>>Poursuite à l'étranger</option> <!-- sur la totalité des étudiants-->
        <option value="s3" <?php if($value_stat_choisie=='s3'){ echo 'selected'; }?>>Taux de redoublement</option> <!-- redoublement par année -->
        <option value="s4" <?php if($value_stat_choisie=='s4'){ echo 'selected'; }?>>Devenir après le BTS</option> <!-- d_devenir + innerjoin avec contact.u_code en devenir.d_code=contact.d_code--> 
    </select>

    <input type="submit" value="Afficher statistiques" name="submit_choix_stat">
</form>

<!-- récupérer les données uniquement en PHP puis on verra plus tard pour le JS -->

<h3><?=$titre_stat?></h3>


<?php
    switch($value_stat_choisie){ //vient du $d['value_stat_choisie']
        case "s1" :
            
            //print_r($total_eleves->[count(*)] );//ne fonctionne pas
            //print_r($total_eleves); //affiche tout...
            
            
           foreach($total_eleves as $te){
                echo $te['count(*)'];
           }
            /*
            foreach($total_eleves as $te){
                //echo $te['count(*)'];
                echo $te[0];
            }
             * 
             */
            
            break;
        case "s2"://Poursuite à l'étranger, sur la totalité des étudiants
            
            break;
        case "s3";//Taux de redoublement par année (diag en bâtons)
            
            break;
        case "s4";//Devenir après le BTS, d_devenir + innerjoin avec contact.u_code --> modèle ContactDevenir
            
            break;
        default:
            
    }                
?>