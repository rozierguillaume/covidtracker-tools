<!--START HTML-->
<div id="menu" class="row">
    <div class="col-md-6 text-center">
        <div class="row">
            <h4 id="titre_map" class="" style="display: inline-block">Proportion de la population ayant reçu une dose :</h4>
            <div class="col-xs-10">
                <div style="display:none;">
                    <?php include(dirname(__FILE__) . '/../DashboardDepartement/selectDepartements.php') ?>
                </div>
                <div id="carte" style="margin-top:20px;">
                    <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
                </div>

            </div>
            <div id="legendeCarte" class="col-xs-2">

            </div>

        </div>
        <div class="alert alert-info">
            05 octobre 2021 : attention, depuis ce jour la carte affiche le nombre de personnes vaccinées par lieu de résidence, et non plus par lieu d'injection. Une personne habitant à Paris et vaccinée dans les Yvelines est désormais comptabilisée à Paris.
        </div>
    </div>
    <div class="col-md-6" style="" id="donneesDepartements">
    </div>
</div>

<?php include(dirname(__FILE__) . '/carteDepartementCss.php') ?>
<?php include(dirname(__FILE__) . '/carteDepartementJs.php') ?>

<script id="departementTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroDepartement" data-type="departement-detail" data-num="numeroDepartement" data-nom="nomDepartement" class="departement-detail">
        <div class="col-md-12 shadow">
            <h2 style="margin-top: 5px;">
                nomDepartement
                <a class="masquerDepartement pull-right" href="#">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </a>
            </h2>
            <span style="font-size: 160%; color: black"><b>vaccinesDepartement</b></span>%<br>
            <span>
                <b>Personnes ayant reçu une dose</b><br>
                Proportion cumulée de personnes ayant reçu au moins une dose de vaccin.
            <br></span>
            <span style="font-size: 70%;">Mise à jour : dateMajDoses</span>

            <!-- wp:spacer {"height":50} -->
            <div style="height:15px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->


            <div id="departement-graphique-detail">
                <div class="chart-container" style="position: relative; height:250px; width:100%">
                    <canvas id="chartDepartementDetail"
                            style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
            </div>
            <br>
            <div id="departement-graphique-age" style="display: none">
                <div class="chart-container" style="position: relative; height:250px; width:100%">
                    <canvas id="chartDepartementAge"
                            style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
            </div>
            © CovidTracker.fr - Données : Ministère de la Santé
        </div>
        <!-- wp:spacer {"height":50} -->
        <div style="height:5px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

    </div>
</script>
<!--END JS-->
