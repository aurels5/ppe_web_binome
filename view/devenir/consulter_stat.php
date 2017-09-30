<h3>Consulter les statistiques</h3>
<small>Ces statistiques concernent le Lycée Merleau-Ponty exclusivement.</small>

<br>
<h4>Pour une promotion en particulier</h4>

<!-- Choix de la promotion pour afficher les stat -->
<select class="form-control input">
<?php foreach($promos as $p):?>
    <option value="<?= $p->codepromo ?>"><?= $p->date_debut .' à '. $p->date_fin ?></option>
<?php endforeach; ?>
</select>


<!-- affichage stat sur les infos pour * les élèves --> 
<h4>Pour toutes les promotions de BTS SIO</h4>

<!-- aff %tage d'élèves en CDD ou CDI après BTS-->