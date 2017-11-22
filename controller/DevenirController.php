<?php

/**
 * Description of DevenirController
 *
 * @author Sarradin
 * 
 * contrôleur pour le module devenir de l'application entreprises
 */
include('verifications.php');

class DevenirController extends Controller {
    
    private $modDevenir = null; //modèle devenir
    private $modPromotion = null; 
    private $modEleve = null;
    private $modUser = null;
    private $modUserEleve = null;
    private $modContact = null;
    private $modContactDevenir = null;
    
    
    //chargement des modèles utiles
    function chargementModeles(){
        $this->modDevenir = $this->loadModel('Devenir'); //charger le modèle Devenir
        $this->modPromotion = $this->loadModel('Promotion'); //charger le modèle Promotion
        $this->modUser = $this->loadModel('User');//charger le modèle User
        $this->modEleve = $this->loadModel('Eleve');//charger le modèle Eleve
        $this->modUserEleve = $this->loadModel('UserEleve');
        $this->modUserEleveContact = $this->loadModel('UserEleveContact');
        $this->modContactDevenir = $this->loadModel('ContactDevenir');
        $this->modContact = $this->loadModel('Contact');
        $this->modContactEleve = $this->loadModel('ContactEleve');
        $this->modUserEleveAvecContact = $this->loadModel('UserEleveContact');
    }
    
        
    
    
    
    
    //////////////////////////////////////
    ////    CREATION FICHE    ////////////
    //////////////////////////////////////
    
    function fiche_contact(){
        $d['var_script']='fiche_contact';
        $this->chargementModeles();  
        $contact_valid=true;
        

        
        //récupérer les données
        $d['devenirs'] = $this->modDevenir->find(); //utilisé dans le foreach d'affichage
        $d['promotions'] = $this->modPromotion->find(); //conditions : le where (ici, pas de restriction) = pareil que si on ne met rien dans le find(array('conditions' => 1))
        $d['eleves'] = $this->modEleve->find();
        $d['users'] = $this->modUser->find();
        $d['lecodepromo']='';
        $d['loption']='';
        $d['lusereleve']='';
        $d['ledevenir']='';
        
        //récupérer les données du 1er formulaire : promo + option
        if(isset($_POST['submit1'])){
            $promo_sel=$_POST['promo']; //promotion sélectionnée
            //echo 'PROMOTION : ',$promo_sel ,'<br>';
            
            $option_sel=$_POST['option'];
            //echo 'OPTION : ',$option_sel;
            
            $d['lecodepromo']=$promo_sel; //pour le selected : $d['name']=$var_entrée
            $d['loption']=$option_sel;

            //$params=array();
            //$projection='users.u_code,u_nom,u_prenom';
            /*//avant, on affichait tous les élèves
            $conditions= array('pr_code'=>$promo_sel,'el_option'=>$option_sel);
            $params=array('projection'=>$projection,'conditions'=>$conditions);
            $d['usereleve'] = $this->modUserEleve->find($params); //on récupère les données de la jointure User + Eleve
                                                                //rien dans le find car pas de where */
            
            
            
            
            //select u_nom, u_prenom from eleve left join contact on eleve.u_code= contact.u_code where co_code is NULL;
            //$null=NULL;
            $pj_pascontacteleve='users.u_code, u_nom, u_prenom';
            $cond_pascontacteleve= array('pr_code'=>$promo_sel,'el_option'=>$option_sel,'co_code'=>null);
            $params_pascontacteleve=array('projection'=>$pj_pascontacteleve,'conditions'=>$cond_pascontacteleve);
            $d['eleves_promo_selected'] = $this->modUserEleveContact->find($params_pascontacteleve);
            
            
        } //fin isset submit 1 (formulaire 1)
        
        //on prélève les données du 2e formulaire
        if(isset($_POST['submit2']) && !empty($_POST['date_contact'])){
            $international=0;
            $precisions='';
            $code_etudiant=$_POST['code_etudiant'];
            $info_devenir=$_POST['info_devenir'];

            $date_contact=date("Y-m-d"); //on a initialisé la value aussi côté client
            if(isset($_POST['date_contact'])){
                try{
                    $date_contact=$_POST['date_contact'];
                    verifDateY_m_d($date_contact);
                } catch (Exception $ex) {
                    $d['message']=$ex->getMessage(); // ? ne fonctionne pas à chaque fois...pq?
                    $contact_valid=false;
                }    
            }
            //echo 'date = ', $date_contact;
            
            if(isset($_POST['international'])){
                $international=1;
            }
            if(isset($_POST['precisions'])){
                try{
                    $precisions=nettoyer($_POST['precisions'], 254);
                } catch (Exception $ex) {
                    $d['message']=$ex->getMessage(); //OK
                    $contact_valid=false;
                }
                
            }
            
            
            /*
            echo 'code étudiant : ', $code_etudiant ,'<br>';
            echo 'date contact : ', $date_contact ,'<br>';
            echo 'info dev : ', $info_devenir ,'<br>';
            echo 'international :' , $international ,'<br>';
            echo 'precisions : ' , $precisions ,'<br>';
            */
            
            $d['lusereleve']= $code_etudiant ; //pour le selected etudiant
            $d['ledevenir']=$info_devenir;
            
            
            
            if($contact_valid){
                $tab_col_contact= array('u_code','co_date','d_code','co_international','co_precisions') ; //nom des colonnes de la table contact
                $tab_contact= array($code_etudiant,$date_contact,$info_devenir,$international,$precisions) ; //nom des données entrées

                $modContact=$this->loadModel('Contact');
                
                $modContact->insertAI($tab_col_contact,$tab_contact); //requête insertion
                echo 'Fiche contact bien insérée.';
            }
            else{
                echo 'Problème d\'insertion<br>';
                print_r($d['message']); //affiche l'exception de précisions
            }

                        
        } //fin isset submit 2 (formulaire détails du contact)  

        $this->set($d);
    }
    
    
    
    
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////////
    // Fonction modifier_contact /////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////
    

