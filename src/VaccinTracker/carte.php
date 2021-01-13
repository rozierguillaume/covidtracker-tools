<h2 style="margin-top : 80px;">Répartition des vaccinés</h2>
Coloration en fonction du pourcentage de population vaccinée. Données fournies par le Ministère de la Santé. Cliquez sur une région pour afficher plus de détail.
<!--START MAP-->

<!--START JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

<?php include(__DIR__ . '/carteScripts.php'); ?>
<?php include(__DIR__ . '/carteStyles.php'); ?>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!--END JS-->


<!--START HTML-->

<div id="menu" class="row">
    <div class="col-md-6 text-center">
    <span id="titre_map" style="display: inline-block">Pourcentage de la population vaccinée :</span>
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
<!--                <option data-num="06" value="Mayotte">Mayotte</option>-->
                <option data-num="28" value="Normandie">Normandie</option>
                <option data-num="75" value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                <option data-num="76" value="Occitanie">Occitanie</option>
                <option data-num="52" value="Pays de la Loire">Pays de la Loire</option>
                <option data-num="93" value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
            </select>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div id="carte">
                    <?php include(__DIR__ . '/carteSvg.php'); ?>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-5" style="padding-top: 0px;" id="donneesRegions">
    Nombre de personnes ayant reçu une dose :
        <div class="chart-container" style="position: relative; height:50vh; width:100%">
            <canvas id="chartRegions" style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
        </div>
    </div>
</div>



<!--END MAP-->
