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
        
        /*
        if (empty($d['devenir'])) {
            $this->e404('Page introuvable');
        }*/

        $this->set($d);
    }
    
    function ajouter_promo(){
        
    }
    
    function consulter_stat(){
        
    }
    
    
    
    
}