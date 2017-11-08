<?php

function dateShowYear($date){//méth. qui permet de montrer l'année d'un 2017-05-01 : renvoie un int 2017
    $tab_date=explode('-',$date);
    $year=intval($tab_date[0]);
    return $year;
}


function verifDateY_m_d($date){//méth. pour vérifier validité date fiche contact
    $valid=TRUE; //initialisation   
    
    $date=str_replace(' ','',$date); //on enlève tous les espaces potentiels
    //$date=trim($date); //inutile si on enlève éjà tous les espaces
    
    //si la chaîne contient un '-'
    if(stristr($date, '-')){
        $tableau_date=explode('-',$date); //on explose la chaîne avec le délimiteur -

        $nb_indices_tab=count($tableau_date); //on vérifie qu'il y a bien 3 morceaux
        //echo $nb_indices_tab;
        //on teste si le nombre d'indices est bien égal à 3
        if ($nb_indices_tab <> 3) {
            $valid=FALSE;
        }
        else{
            //on crée les 3 variables
            list($annee, $mois, $jour)=explode('-',$date);
            
            if($tableau_date=='' || $annee<=1930 || ($annee>date('Y')) || $mois<1 || $mois>12 || $jour<1 || $jour>31 || $annee>2330){
                $valid=FALSE;
            }
        }  
    }
    else{ //la chaîne ne contient pas de '-'
        $valid=FALSE;
    }
    
    //si date entrée supérieure à date du jour
    $date_du_jour=date("Y-m-d");
    
    $jour_actuel = date("j");
    $mois_actuel = date("n");
    $annee_actuelle = date("Y");
 

    if( $date > $date_du_jour ){ //si la date entrée est supérieure à la date du jour
        $valid=FALSE;
        //echo 'Date supérieure à date actuelle...'; //OK
    }

    
    if ($valid){//==TRUE
        //$d = DateTime::createFromFormat('Y-m-d', $date);
        //echo 'Date valide';
        //return $d && $d->format('Y-m-d') === $date;
        return $date;
    }
    else {
        throw new Exception('Date incorrecte : ' . $date);
    }
}



//Enlever les espaces en début/fin de chaîne + vérifier longueur
function nettoyer($string,$long){
    if( (strlen($string))<$long  ){
        //$string=addslashes($string); //caractère d'échappement pour apostrophe
        $string=ltrim($string);
        return $string;
    }
    else{
        throw new Exception("Chaîne trop longue. Limitée à $long caractères.");
    }  
}



function Rec($text)
{
          $text = htmlspecialchars(trim($text), ENT_QUOTES);
          if (get_magic_quotes_gpc() === 1)
          {
                    $text = stripslashes($text);
          }

          $text = nl2br($text);
          return $text;
}

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
          $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
          return (($value === 0) || ($value === false)) ? false : true;
}