    function modifier_contact($id){//paramètre $id passé dans l'URL pour récupérer l'étudiant
        $d['var_script']='modifier_contact';
        $this->chargementModeles(); 

        
        //récupérer les données
        $d['devenirs'] = $this->modDevenir->find(); //utilisé dans le foreach d'affichage
        $d['promotions'] = $this->modPromotion->find(); //conditions : le where (ici, pas de restriction) = pareil que si on ne met rien dans le find(array('conditions' => 1))
        $d['eleves'] = $this->modEleve->find();
        $d['users'] = $this->modUser->find();
        $d['lecodepromo']='';
        $d['loption']='';
        $d['lusereleve']='';
        $d['ledevenir']='';
        $d['contactdevenir']='';
        
        //récupérer les données du 1er formulaire : promo + option
        if(isset($_POST['submit1'])){
            $promo_sel=$_POST['promo']; //promotion sélectionnée
            //echo 'PROMOTION : ',$promo_sel ,'<br>';
            $option_sel=$_POST['option']; //option sélectionnée
            //echo 'OPTION : ',$option_sel;
            
            $d['lecodepromo']=$promo_sel; //pour le selected : $d['name']=$var_entrée
            $d['loption']=$option_sel; //on met la promo et l'option dans $d[]

            //requête qui select nom prenom contact.ucode, where option : celle sélectionnée && promo = celle sélectionnée
            //on veut ++ ceux qui ont déjà une fiche (jointure)
            /*SELECT contact.u_code, u_nom, u_nom FROM contact 
            INNER JOIN users ON contact.u_code=users.u_code 
            INNER JOIN eleve ON eleve.u_code=users.u_code WHERE el_option="SLAM" && pr_code=1 ; */

            /*
            $projection='contact.u_code,u_nom,u_prenom';
            $conditions= array('pr_code'=>$promo_sel,'el_option'=>$option_sel);
            $params=array('projection'=>$projection,'conditions'=>$conditions);
            $d['eleves_promo_selected'] = $this->modUserEleveAvecContact->find($params);
            */
            
            ///////////////////////////////////////////////////////////
            //requête intermédiaire
            
            $projection1='contact.u_code';
            $conditions1= array('pr_code'=>$promo_sel,'el_option'=>$option_sel);
            $params1=array('projection'=>$projection1,'conditions'=>$conditions1);
            $d['eleves_promo_selected1'] = $this->modContactEleve->find($params1); 
            print_r($d['eleves_promo_selected1']);
            
            $codes_eleve_fiche="(";
            foreach($d['eleves_promo_selected1'] as $eps1){
                $codes_eleve_fiche .= $eps1->u_code . "," ;
            }
            // enlever ,
            $codes_eleve_fiche = substr($codes_eleve_fiche, 0, -1);
            // fin
            $codes_eleve_fiche= $codes_eleve_fiche.")";
            echo $codes_eleve_fiche;
            
            ///////////////////////////////////////////////////////////
            $projection='contact.u_code,u_nom,u_prenom';
            $conditions= array('users.u_code'=>$codes_eleve_fiche);
            $params=array('projection'=>$projection,'where_in'=>$conditions);
            $d['eleves_promo_selected'] = $this->modUserEleveContact->find($params); //on récupère les données de la jointure User + Eleve
            
            $d['ucode']='';//on initialise
            print_r($d['eleves_promo_selected']);

            
            
            
            
        } //fin isset submit 1 (formulaire 1)
        
        //deuxième formulaire
        if(isset($_POST['aff_fiche'])){
            $code_etudiant=$_POST['code_etudiant'];
            //echo 'code étu fonctionne bien : ', $code_etudiant;


            $projection2='co_code,co_date,co_international,co_precisions,contact.d_code'; //select du (contact && du devenir) par étudiant
            $conditions2= array('u_code'=>$code_etudiant); //le where
            //echo 'conditions :' , print_r($conditions2);
            $params2=array('projection'=>$projection2,'conditions'=>$conditions2);
            $d['contactdevenir'] = $this->modContactDevenir->findFirst($params2); //on récupère une seule ligne
            //echo 'tableau(contactdevenir) : ';
            //print_r($d);
            //print_r($d['contactdevenir']);
            
            
            $projection3='users.u_code,u_nom,u_prenom';
            $conditions3= array('users.u_code'=>$code_etudiant);
            $params3=array('projection'=>$projection3,'conditions'=>$conditions3);
            $d['elevefiche'] = $this->modUserEleve->find($params3);
            

            $projection4='co_code,contact.u_code,co_date,co_international,co_precisions,devenir.d_code';
            $conditions4= array('contact.u_code'=>$code_etudiant);
            $params4=array('projection'=>$projection4,'conditions'=>$conditions4);
            $d['contactseleve'] = $this->modContactDevenir->find($params4);

        }
            
        
        
        //on prélève les données du 2e formulaire pour l'update
        if(isset($_POST['submit2']) && !empty($_POST['date_contact'])){
            $code_etudiant=$_POST['code_etudiant'];
            
            $modif_valid=TRUE;
            
            $international=0;
            $precisions='';
            
            $date_contact=date("Y-m-d");//date actuelle
            $info_devenir=$_POST['info_devenir'];

            if(isset($_POST['date_contact'])){
                try{
                    $date_contact=verifDateY_m_d($_POST['date_contact']);
                } catch (Exception $ex) {
                    $d['message']=$ex->getMessage(); 
                    $modif_valid=false;
                }
                
            }
            //echo 'date = ', $date_contact;
            
            if(isset($_POST['international'])){
                $international=1;
            }
            if(isset($_POST['precisions'])){
                try{
                    $precisions=nettoyer($_POST['precisions'], 254);
                } catch (Exception $ex) {
                    $d['message']=$ex->getMessage(); 
                    $modif_valid=false;
                }
                
            }
            
            $donnees=array();
            $donnees['co_date']=$date_contact;
            $donnees['d_code']=$info_devenir;
            $donnees['co_international']=$international;
            $donnees['co_precisions']=$precisions;
            
            
            $modContact=$this->loadModel('Contact');
            
            $cle=array();
            $cle['co_code']=$_POST['cocode'];
            $d['lusereleve']= $code_etudiant ; //pour le selected etudiant
            $d['new_cd']=$info_devenir;
            
            $tableau= array() ; //création du tableau de modification
            $tableau['cle']=$cle;
            $tableau['donnees']=$donnees;
            
            
            if($modif_valid){
                $modContact->update($tableau); //requête update
                echo 'Fiche contact bien modifiée.';
            }
            else{
                print_r($d['message']); //affiche l'exception (les)
            }
            
            /*
            echo 'code étudiant : ', $code_etudiant ,'<br>';
            echo 'date contact : ', $date_contact ,'<br>';
            echo 'info dev : ', $info_devenir ,'<br>';
            echo 'international :' , $international ,'<br>';
            echo 'precisions : ' , $precisions ,'<br>';
            */
        } //fin isset submit 2 (formulaire détails du contact)
        
        

        //print_r($d);
        $this->set($d);
    }
    
    
    
    
    
    
    
