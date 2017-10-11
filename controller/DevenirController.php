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
        
        $d['devenirs'] = $this->modDevenir->find(array('conditions' => 1)); //utilisé dans le foreach d'affichage
        $d['promotions'] = $this->modPromotion->find(array('conditions' => 1));
        $d['eleves'] = $this->modEleve->find(array('conditions' => 1));
        $d['users'] = $this->modUser->find(array('conditions' => 1));
        
        //faire un where :
        //$d['trucs'] = $this->modTruc->find(array('conditions' => array('codetruc'=>$codetruc, 'nomtruc'=>$nomtruc)   ));
        
        //$d['eleves'] = $this->modEleve->find(array('conditions' => array('el_option'=>$opt, 'el_date_naissance'=>$el_date_nais)   ));
        
        
        //$d['eleves'] = $this->modEleve->find(array(
        //   'conditions' => array('e_code' => $id)
        //));
        
        /*
        if (empty($d['devenir'])) {
            $this->e404('Page introuvable');
        }*/

        $this->set($d);
    }
    
    
    function consulter_stat(){
        
    }
    
    
    function modifier_contact($id){//paramètre $id
        
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
        
        $d['devenirs'] = $this->modDevenir->find(array('conditions' => 1)); //utilisé dans le foreach d'affichage
        $d['promotions'] = $this->modPromotion->find(array('conditions' => 1));
        $d['eleves'] = $this->modEleve->find(array('conditions' => 1));
        $d['users'] = $this->modUser->find(array('conditions' => 1));
        
        
        /*
        $code_truc= $id[0];
        $modTruc= $this->loadModel('Truc');
        $donnees=array();
        $donnees['nomtruc']=$_POST['nomtruc'];
        $donnees['codetruc']=$_POST['codetruc'];
        $donnees['autretruc']=$_POST['autretruc'];
        $donnees['encoretruc']=$_POST['encoretruc'];
        
        $clef=array();
        $clef['codetruc']=$codetruc;
        
        $tab=array();
        $tab['clef']=$clef;
        $tab['donnees']=$donnees;
        
        $modTruc->update($tab);
        
        $d['truc']=donnees;
        $this->set($d);
         * 
         */
    }
    
    
    //méthode déjà dans la classe mère, contenu différent
    //pour ajouter un contact on utilise la même vue que pour modifier un contact
    //l'intérêt de modifier la méthode fille render est de ne pas réécrire une vue
    function render($view) {
        if($view=='modifier_contact'){
            $view='ajouter_contact';
        }
        else{
            parent::render($view); //$view='ajouter_contact' par exemple
        }
    }
    
    
}