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
    
    
    function ajouter_contact(){
        
        if (is_null($this->modDevenir)) { //charger le modèle Devenir
            $this->modDevenir = $this->loadModel('Devenir');
        }
        
        if (is_null($this->modPromotion)) { //charger le modèle Promotion
            $this->modPromotion = $this->loadModel('Promotion');
        }
        
        if (is_null($this->modUser)) { //charger le modèle Eleve
            $this->modUser = $this->loadModel('User');
        }
        
        if (is_null($this->modEleve)) { //charger le modèle Eleve
            $this->modEleve = $this->loadModel('Eleve');
        }
        
        $this->modUserEleve = $this->loadModel('UserEleve');
        
        $this->modContact = $this->loadModel('Contact');
        
        
        $d['devenirs'] = $this->modDevenir->find(array('conditions' => 1)); //utilisé dans le foreach d'affichage
        $d['promotions'] = $this->modPromotion->find(array('conditions' => 1)); //conditions : le where (ici, pas de restriction) = pareil que si on ne met rien dans le find()
        $d['eleves'] = $this->modEleve->find(array('conditions' => 1));
        $d['users'] = $this->modUser->find(array('conditions' => 1));
        $d['lecodepromo']='';
        $d['loption']='';
        $d['lusereleve']='';
        $d['ledevenir']='';
        
        //récupérer les données du 1er formulaire
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
        } //fin isset submit 1
        
        if(isset($_POST['submit2'])){//on prélève les données du 2e formulaire
            $international=null;
            $code_etudiant=$_POST['code_etudiant'];
            
            $date_contact=$_POST['date_contact'];
            $info_devenir=$_POST['info_devenir'];

            if(isset($_POST['international'])){
                $international=$_POST['international'];
            }
            $precisions=$_POST['precisions'];

            echo 'code étudiant : ', $code_etudiant ,'<br>';
            echo 'date contact : ', $date_contact ,'<br>';
            echo 'info dev : ', $info_devenir ,'<br>';
            echo 'international :' , $international ,'<br>';
            echo 'precisions : ' , $precisions ,'<br>';
            
            $d['lusereleve']= $code_etudiant ; //pour le selected etudiant
            $d['ledevenir']=$info_devenir;
            
            $tab_col_contact= array('u_code','co_date','co_informations','co_international','co_precisions') ; //nom des colonnes de la table contact
            $tab_contact= array($code_etudiant,$date_contact,$info_devenir,$international,$precisions) ; //nom des données entrées

            $modContact=$this->loadModel('Contact');
            $modContact->insertAI($tab_col_contact,$tab_contact);
                        
        } //fin isset submit 2
        
        
        
        //faire un where :
        //$d['eleves'] = $this->modEleve->find(array('conditions' => array('el_option'=>$opt, 'el_date_naissance'=>$el_date_nais)   ));
        

        $this->set($d);
    }
    
    
    function consulter_stat(){
        
    }
    
    
    function modifier_contact($id){//paramètre $id
        /*
        
        $clef=array();
        $clef['codetruc']=$codetruc;
        
        $tab=array();
        $tab['clef']=$clef;
        $tab['donnees']=$donnees;
        
        $modTruc->update($tab);
        
        $d['truc']=donnees;
        
         * 
         */
        
        //$this->set($d);
    }
    
    
    //méthode déjà dans la classe mère, contenu différent
    //pour ajouter un contact on utilise la même vue que pour modifier un contact
    //l'intérêt de modifier la méthode fille render est de ne pas réécrire une vue
    function render($view) {
        if($view=='modifier_contact'){
            parent::render('ajouter_contact');
        }
        else{
            parent::render($view); //$view='ajouter_contact' par exemple
        }
    }
    
    
}