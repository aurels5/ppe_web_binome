<!--FORMULAIRE DE CONTACT , un élève peut contacter le système -->

<?php

if (($err_formulaire) || (!isset($_POST['envoi']))) //s'il y a une erreur de remplissage ou si l'user n'a pas appuyé sur envoyer
{
    echo '<p>Etudiant post BTS SIO, votre devenir nous intéresse à des fins statistiques. '
    . 'Veuillez nous préciser de préférence : la promotion dans laquelle vous étiez, l\'option '
            . 'que vous aviez choisie, vos Nom/Prénom, vos nouvelles conditions de vie '
            . '(CDI, CDD, Chômage, Poursuite d\'études, Changement de voie), '
            . 'votre situation en France ou à l\'international, et d\'éventuelles précisions. '
    . '</p>';
    
    // afficher le formulaire
    echo '
    <form id="contact" method="post" action="'.$form_action.'">
    <fieldset><legend>Vos coordonnées</legend>
              <p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /></p>
              <p><label for="email">Email :</label><input type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /></p>
    </fieldset>

    <fieldset><legend>Votre message :</legend>
              <p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /></p>
              <p><label for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea></p>
    </fieldset>

    <div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer" /></div>
    </form>';
}
?>

<!--fin formulaire contact-->	

