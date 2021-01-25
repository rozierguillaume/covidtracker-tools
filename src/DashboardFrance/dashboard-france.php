<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php include(dirname(__FILE__) . '/dashboardFranceJs.php') ?>
<?php include(dirname(__FILE__) . '/dashboardFranceCss.php') ?>


<b>
    CovidTracker France permet de suivre l’épidémie de Coronavirus et la maladie associée, le Covid19, en France et dans ses régions.
</b>
<br>
Les données sont issues de Santé Publique France et l’INSEE. <i>Mise à jour des graphiques : automatique vers 19h30.</i>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<div class_perso="">
    <div>
        <h2 id="hosp">---</h2>
        <div id="hosp_descr" style="font-size: 15px;">personnes hospitalisées<br>soit --- le --/--</div>
    </div>
    <div>
        <h2 id="rea">---</h2>
        <div id="rea_descr" style="font-size: 15px;">personnes en réanimation<br>soit --- le --/--</div>
    </div>
    <div>
        <h2 id="dc_new">---</h2>
        <div id="dc_new_descr" style="font-size: 15px;">nouveaux décès hospitaliers le --/--</div>
    </div>
    <div>
        <h2 id="cas_last7">---</h2>
        <div id="cas_last7_descr" style="font-size: 15px;">cas positifs sur les 7 derniers jours (--/--)</div>
    </div>
</div>


<?php include(__DIR__ . '/vueDEnsemble.php') ?>
<?php include(__DIR__ . '/activite.php') ?>
<?php include(__DIR__ . '/indicateursEpidemiques.php') ?>
<?php include(__DIR__ . '/hospitalisationsEtReanimations.php') ?>
<?php include(__DIR__ . '/deces.php') ?>
<?php include(__DIR__ . '/mortalite.php') ?>
<?php include(__DIR__ . '/footer.php') ?>



