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

<!-- Prévenir du chargement de la page --> 
<?php if(isset($_POST['submit_choix_stat'])){?>
<script type="text/javascript" src="<?=BASE_SITE.'/js/chargement.js'?>"></script>
<div id="centre">
    <span id="loader"><img src="<?php echo BASE_SITE . DS . '/img/loader.gif' ?>" border="0" alt="Chargement" title="Chargement" /> 
        Chargement en cours
    </span>
    <div id="centre_contenu">
    </div>
</div>
<?php } ?>



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
           
           /*//AFFICHAGE DES DONNEES EN PHP
           echo 'Bac S : ', $pct_bac_s , 
                   ' &#37;<br>Bac ES: ', $pct_bac_es, 
                   ' &#37;<br>Bac Pro SEN : ', $pct_bac_sen ,
                   ' &#37;<br>Bac STI2D : ',$pct_bac_sti2d ,
                   ' &#37;<br>Bac STMG : ', $pct_bac_stmg , 
                   ' &#37;<br>Autres Baccalauréats : ', $pct_ba ,
                   ' &#37;' ; // % =  &#37; en html
            * 
            */
            
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
            
            
            /*//AFFICHAGE DES DONNEES EN PHP
            echo 'Elèves à l\'international : ', $pct_international , ' &#37;<br>';
            echo 'Elèves SLAM à l\'international : ', $pct_opt1_international , ' &#37;<br>';
            echo 'Elèves SISR à l\'international : ', $pct_opt2_international , ' &#37;<br>';
             * 
             */
            
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
            //AFFICHAGE DES DONNEES EN PHP
            //echo 'Il y a en moyenne ',$taux_redoublement , ' redoublant(s) par promotion (sur deux ans). ';
            
            //soit sur une promotion de 28 élèves :
            $pct_redoublement=$taux_redoublement*100/28;
            //AFFICHAGE DES DONNEES EN PHP
            //echo 'Soit, sur une promotion de 28 étudiants en moyenne, ' ,$pct_redoublement , ' &#37; de redoublement.';

            ?>
 
    
            <?php
            //statistiques de redoublement par promotion
            
            for($p=1;$p<=$nombre_promotions;$p++){
                //récupérer les dates correspondant à chaque promotion
                //l'année courante pour la promo
                $annee_promo = 2015 + $p-1 ; //on commence en 2015
                
                //pour chaque promo, on veut le nombre de redoublants (on y associe la date)
                $tab_redoub_promo["$p"]=${'nb_redoub_promo'.$p}; //OK
               
                //AFFICHAGE DES DONNEES EN PHP
                //echo '<br>Pour la promotion ', $p, ' (' , $annee_promo, '-', $annee_promo+2, '), ' , $tab_redoub_promo[$p] , ' redoublants.'; //OK

            }
            
            
            ?>
            
            
            
            
            <?php
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
                
                //AFFICHAGE DES DONNEES EN PHP
                //echo $de->d_devenir ;
                //echo ' : ',$tab_pct_valeurs_devenirs[$rang],' &#37;<br>';
            }
            
            ?>
            

            <!--script src="../webroot/js/script_devenir.js"></script-->

            <?php
            break;
        default:
            //pas de stat' sélectionnée, on ne fait rien
    }                
?>



