<h2 style="margin-top : 80px;">
    Vaccination en EHPAD
</h2>
<?php include(__DIR__ . '/vaccinatinEHPADJs.php') ?>

<div class="" style="margin-bottom: 40px;">
    Coloration en fonction du pourcentage de personnes hébergées en EPHAD vaccinées.
    Données fournies par le Ministère de la Santé.
</div>

<br>

<div id="menu" class="row">
    <div class="col-md-6 text-center">
        <div class="row">
            <h4 id="titre_map" class="" style="display: inline-block">Proportion de résidents ayant reçu une dose :</h4>
            <div class="col-xs-10">
                <div id="carteEHPAD1Dose" style="margin-top:20px;">
                    <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
                </div>
            </div>
            <div id="legendeCarteEHPAD1Dose" class="col-xs-2">

            </div>
        </div>
        <div class="alert alert-info">
            Attention l'échelle de cette diffère de la carte précédente même si le code couleur utilisé est le même.
        </div>
    </div>
    <div class="col-md-6 text-center">
        <h4 id="titre_map" class="" style="display: inline-block">Proportion de résidents ayant reçu deux doses :</h4>
        <div class="col-xs-10">
            <div id="carteEHPAD2Doses" style="margin-top:20px;">
                <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
            </div>
        </div>
        <div id="legendeCarteEHPAD2Doses" class="col-xs-2">

        </div>
    </div>
</div>
