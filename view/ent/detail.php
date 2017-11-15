
<?php $title_for_layout = $entreprise->e_nom ?>
<form class="form-horizontal" method="post" action="entreprises/devenir/ent/modifier/<?= $entreprise->e_code ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Entreprise</legend>
        <?php
        if ($role == 'admin') {
            include 'formEntreprise.php';
        } else {
            include 'affichEntreprise.php';
        }
        ?>

        <!-- Button -->
        <div class="form-group <?= $role ?>">
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Modifier</button>
            </div>
        </div>
    </fieldset>
</form>
<!-- les commentaires -->
<table class="table table-bordered table-condensed table-striped" id="liste_com">
    <thead>
        <tr>
            <th>Auteur</th>
            <th>Date</th>
            <th>Commentaire</th>
            <th>Type</th>
        </tr>
    </thead>
    <?php foreach ($commentaires as $c): ?>
        <tr>

            <td><?= $c->c_login ?></td>
            <td><?= $c->c_dateheure ?></td>
            <td><?= $c->c_texte ?></td>
            <td><?= $c->c_type ?></td>
        </tr>

    <?php endforeach; ?>
</table>
<form class="form-horizontal" method="post" action="entreprises/devenir/ent/ajoutcom/<?= $entreprise->e_code ?>">
    <fieldset>

        <!-- Form Name -->
        <?php include 'formCommentaire.php' ?>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="ajout"></label>
            <div class="col-md-4">
                <button id="ajout" name="singlebutton" class="btn btn-info">Ajout</button>
            </div>
        </div>
    </fieldset>
</form>