    ////////////////////////////////////
    // Consulter les statistiques //////
    ////////////////////////////////////
    
    
    function consulter_stat(){
        $this->chargementModeles(); 
        
        //initialisations
        $msg_stat='';
        $value_stat_choisie='';
        $d['value_stat_choisie']='';
        $all='*';
        
        $option1="SLAM";
        $option2="SISR";
        
        //TOTAL d'élèves (combien d'élèves en tout)
        //$conditions_tot_el= array(''); //pas de where comme on veut tous les élèves de la table el
        $params_total_el=array('count'=>$all); //pas de , 'conditions'=>$conditions_tot_el
        $d['total_eleves'] = $this->modEleve->find($params_total_el);
        //print_r($d['total_eleves']);
                    
        if(isset($_POST['submit_choix_stat'])){
            $value_stat_choisie=$_POST['stat_choisie']; //stat_choisie
            //echo 'stat choisie : ',$value_stat_choisie ,'<br>'; //s'affiche bien
            $d['value_stat_choisie']=$value_stat_choisie;

            switch($value_stat_choisie){
                case "s1" : //Provenance des étudiants, el_diplome_prec
                    $msg_stat="Provenance des étudiants en BTS SIO...";
                    
                    //pourcentage de chaque diplôme précédent sur la totalité des élèves
                    //concerne uniquement la table élève
                    
                    // Nb bac S
                    $bac_s='Bac S';//variabe à compter
                    $conditions_bac_s= array('el_diplome_prec'=>$bac_s);// where el_diplome_prec=$bac_s
                    $params_el_s=array('count'=>$all,'conditions'=>$conditions_bac_s);// on met le count et la condition
                    $d['nb_bac_s'] = $this->modEleve->find($params_el_s);// on récupère le résultat dans le tableau $d
                    //print_r($d['nb_bac_s']);
                    
                    // Nb bac ES
                    $bac_es='Bac ES';
                    $conditions_bac_es= array('el_diplome_prec'=>$bac_es);
                    $params_el_es=array('count'=>$all,'conditions'=>$conditions_bac_es);
                    $d['nb_bac_es'] = $this->modEleve->find($params_el_es);
                    //print_r($d['nb_bac_es']);
                    
                    // Nb bac pro SEN
                    $bac_pro_sen='Bac Pro SEN';
                    $conditions_bac_pro_sen= array('el_diplome_prec'=>$bac_pro_sen);
                    $params_el_sen=array('count'=>$all,'conditions'=>$conditions_bac_pro_sen);
                    $d['nb_bac_pro_sen'] = $this->modEleve->find($params_el_sen);
                    //print_r($d['nb_bac_pro_sen']);
                    
                    // Nb bac STI2D
                    $bac_sti2d='Bac STI2D';
                    $conditions_bac_sti2d= array('el_diplome_prec'=>$bac_sti2d);
                    $params_el_sti2d=array('count'=>$all,'conditions'=>$conditions_bac_sti2d);
                    $d['nb_bac_sti2d'] = $this->modEleve->find($params_el_sti2d);
                    //print_r($d['nb_bac_sti2d']);
                    
                    // Nb bac STMG
                    $bac_stmg='Bac STMG';
                    $conditions_bac_stmg= array('el_diplome_prec'=>$bac_stmg);
                    $params_el_stmg=array('count'=>$all,'conditions'=>$conditions_bac_stmg);
                    $d['nb_bac_stmg'] = $this->modEleve->find($params_el_stmg);
                    //print_r($d['nb_bac_stmg']);
                    
                    // Nb bac Autre
                    $bac_autre='Autre';
                    $conditions_bac_autre= array('el_diplome_prec'=>$bac_autre);
                    $params_el_autre=array('count'=>$all,'conditions'=>$conditions_bac_autre);
                    $d['nb_bac_autre'] = $this->modEleve->find($params_el_autre);
                    //print_r($d['nb_bac_autre']);
                    
                    break;
                case "s2"://Poursuite à l'étranger, sur la totalité des étudiants
                    $msg_stat="Taux de poursuite à l'étranger";
                    
                    //nombre d'élèves où co_international=1
                    $conditions_international= array('co_international'=>1);
                    $params_international=array('count'=>$all,'conditions'=>$conditions_international);
                    $d['nb_international'] = $this->modContact->find($params_international);
                    //print_r($d['nb_international']);
                    
                    //nb de d'élèves SLAM où co_international=1
                    $conditions_international= array('co_international'=>1,'el_option'=>$option1);
                    $params_international=array('count'=>$all,'conditions'=>$conditions_international);
                    $d['nb_opt1_international'] = $this->modContactEleve->find($params_international);
                    //print_r($d['nb_opt1_international']);
                    
                    //nb de d'élèves SISR où co_international=1
                    $conditions_international= array('co_international'=>1,'el_option'=>$option2);
                    $params_international=array('count'=>$all,'conditions'=>$conditions_international);
                    $d['nb_opt2_international'] = $this->modContactEleve->find($params_international);
                    //print_r($d['nb_opt2_international']);

                    break;
                case "s3"://Taux de redoublement moyen
                    $msg_stat="Taux de redoublement moyen";
                    
                    //Requête pour nombre de redoublants en moyenne càd :
                    //(nombre de redoublants total ici puis divisé par le nb de promos !)
                    $conditions_redouble= array('el_redoublant'=>1);// where élève est un redoublant et appartient à telle promo
                    $params_redouble=array('count'=>$all,'conditions'=>$conditions_redouble);// on met le count et la condition
                    $d['nb_redoublants_total'] = $this->modEleve->find($params_redouble);// on récupère le résultat dans le tableau $d
                    //print_r($d['nb_redoublants_total']);echo '<br>';
                    
                    
                    
                    //nb de promos dans la BDD
                    $params_nb_promos=array('count'=>$all);
                    $d['nb_promos'] = $this->modPromotion->find($params_nb_promos);
                    $nb_promotions=$d['nb_promos']; 
                    //echo 'print_r nb_promos:<br>';
                    //print_r($d['nb_promos']); echo '<br>';
                    
                    $nbprom=0;
                    foreach($nb_promotions as $prom){
                        $nb_prom=$prom['count(*)'];
                        //echo $nb_prom; //OK
                        $d['nombre_promotions']=$nb_prom;
                    }
                    
                    //Requête pour telle promo : compte le nombre de redoublants correspondants
                    for($y=1;$y<=$nb_prom;$y++){
                        $conditions_redoub_promo= array('pr_code'=>$y,'el_redoublant'=>1);
                        $params_redoub_promo=array('count'=>$all,'conditions'=>$conditions_redoub_promo);
                        ${'nb_redoub_promo'.$y} = $this->modEleve->find($params_redoub_promo);
                        //echo '<br>y=',$y,' ';
                        //print_r(${'nb_redoub_promo'.$y});//OK
                        //$d['nb_redoub_promo'.$y]=${'nb_redoub_promo'.$y};
                        
                        foreach(${'nb_redoub_promo'.$y} as $n){
                            $d['nb_redoub_promo'.$y]=$n['count(*)'];
                            //echo $d['nb_redoub_promo'.$y];
                        }
                        
                    }
                    
                    //echo '<br>test $d nb_redoub_promo 1 :',print_r($d['nb_redoub_promo1']); //fonctionne OK
                    //echo '<br>test $d nb_redoub_promo 2 :',print_r($d['nb_redoub_promo2']);
                    


                    
                    //Requête nombre de redoublants promo 1
                    //$conditions_redouble= array('el_redoublant'=>1,'pr_code'=>1);// where élève est un redoublant et appartient à telle promo
                    //$params_redouble=array('count'=>$all,'conditions'=>$conditions_redouble);// on met le count et la condition
                    //$d['nb_redoublants1'] = $this->modEleve->find($params_redouble);// on récupère le résultat dans le tableau $d
                    //print_r($d['nb_redoublants1']);echo '<br>';
                    
                    
                    //Requête nombre de redoublants par promo...
                    //pour chaque promo de la bdd (foreach)
                        //requête...$promo.$x
                        //$d['nb_redoublants_$x']
                    $d['promotions'] = $this->modPromotion->find();
                    //print_r($d['promotions']);//OK
                    
                    //---> ici(PROBLEME) je n'arrive pas à récupérer chaque promo de la BDD (genre un foreach ici dans le contrôleur, dans la view je sais faire)
                    //et appliquer la requête de redoublement pour chaque promo (même si on rajoute des promos ça devra fonctionner)...
                    
                    /*//si on voulait que l'utilisateur sélectionne lui-même la promo. 
                     * //Mais on va faire un diagramme en bâtons avec les promos de la BDD
                    $d['lecodepromo']='';

                     if(isset($_POST['choix_promo'])){
                        $promo_sel=$_POST['promo']; 
                        $d['lecodepromo']=$promo_sel;
                     }
                     * 
                     */
                    
                    break;
                case "s4"://Devenir après le BTS, d_devenir + innerjoin avec contact.u_code --> modèle ContactDevenir
                    $msg_stat="Que deviennent-ils après le BTS SIO ?";

                    //on prend les devenirs de la BDD
                    $d['devenirs'] = $this->modDevenir->find();
                    //print_r($d['devenirs']);
                    
                    $nb_devenirs=0; //on compte le nombre de devenirs qu'il y a dans la BDD
                    foreach($d['devenirs'] as $de){
                        //echo $de->d_devenir;//afficher les devenirs
                        $nb_devenirs++;
                        //echo ' ',$nb_devenirs;
                        
                        
                        //Requête qui renvoie le nombre d'étudiants ayant ce devenir $nb_devenirs
                        $conditions_devenir= array('d_code'=>$nb_devenirs); //,'el_option'=>$option2
                        $params_devenir=array('count'=>$all,'conditions'=>$conditions_devenir);
                        $d["compte_devenir$nb_devenirs"] = $this->modContact->find($params_devenir);
                        
                    }
                    //echo ' ',$nb_devenirs;//renvoie bien 5
                    $d['num_devenir']=$nb_devenirs;
                    //print_r($d['num_devenir']); echo ': valeur num_devenir, théoriquement 5'; //OK
                    
                    //Requête du total d'élèves à faire tel devenir
                    /*
                    $conditions_devenir= array('d_code'=>1); //,'el_option'=>$option2
                    $params_devenir=array('count'=>$all,'conditions'=>$conditions_devenir);
                    $d['compte_devenir'] = $this->modContact->find($params_devenir);
                     * 
                     */
                    //print_r($d['compte_devenir']);
                    
                    
                    break;
                default:
                    $msg_stat="Choisissez les statistiques que vous voulez visionner.";
            }
             
            
        } //fin du if isset submit choix stat
        
        //echo '$msg_stat: ',$msg_stat;
        $d['titre_stat']=$msg_stat; //pour afficher le sous-titre de la statistique choisie
        
        $this->set($d);
        
    }//fin consulter stat
    
    
    
