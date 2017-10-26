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

    foreach($total_eleves as $te){
        $v_tot_el=$te['count(*)'];
        $v_tot_el=intval($v_tot_el);
    }

    switch($value_stat_choisie){ //vient du $d['value_stat_choisie']
        case "s1" ://provenance élèves
            
            //print_r($total_eleves->[count(*)] );//ne fonctionne pas
            //print_r($total_eleves); //affiche tout...
   
           foreach($nb_bac_s as $bs){
               $v_bac_s=$bs['count(*)']; //vue bac S
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
           
           //Les pourcentages des baccalauréats (S, ES, SEN, STI2D, STMG, Autres)
           $pct_bac_s=$v_bac_s*100/$v_tot_el;
           $pct_bac_es=$v_bac_es*100/$v_tot_el;
           $pct_bac_sen=$v_bac_sen*100/$v_tot_el;
           $pct_bac_sti2d=$v_bac_sti2d*100/$v_tot_el;
           $pct_bac_stmg=$v_bac_stmg*100/$v_tot_el;
           $pct_ba=$v_ba*100/$v_tot_el;
           
           echo 'Bac S : ', $pct_bac_s , 
                   ' &#37;<br>Bac ES: ', $pct_bac_es, 
                   ' &#37;<br>Bac Pro SEN : ', $pct_bac_sen ,
                   ' &#37;<br>Bac STI2D : ',$pct_bac_sti2d ,
                   ' &#37;<br>Bac STMG : ', $pct_bac_stmg , 
                   ' &#37;<br>Autres Baccalauréats : ', $pct_ba ,
                   ' &#37;' ; // % =  &#37; en html
            
            break;
        case "s2"://Poursuite à l'étranger, sur la totalité des étudiants
            foreach($nb_international as $ni){
                $v_nb_international=$ni['count(*)'];
                $v_nb_international=intval($v_nb_international);
            } 
            foreach($nb_opt1_international as $n1_i){
                $v_nb_opt1_international=$n1_i['count(*)'];
                $v_nb_opt1_international=intval($v_nb_opt1_international);
            } 
            foreach($nb_opt2_international as $n2_i){
                $v_nb_opt2_international=$n2_i['count(*)'];
                $v_nb_opt2_international=intval($v_nb_opt2_international);
            } 
            
            //Le pourcentage d'élèves à l'international (une fiche contact/élève)
            $pct_international=$v_nb_international*100/$v_tot_el;
            
            //% élèves en dev à l'international
            $pct_opt1_international=$v_nb_opt1_international*100/$v_tot_el;
            
            //% élèves en SISR à l'international
            $pct_opt2_international=$v_nb_opt2_international*100/$v_tot_el;
            
            echo 'Elèves à l\'international : ', $pct_international , ' &#37;<br>';
            echo 'Elèves SLAM à l\'international : ', $pct_opt1_international , ' &#37;<br>';
            echo 'Elèves SISR à l\'international : ', $pct_opt2_international , ' &#37;<br>';
            
            break;
        case "s3"://Taux de redoublement moyen
            foreach($nb_redoublants_total as $nrt){
                $v_nb_redoublants_total=$nrt['count(*)'];
                $v_nb_redoublants_total=intval($v_nb_redoublants_total);
            } 
            foreach($nb_promos as $np){
                $v_nb_promos=$np['count(*)'];
                $v_nb_promos=intval($v_nb_promos);
            } 
            
            $taux_redoublement=$v_nb_redoublants_total/$v_nb_promos;
            echo $taux_redoublement , ' redoublant par promotion. ';
            
            //soit sur une promotion de 28 élèves :
            $pct_redoublement=$taux_redoublement*100/28;
            echo 'Soit, sur une promotion de 28 étudiants en moyenne, ' ,$pct_redoublement , ' &#37; de redoublement.';
            
            break;
        case "s4"://Devenir après le BTS, d_devenir + innerjoin avec contact.u_code --> modèle ContactDevenir
            
            
            for($x=1;$x<=$num_devenir;$x++){ //pour le nombre de devenirs existants dans la base de données
                //echo 'hello 5 fois normalement<br>';//OK
                //echo 'Devenir ',$x, '.<br>';
                
                foreach(${'compte_devenir'.$x} as $cdev){ //passe $num_devenir fois ici ($num_devenir=5)
                    ${'v_nb_d'.$x}=$cdev['count(*)'];
                    ${'v_nb_d'.$x}=intval(${'v_nb_d'.$x});
                    
                    $valeur_devenir=intval(${'v_nb_d'.$x});//echo 'valeur : ', $valeur_devenir; //OK
                    
                    //echo 'Nombre d\'étudiants ayant ce devenir : ' , ${'v_nb_d'.$x},'<br>'; //OK
   
                    //on crée le tableau de valeurs du nombre de personnes ayant le devenir $x
                    $y=$x-1;//echo $y;
                    $tab_valeurs_devenirs["$y"]=$valeur_devenir;  
                    $tab_pct_valeurs_devenirs["$y"]=$valeur_devenir*100/$v_tot_el ;
                }
            }
            
            //afficher ici chaque valeur du futur tableau
            //echo 'Tableau final des devenirs :<br>';
            /*
            //on affiche les nombres de devenirs
            for($w=0; ($w<sizeof($tab_valeurs_devenirs)) ; $w++){
                echo 'Valeur devenir ',$w+1,' : ',$tab_valeurs_devenirs[$w],'<br>';
            }

            //on affiche les pourcentages des devenirs
            for($w=0; ($w<sizeof($tab_pct_valeurs_devenirs)) ; $w++){
                echo 'Pourcentage devenir ',$w+1,' : ',$tab_pct_valeurs_devenirs[$w],'<br>';
            }
            */
            
            echo '<strong>Pourcentages des devenirs</strong> :<br>';
            
            //Nom devenir : pourcentage de chaque devenir
            foreach ($devenirs as $de){
                $rang=($de->d_code)-1; //echo 'd_code=',$de->d_code ;//OK
                echo $de->d_devenir ;
                
                echo ' : ',$tab_pct_valeurs_devenirs[$rang],'<br>';
            }
            
            ?>
            <?php $blabla="hey test json !"; ?>
            <!-- test JSON -->
            <script src="../webroot/js/script_statistiques.js"></script>

            <script>
                var variable_a_utiliser = '<?= json_encode($blabla); ?>';
                alert(variable_a_utiliser);
            </script>
            <?php
            break;
        default:
            //pas de stat' sélectionnée, on ne fait rien
    }                
?>

<!-- test html récupéré grâce à l'id en JS-->
<!-- HTML 
<input type="hidden" id="untest" value="<?php //$test="coucou"; echo $test; ?>"/>

<script>//JavaScript 
 
//on récupère les données
var variableRecuperee = document.getElementById("untest").value;
//alert(variableRecuperee);
</script>-->





<!-- diagrammes et graphiques stats -->
<div id="container" style="height: 500px"></div>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>


<?php
switch($value_stat_choisie){ //vient du $d['value_stat_choisie']
    case "s1" :
?>

        <script type="text/javascript">
        
        //On prélève les variables de PHP pour la provenance des étudiants
        var pct_bac_s = '<?= json_encode($pct_bac_s); ?>';
        var pct_bac_es='<?= json_encode($pct_bac_es); ?>';
        var pct_bac_sen='<?= json_encode($pct_bac_sen); ?>';
        var pct_bac_sti2d='<?= json_encode($pct_bac_sti2d); ?>';
        var pct_bac_stmg='<?= json_encode($pct_bac_stmg); ?>';
        var pct_ba='<?= json_encode($pct_ba); ?>';
        
        //on met en /1354 au lieu de pourcentage
        pct_bac_s=pct_bac_s*1354/100; //alert(pct_bac_s);
        pct_bac_es=pct_bac_es*1354/100; //alert(pct_bac_es);
        pct_bac_sen=pct_bac_sen*1354/100; //alert(pct_bac_sen);
        pct_bac_sti2d=pct_bac_sti2d*1354/100; //alert(pct_bac_sti2d);
        pct_bac_stmg=pct_bac_stmg*1354/100; //alert(pct_bac_stmg);
        pct_ba=pct_ba*1354/100; //alert(pct_ba);
        
        
        //on crée le graphique
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            backgroundColor: '#507090',

            title: {
                text: 'Les devenirs après un BTS SIO',
                left: 'center',
                top: 20,
                textStyle: {
                    color: '#aaa'
                }
            },

            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },

            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    colorLightness: [0.2, 0.9] //0 noir, 1 blanc (nuances d'une couleur, ici R)
                }
            },
            series : [
                {
                    name:'Pourcentage :',
                    type:'pie',
                    radius : '55%',
                    center: ['50%', '50%'],
                    data:[
                        {value:pct_bac_s, name:'Bac S'}, //la somme doit faire 1354
                        {value:pct_bac_es, name:'Bac ES'},
                        {value:pct_bac_sen, name:'Bac Pro SEN'},
                        {value:pct_bac_sti2d, name:'Bac STI2D'},
                        {value:pct_bac_stmg, name:'Bac STMG'},
                        {value:pct_ba, name:'Autres'}
                    ].sort(function (a, b) { return a.value - b.value; }),
                    roseType: 'radius',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            },
                            smooth: 0.2,
                            length: 10,
                            length2: 20
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#AABFDD',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },

                    animationType: 'scale',
                    animationEasing: 'elasticOut',
                    animationDelay: function (idx) {
                        return Math.random() * 200;
                    }
                }
            ]
        };;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
        </script>

<?php 
        break;
    case "s2" :
        break;
    case "s3" :
        break;
    case "s4" :
        break;
    default:
        //echo '';//pas d'affichage de graphique
}
?>