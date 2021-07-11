<!--START HTML-->
<div id="menu" class="row">
    <div class="col-md-6 text-center">
        <h4 id="titre_map" class="" style="display: inline-block">Proportion de la population ayant reçu une dose :</h4>
        <div id="carte" style="margin-top:20px;">
            <?php include(__DIR__ . '/carteRegionSvg.php'); ?>
        </div>
    </div>
    <div class="col-md-6" style="" id="donneesRegions">
        <div id="region-graphique">
            <div id="region-general">
                <h4 id="titre_map" class="" style="display: inline-block"> Nombre de personnes ayant reçu une dose :</h4>
                <div class="chart-container" style="margin-top: 20px; position: relative; height:50vh; width:100%">
                    <canvas id="chartRegions" style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:none;">
    <select multiple="multiple" name="regions_list_choice" id="listeRegions" class="select2">
        <option data-num="84" value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
        <option data-num="27" value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
        <option data-num="53" value="Bretagne">Bretagne</option>
        <option data-num="24" value="Centre">Centre</option>
        <option data-num="94" value="Corse">Corse</option>
        <option data-num="44" value="Grand Est">Grand Est</option>
        <option data-num="01" value="Guadeloupe">Guadeloupe</option>
        <option data-num="03" value="Guyane">Guyane</option>
        <option data-num="32" value="Hauts-de-France">Hauts-de-France</option>
        <option data-num="11" value="Ile-de-France">Ile-de-France</option>
        <option data-num="04" value="La Réunion">La Réunion</option>
        <option data-num="02" value="Martinique">Martinique</option>
        <option data-num="06" value="Mayotte">Mayotte</option>
        <option data-num="28" value="Normandie">Normandie</option>
        <option data-num="75" value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
        <option data-num="76" value="Occitanie">Occitanie</option>
        <option data-num="52" value="Pays de la Loire">Pays de la Loire</option>
        <option data-num="93" value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
    </select>
</div>
<!--END HTML-->

<!--BLOC CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<!--link href="carte.css" rel="stylesheet"/> -->

<?php include(__DIR__ . '/carteRegionCss.php') ?>

<!--ENDBLOC JS -->
<!--BLOC JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"
        integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>

<!--<script src="carte.js"></script> -->
<?php include(__DIR__ . '/carteRegionJs.php') ?>

<script id="regionTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroRegion" data-type="region-detail" data-num="numeroRegion" data-nom="nomRegion" class="region">
        <div class="col-md-12 shadow">
            <h2 style="margin-top: 5px;">
                nomRegion
                <a class="masquerRegion pull-right" href="#">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </a>
            </h2>
            <span style="font-size: 160%; color: black"><b>vaccinesRegion</b></span><br>
            <span><b>Nombre de personnes partiellement vaccinées</b><br>
                Nombre cumulé des personnes ayant reçu au moins une dose. Donc vaccinesPopReg% des habitants ont reçu une dose.
            <br></span>
            <span style="font-size: 70%;">Mise à jour : dateMajDoses</span>

            <!-- wp:spacer {"height":50} -->
            <div style="height:15px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <span style="font-size: 160%; color: black"><b>dosesReceptionneesRegion</b></span><br>
            <span><b>Nombre de doses réceptionnées</b><br>
                Nombre cumulé de doses réceptionnées.
            <br></span>
            <span style="font-size: 70%;">Mise à jour : dateMajRec</span>

            <!-- wp:spacer {"height":50} -->
            <div style="height:15px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <div id="region-graphique-detail">
                <div class="chart-container" style="position: relative; height:250px; width:100%">
                    <canvas id="chartRegionDetail"
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
