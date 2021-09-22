<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

<?php include(dirname(__FILE__) . '/indexJs.php') ?>
<?php include(dirname(__FILE__) . '/indexCss.php') ?>

<p>Le gouvernement a annoncé le relachement de certaines mesures comme le port du masque à l'école élémentaire dans les territoires où le taux d'incidence resterait inférieur à 50 pendant plusieurs jours. Quels sont les départements où le taux d'incidence reste inférieur à 50 ? Cet outil sera mis à jour quotidiennement avec les données du Ministère de la Santé. Dernière mise à jour : 22/09.</p>

<h2 style="margin-top : 80px;">
    Départements où l'incidence est inférieure à 50
</h2>


<div class="" style="margin-bottom: 40px;">
    <p>Le taux d'incidence correspond au nombre de nouveaux cas de Covid19 détectés en une semaine, rapporté à 100 000 habitants de chaque territoire.
        La deuxième carte est une projection en prenant comme hypothèse un taux de croissance du nombre de cas qui n'évolue pas.
    Données fournies par le Ministère de la Santé.</p>
</div>

<br>

<div id="menu" class="row">
    <div class="col-md-6 text-center">
        <div class="row">
            <h3 id="titre_map" class="" style="display: inline-block">Aujourd'hui (J-3) :</h3><br>
            <b><span id="nb_dep_incid_inf_50" style="font-size: 18px;">--</span></b> départements ont une incidence inférieure à 50
            <div class="col-xs-10">
                <div id="carteEHPAD1Dose" style="margin-top:20px;">
                    <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
                </div>
            </div>
            <div id="legendeCarteAujourdhui" class="col-xs-2">

            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <h3 id="titre_map" class="" style="display: inline-block">Dans 7 jours si évolution constante :</h3><br>
        <b><span id="nb_dep_incid_inf_50_pred" style="font-size: 18px;">--</span></b> départements auraient une incidence inférieure à 50
        <div class="col-xs-10">
            <div id="carteEHPAD2Doses" style="margin-top:20px;">
                <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
            </div>
        </div>
        <div id="legendeCartePrediction" class="col-xs-2">

        </div>
    </div>
</div>

Sélectionnez un département sur la carte.
<br>

<div style="border: 1px solid;  max-width: 1000px; border-radius: 7px; padding: 10px; margin-bottom: 40px;">
    <h2 id="nom_departement"></h2>

  <br>
  <span id="chart"></span>
  <div>
    <canvas id="lineCasChart" style="max-height: 700px; max-width: 900px;"></canvas>
</div>
