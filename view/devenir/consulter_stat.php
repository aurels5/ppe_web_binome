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
                $v_tot_el=$te['count(*)'];
                $v_tot_el=intval($v_tot_el);
           }      
           foreach($nb_bac_s as $bs){
               $v_bac_s=$bs['count(*)'];
               $v_bac_s=intval($v_bac_s);
           }  
           foreach($nb_bac_es as $bes){
               $v_bac_es=$bes['count(*)'];
               $v_bac_es=intval($v_bac_es);
           }
           foreach($nb_bac_sti2d as $bsti2d){
               $v_bac_sti2d=$bsti2d['count(*)'];
               $v_bac_sti2d=intval($v_bac_sti2d);
           }
           foreach($nb_bac_pro_sen as $bsen){
               $v_bac_sen=$bsen['count(*)'];
               $v_bac_sen=intval($v_bac_sen);
           }
           foreach($nb_bac_stmg as $bstmg){
               $v_bac_stmg=$bstmg['count(*)'];
               $v_bac_stmg=intval($v_bac_stmg);
           }
           foreach($nb_bac_autre as $ba){
               $v_ba=$ba['count(*)'];
               $v_ba=intval($v_ba);
           }
           
           //echo $v_tot_el , ' ';
           //echo $v_bac_s , ' ';
           //echo $v_bac_es, ' ';
           //echo $v_bac_sen, ' ';
           //echo $v_bac_sti2d+2, ' ';//test intval
           //echo $v_bac_stmg, ' ';
           //echo $v_ba, ' ';
           
           $pct_bac_s=$v_bac_s*100/$v_tot_el;
           echo $pct_bac_s;
           
            
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