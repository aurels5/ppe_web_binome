<?php

function dateShowYear($date){//méth. qui permet de montrer l'année d'un 2017-05-01 : renvoie un int 2017
    $tab_date=explode('-',$date);
    $year=intval($tab_date[0]);
    return $year;
}

    
function verifDateY_m_d($date){//méth. pour vérifier validité date fiche contact
    $valid=TRUE; //initialisation   
    //on explose la chaîne avec le délimiteur -
    $tableau_date=explode('-',$date);
    list($annee, $mois, $jour)=explode('-',$date);
    if($tableau_date=='' || $annee<=1930 || ($annee>date('Y')) || $mois<1 || $mois>12 || $jour<1 || $jour>31){
        $valid=FALSE;
    }
    else{
        $nb_indices_tab=count($tableau_date);
        //on teste si le nombre d'indices est bien égal à 3
        if ($nb_indices_tab <> 3) {
            $valid=FALSE;
        }
    }  
    if ($valid){//==TRUE
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    else {
        throw new Exception('Date incorrecte : ' . $date);
    }
}
    
