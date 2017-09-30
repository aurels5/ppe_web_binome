<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntController
 *
 * @author travail
 */
class EntController extends Controller {

    private $modEntreprise = null;
    private $modType_Entreprise = null;
    private $modCommentaire = null;

//put your code here
    function liste() {

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }


        $d['entreprises'] = $this->modEntreprise->find(array('conditions' => 1));
        if (empty($d['entreprises'])) {
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        $this->set($d);
    }

    function detail($id) {
        $id = $id[0];

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprise'] = $this->modEntreprise->findFirst(array(
            'conditions' => array('e_code' => $id)
        ));
        if (empty($d['entreprise'])) {
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $d['commentaires'] = $this->modCommentaire->find(array(
            'conditions' => array('e_code' => $id)
        ));
        $this->set($d);
    }

    function supprimer($id) {
        $id = $id[0];
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $this->name->delete(array(
            'conditions' => array('e_code' => $id)
        ));
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $this->name->delete(array(
            'conditions' => array('e_code' => $id)
        ));
//on réaffiche la liste des entreprises
        $this->liste();
    }

    function ajoutcom($id) {
        $id = $id[0];
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $colonnes = array('c_login', 'c_dateheure', 'c_texte', 'c_type', 'e_code');
        $donnees = array(SESSION::get('login'), date('y/m/d G:i:s'), $_POST['c_texte'], $_POST['c_type'], $id);

        $c_code = $this->modCommentaire->insertAI($colonnes, $donnees);


        $d['commentaires'] = $this->modCommentaire->find(array(
            'conditions' => array('e_code' => $id))
        );

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprise'] = $this->modEntreprise->findFirst(array(
            'conditions' => array('e_code' => $id)
        ));
        if (empty($d['entreprise'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
    }

    function modifier($id) {
        $id = $id[0];
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }

        $donnees = array();
//on n'envoie pas à la méthode update que les boutons où autres      
        foreach ($_POST as $k => $v) {
            if ($k != 'singlebutton') {
                $donnees[$k] = $v;
            }
        }

        $tab = array();
        $tab = array(
            'cle' => array('e_code' => $id),
            'donnees' => $donnees);

        $this->modEntreprise->update($tab);


//on réaffiche la liste des entreprises

        $this->liste();
    }

    function nouveau() {

        $d['entreprise'] = null;


        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );

        $this->set($d);
    }

    function creer() {

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }

        $donnees = array();
        $colonnes = array();
//on n'envoie pas à la méthode insert  les boutons où autres      
        foreach ($_POST as $k => $v) {
            if ($k != 'singlebutton') {
                $donnees[] = $v;
                $colonnes[] = $k;
            }
        }
        $donnees[] = SESSION::get('login');
        $colonnes[] = 'e_login';


        $id = $this->modEntreprise->insertAI($colonnes, $donnees);
  //on réaffiche l'entreprise crée
        $this->detail( array( $id));
      

    }

    function render($view) {
        if ($view === 'supprimer' || $view === 'modifier') {
            parent:: render('liste');
        } elseif ($view == 'creer' || $view == 'ajoutcom') {
            parent:: render('detail');
        } else {
            parent:: render($view);
        }
    }

}