    function contact(){
        // adresse mail du système
        $destinataire = 'aurelia.sarradin@gmail.com';

        // copie ? (envoie une copie au visiteur)
        $copie = 'oui';

        // Action du formulaire (si la page a des paramètres dans l'URL)
        $form_action = '';

        // Messages de confirmation du mail
        $message_envoye = "Votre message nous est bien parvenu !";
        $message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

        // Message d'erreur du formulaire
        $message_formulaire_invalide = "Mail invalide. Vérifiez tous les champs et notamment la validité de votre adresse mail.";

        /*
         * fonctions Rec() et IsMail() dans les verifications.php
         */


        // formulaire envoyé, on récupère tous les champs.
        $nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : ''; //opérateur ternaire : si la variable est postée(condition) ? cas1 :(sinon) cas2.
        $email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : ''; //$_POST["attribut name du html"]
        $objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
        $message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

        // On va vérifier les variables et l'email ...
        $email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
        $err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

        if (isset($_POST['envoi']))
        {
            if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
            {
                // les 4 variables sont remplies, on génère puis envoie le mail
                $headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";
                //$headers .= 'Reply-To: '.$email. "\r\n" ;
                //$headers .= 'X-Mailer:PHP/'.phpversion();

                // envoyer une copie au visiteur ?
                if ($copie == 'oui')
                {
                          $cible = $destinataire.';'.$email;
                }
                else
                {
                          $cible = $destinataire;
                }

                // Remplacement de certains caractères spéciaux
                $message = str_replace("&#039;","'",$message);
                $message = str_replace("&#8217;","'",$message);
                $message = str_replace("&quot;",'"',$message);
                $message = str_replace('&lt;br&gt;','',$message);
                $message = str_replace('&lt;br /&gt;','',$message);
                $message = str_replace("&lt;","&lt;",$message);
                $message = str_replace("&gt;","&gt;",$message);
                $message = str_replace("&amp;","&",$message);

                // Envoi du mail
                $num_emails = 0;
                $tmp = explode(';', $cible);
                foreach($tmp as $email_destinataire){
                          if (mail($email_destinataire, $objet, $message, $headers))
                                    $num_emails++;
                }

                if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
                {
                    echo '<p>'.$message_envoye.'</p>';
                }
                else
                {
                    echo '<p>'.$message_non_envoye.'</p>';
                }
            }
            else
            {
                      // une des 3 variables (ou plus) est vide ...
                      echo '<p>'.$message_formulaire_invalide.'</p>';
                      $err_formulaire = true;
            }
        } // fin du if (!isset($_POST['envoi']))
        
        
        $d['err_formulaire']=$err_formulaire;
        $d['form_action']=$form_action;
        $d['nom']=$nom;
        $d['email']=$email;
        $d['objet']=$objet;
        $d['message']=$message;
        
        
        $this->set($d);

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //méthode déjà dans la classe mère, contenu différent
    //pour ajouter un contact on utilise la même vue que pour modifier un contact
    //l'intérêt de modifier la méthode fille render est de ne pas réécrire une vue
    function render($view) {
        if($view=='modifier_contact'){
            parent::render('fiche_contact');
        }
        else{
            parent::render($view); //$view='fiche_contact' par exemple
        }
    }
    
    
}