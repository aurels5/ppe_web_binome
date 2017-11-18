<script src='<?php echo BASE_SITE . '/js/jquery.js' ?>' ></script>
<!DOCTYPE html>

<!--test sur les téléphones portables -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Gestion des entreprises'; ?></title>
        <link href='<?php echo BASE_SITE . DS . '/css/bootstrap/css/bootstrap.css' ?>' rel="stylesheet">
        <link href='<?php echo BASE_SITE . DS . '/css/style.css' ?>' rel="stylesheet">

        <style type="text/css">
            /* Style pour l'exemple*/

        </style>
    </head>
    <body class="container">
        <div class="topbar">
            <div class="topbar-inner">
                <div class="container">
                    <h2><a href="#">Module devenir</a></h2>
                    <ul class="nav">
                       
                    </ul>
                </div>
            </div>
        </div>

        <header>
            <div class="row hidden-xs" id="header_img"></div>
            <h1 class="row"> BTS SIO Gestion des entreprises partenaires</h1>
        </header>
        
        <?php if (Session::get('login') == 'exterieur'): ?>
            <div class="navbar navbar-default">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= BASE_URL ?>/ent/liste"> Accueil</a></li>
                    <li ><a href="<?= BASE_URL ?>/devenir/consulter_stat">Statistiques</a></li>
                    <li ><a href="<?= BASE_URL ?>/devenir/contact">Contact</a></li>
                    <li><a href="<?= BASE_URL ?>/user/logout">Déconnexion</a></li>
                </ul>
            </div>
        <?php elseif (Session::get('login') == 'prof'): ?>
            <div class="navbar navbar-default">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= BASE_URL ?>/ent/liste"> Accueil</a></li>
                    <li ><a href="<?= BASE_URL ?>/ent/nouveau">Nouvelle Entreprise</a></li>
                    <li ><a href="<?= BASE_URL ?>/devenir/fiche_contact">Ajouter contact étudiant</a></li>
                    <li ><a href="<?= BASE_URL ?>/devenir/modifier_contact">Modifier contact étudiant</a></li>
                    <li ><a href="<?= BASE_URL ?>/devenir/consulter_stat">Statistiques</a></li>
                    <li><a href="<?= BASE_URL ?>/user/logout">Déconnexion</a></li>
                    <!-- pas de page contact -->
                </ul>
            </div>
        <?php elseif (Session::get('login') == 'etu'): ?>
            <div class="navbar navbar-default">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= BASE_URL ?>/ent/liste"> Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>/ent/nouveau">Nouvelle Entreprise</a></li>
                    <!--pas accès à ajouter contact étudiant ni modifier contact étudiant -->
                    <li><a href="<?= BASE_URL ?>/devenir/consulter_stat">Statistiques</a></li>
                    <li><a href="<?= BASE_URL ?>/devenir/contact">Contact</a></li>
                    <li><a href="<?= BASE_URL ?>/user/logout">Déconnexion</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <section class="col-lg-10">
            <?= $content_for_layout ?>
        </section>
    </div> 

    
    <script src='<?php echo BASE_SITE . '/js/jquery.dataTables.min.js' ?>' ></script>
    <script src='<?php echo BASE_SITE . '/css/bootstrap/js/bootstrap.min.js' ?>' ></script>
    <script src='<?php echo BASE_SITE . '/css/bootstrap/js/dataTables.bootstrap.min.js' ?>' ></script>
    <script src='<?php echo BASE_SITE . '/js/verifications.js' ?>' ></script>
    <script type="text/javascript">
        $(function () {
            $('#liste_ent').dataTable();
        });
    </script>

</body>
</html>
