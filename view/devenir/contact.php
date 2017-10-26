<!--FORMULAIRE DE CONTACT , un élève peut contacter le système -->

<?php

if (($err_formulaire) || (!isset($_POST['envoi']))) //s'il y a une erreur de remplissage ou si l'user n'a pas appuyé sur envoyer
{
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

