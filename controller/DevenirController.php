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
    
    function fiche_contact(){
        $d['var_script']='fiche_contact';
        
        $contact_valid=true;
        
        //chargement des modèles utiles
        $this->modDevenir = $this->loadModel('Devenir'); //charger le modèle Devenir
        $this->modPromotion = $this->loadModel('Promotion'); //charger le modèle Promotion
        $this->modUser = $this->loadModel('User');//charger le modèle User
        $this->modEleve = $this->loadModel('Eleve');//charger le modèle Eleve
        $this->modUserEleve = $this->loadModel('UserEleve');
        
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

            $params=array();
            $projection='users.u_code,u_nom,u_prenom';
            $conditions= array('pr_code'=>$promo_sel,'el_option'=>$option_sel);
            $params=array('projection'=>$projection,'conditions'=>$conditions);
            $d['usereleve'] = $this->modUserEleve->find($params); //on récupère les données de la jointure User + Eleve
                                                                //rien dans le find car pas de where
        } //fin isset submit 1 (formulaire 1)
        
        //on prélève les données du 2e formulaire
        if(isset($_POST['submit2']) && !empty($_POST['date_contact'])){
            $international=0;
            $precisions='';
            $code_etudiant=$_POST['code_etudiant'];
            $date_contact=date("Y-m-d"); //on a initialisé la value aussi
            $info_devenir=$_POST['info_devenir'];

            if(isset($_POST['date_contact'])){
                $date_contact=$_POST['date_contact'];
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
        
        

        //faire un where :
        //$d['eleves'] = $this->modEleve->find(array('conditions' => array('el_option'=>$opt, 'el_date_naissance'=>$el_date_nais)   ));
        

        $this->set($d);
    }
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////////
    // Fonction modifier_contact ////
    

    function modifier_contact($id){//paramètre $id passé dans l'URL pour récupérer l'étudiant
        $d['var_script']='modifier_contact';
        
        //chargement des modèles utiles
        $this->modDevenir = $this->loadModel('Devenir'); //charger le modèle Devenir
        $this->modPromotion = $this->loadModel('Promotion'); //charger le modèle Promotion
        $this->modUser = $this->loadModel('User');//charger le modèle User
        $this->modEleve = $this->loadModel('Eleve');//charger le modèle Eleve
        $this->modUserEleve = $this->loadModel('UserEleve');
        $this->modContactDevenir = $this->loadModel('ContactDevenir');
        
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

            $params=array();
            $projection='users.u_code,u_nom,u_prenom';
            $conditions= array('pr_code'=>$promo_sel,'el_option'=>$option_sel);
            $params=array('projection'=>$projection,'conditions'=>$conditions);
            $d['usereleve'] = $this->modUserEleve->find($params); //on récupère les données de la jointure User + Eleve
            
            $d['ucode']='';//on initialise
            
            
        } //fin isset submit 1 (formulaire 1)
        
        //deuxième formulaire
        if(isset($_POST['aff_fiche'])){
            $code_etudiant=$_POST['code_etudiant'];
            echo 'code étu fonctionne bien : ', $code_etudiant;
            
            //$d['ucode']=$code_etudiant; //OSEF
            

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
            
            $international=0;
            $precisions='';
            
            $date_contact=date("Y-m-d");
            $info_devenir=$_POST['info_devenir'];

            if(isset($_POST['date_contact'])){
                $date_contact=$_POST['date_contact'];
            }
            //echo 'date = ', $date_contact;
            
            if(isset($_POST['international'])){
                $international=1;
            }
            if(isset($_POST['precisions'])){
                try{
                    $precisions=nettoyer($_POST['precisions'], 254);
                } catch (Exception $ex) {
                    return $ex;
                }
                
            }
                        

                       
            // -------------------------------------------------------------------
            
            $co_code=$id[0];
            $modContact=$this->loadModel('Contact');
            $donnees=array();
            $cle=array();
            $cle['co_code']=$co_code;
            $d['lusereleve']= $code_etudiant ; //pour le selected etudiant
            $d['new_cd']=$info_devenir;
            
            $tab_col_contact= array('u_code','co_date','d_code','co_international','co_precisions') ; //nom des colonnes de la table contact
            $tab_contact= array($code_etudiant,$date_contact,$info_devenir,$international,$precisions) ; //nom des données entrées

            
            $modContact->insertAI($tab_col_contact,$tab_contact); //requête insertion
            
            echo 'Fiche contact bien modifiée.';
                                    /*
            echo 'code étudiant : ', $code_etudiant ,'<br>';
            echo 'date contact : ', $date_contact ,'<br>';
            echo 'info dev : ', $info_devenir ,'<br>';
            echo 'international :' , $international ,'<br>';
            echo 'precisions : ' , $precisions ,'<br>';
            */
        } //fin isset submit 2 (formulaire détails du contact)
        
        

        //faire un where :
        //$d['eleves'] = $this->modEleve->find(array('conditions' => array('el_option'=>$opt, 'el_date_naissance'=>$el_date_nais)   ));
        
        print_r($d);
        $this->set($d);
        
    }
    
    
    
    function consulter_stat(){
        
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