<?php

/**
 * Description of DevenirController
 *
 * @author Sarradin
 * 
 * contrôleur pour le module devenir de l'application entreprises
 */

class DevenirController extends Controller {
    
    private $modDevenir = null; //modèle devenir
    private $modInfoDevenir = null;

    
    
    function ajouter_contact(){
        
        if (is_null($this->modDevenir)) {
            $this->modDevenir = $this->loadModel('Devenir');
        }
        
        $d['devenirs'] = $this->modDevenir->find(array('conditions' => 1));
        
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