<!-- diagrammes et graphiques stats -->
<!-- on charge tous les scripts JS 1 fois pour tous les scripts à venir-->
<div id="container" style="height: 500px"><!--chaque graphique se met ici--></div>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/echarts-all-3.js' ?>"></script>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/ecStat.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/dataTool.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/china.js' ?>"></script>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/world.js' ?>"></script>
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/api.js' ?>"></script><!-- http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM -->
<script type="text/javascript" src="<?php echo BASE_SITE . '/js/echarts/bmap.min.js' ?>"></script>


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
        
        //on met en /1000 au lieu de pourcentage
        pct_bac_s=parseInt(pct_bac_s*10); //alert(pct_bac_s);
        pct_bac_es=parseInt(pct_bac_es*10); //alert(pct_bac_es);
        pct_bac_sen=parseInt(pct_bac_sen*10); //alert(pct_bac_sen);
        pct_bac_sti2d=parseInt(pct_bac_sti2d*10); //alert(pct_bac_sti2d);
        pct_bac_stmg=parseInt(pct_bac_stmg*10); //alert(pct_bac_stmg);
        pct_ba=parseInt(pct_ba*10); //alert(pct_ba);
        
        
        
        
        //on crée le graphique, se met dans le container en html ci-dessus
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            backgroundColor: '#507090',

            title: {
                text: 'Les provenances des étudiants avant le BTS SIO',
                left: 'center',
                top: 20,
                textStyle: {
                    color: '#aaa'
                }
            },

            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} ({d}%)" // "{a} <br/>{b} : {c} ({d}%)" //si on veut afficher aussi le nb de base
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
        //fin graphique provenance des étudiants
        </script>

        
<?php
        break;
    case "s2" :
        
    //début graphique 2, poursuites à l'étranger
?>

        <script type="text/javascript">
            
            //On prélève les variables de PHP pour la provenance des étudiants
            var pct_opt1_international = '<?= json_encode($pct_opt1_international); ?>';
            var pct_opt2_international = '<?= json_encode($pct_opt2_international); ?>';
            var reste = '<?= 100-json_encode($pct_international); ?>'; //alert(reste);//OK
            
            pct_opt1_international = parseInt(pct_opt1_international);
            pct_opt2_international = parseInt(pct_opt2_international);
            reste = parseInt(reste);
            
            //début du graphique à mettre dans le container
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                      title : {
                                text: 'International',
                                subtext: 'Poursuite des étudiants à l\'étranger...',
                                x:'center'
                      },
                      tooltip : {
                                trigger: 'item',
                                formatter: "{a} <br/>{b}  ({d}%)"     //"{a} <br/>{b} : {c} ({d}%)"
                      },
                      legend: {
                                orient: 'vertical',
                                left: 'left',
                                data: ['Etudiants SLAM à l\'international','Etudiants SISR à l\'international','Etudiants restant en France'] //attention, même nom qu'en dessous obligatoire
                      },
                      series : [
                                {
                                    name: 'Pourcentage :',
                                    type: 'pie',
                                    radius : '55%',
                                    center: ['50%', '60%'],
                                    data:[
                                              {value:pct_opt1_international, name:'Etudiants SLAM à l\'international'}, //attention, même nom qu'au-dessus obligatoire
                                              {value:pct_opt2_international, name:'Etudiants SISR à l\'international'},
                                              {value:reste, name:'Etudiants restant en France'}
                                    ],
                                    itemStyle: {
                                              emphasis: {
                                                        shadowBlur: 10,
                                                        shadowOffsetX: 0,
                                                        shadowColor: 'rgba(0, 0, 0, 0.7)'
                                              }
                                    }
                                }
                      ]
            };
            ;
            if (option && typeof option === "object") {
                      myChart.setOption(option, true);
            }
            //fin affichage graphique s2 (étudiants à l'international)
       </script>
        

<?php 
        break;
    case "s3" :
        //taux de redoublement
?>
        <script type="text/javascript">
           
           var tab_redoub_promo = new Array(); //on crée le tableau avant la boucle
           var tab_annee_promo = new Array(); //on crée le tableau des années correspondant à chaque promo
           
            //On prélève les variables de PHP pour la provenance des étudiants
            <?php
            //statistiques de redoublement par promotion

            for($p=1;$p<=$nombre_promotions;$p++){ ?>
                <?php
                //l'année courante pour la promo on commence en 2015
                $annee_promo = 2015 + $p-1 ;
                $tab_annee_promo[$p-1]=$annee_promo; //on met chaque année dans un tableau
                ?>
                
                var annee_promo= '<?= json_encode($annee_promo); ?>'; //console.log(annee_promo);//OK, affiche chaque année de promo
                var p0 = '<?= json_encode($p-1); ?>'; //console.log(p0); //OK, vaut 0 puis 1...
                var nb_redoublants_promo = '<?= ${'nb_redoub_promo'.$p}; ?>'; // console.log(p0+ ' : ' +nb_redoublants_promo);
                             
                tab_redoub_promo.push(nb_redoublants_promo); 
                //console.log('Tableau des redoublements par promo, promotion n°'+p0+ ': '+tab_redoub_promo[p0]); //OK//on affiche le contenu du tableau à chaque rang (le nombre de redoublant pour la promo $p=1 quand p0=0...)
                     
                tab_annee_promo.push('<?= $annee_promo ?>');
                //console.log('Tableau dates :'+tab_annee_promo[p0]);//OK
            <?php } ?>
                
            var chaine_dates='';
            tab_annee_promo.forEach(function(laDate){
                chaine_dates+=""+laDate+""+"," ;
                
            });
            console.log("chaine_dates :"+chaine_dates);
            
  
            var chaine_sans_virgule='';
            //on enlève la dernière virgule
            for(var cd=0;cd<chaine_dates.length-1;cd++){//cd étant l'itérateur sur la longueur de la chaîne date
                                                      //on ne met pas <= car on ne veut pas le dernier caractère (la virgule)
                chaine_sans_virgule+=chaine_dates.charAt(cd) ;
                chaine_sans_virgule=chaine_sans_virgule.toString();
            }
            console.log("chaine_sans_virgule :"+ chaine_sans_virgule);
            
            tab_chaine_sans_virgule=chaine_sans_virgule.split(',');
            console.log(tab_chaine_sans_virgule);


            //création du graphique...
           
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = 'Statistiques de redoublement';

            option = {
                color: ['#77BBDB'],

                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            
                        type : 'shadow'   // 'line' | 'shadow' : le hover (passage de la souris)
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : tab_chaine_sans_virgule, //les noms des dates dans l'ordre
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Pourcentage',
                        type:'bar',
                        barWidth: '55%',
                        data:tab_redoub_promo //les valeurs dans l'ordre des noms des données
                    }
                ]
            };
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
       </script>
       
       

<?php
        break;
    case "s4" :
?>
       
       <script type="text/javascript">
           
           //on récupère les données de PHP
            var ps_et='<?= json_encode($tab_valeurs_devenirs[0]/$v_tot_el*100); ?>'; 
            var ch_voie='<?= json_encode($tab_valeurs_devenirs[1]/$v_tot_el*100); ?>'; 
            var cdd='<?= json_encode($tab_valeurs_devenirs[2]/$v_tot_el*100); ?>';
            var cdi='<?= json_encode($tab_valeurs_devenirs[3]/$v_tot_el*100); ?>';
            var chom='<?= json_encode($tab_valeurs_devenirs[4]/$v_tot_el*100); ?>';
            
            //conversion string to int
            ps_et = parseInt(ps_et);
            ch_voie = parseInt(ch_voie);
            cdd = parseInt(cdd);
            cdi = parseInt(cdi);
            chom = parseInt(chom);
            
            var autres= 100-(ps_et+ch_voie+cdd+cdi+chom); //alert(autres);
           
           
           //début du graphique
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = 'Devenir';

            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} ({d}%)" //: {c} (si on veut le nombre exact et non le pourcentage)
                },
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data:['Poursuite d\'études','Changement de voie','Travail en CDD','Travail en CDI','Chômage','Autres']
                },
                series: [
                    {
                        name:'Devenir',
                        type:'pie',
                        radius: ['50%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '23',
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },
                        data:[
                            {value:ps_et, name:'Poursuite d\'études'},
                            {value:ch_voie, name:'Changement de voie'},
                            {value:cdd, name:'Travail en CDD'},
                            {value:cdi, name:'Travail en CDI'},
                            {value:chom, name:'Chômage'},
                            {value:autres, name:'Autres'}
                        ]
                    }
                ]
            };
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
       </script>
       
       
        
<?php 
        break;
        //fin des affichages des graphiques
    default:
        //echo '';//pas d'affichage de graphique
}
?>