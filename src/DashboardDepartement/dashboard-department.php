<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php include(dirname(__FILE__) . '/dashboardDepartementsCSS.php') ?>
<?php include(dirname(__FILE__) . '/dashboardDepartementsJs.php') ?>

<div class="alert alert-info clearFix" style="font-size: 18px; margin-top:10px; margin-bottom:40px;">
    <div class="row">
        <div class="col-md-8">
            <small>NOUVEAU !</small>
            <br>
            <b>Explorez les données avec CovidExplorer</b>
            <br>
            Comment évolue le taux d'incidence dans votre département par rapport à votre région ? Quelle est la courbe des hospitalisations en France ?...<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow btn-autre">
                <a href="https://covidtracker.fr/covidexplorer" target="_blank" rel="noreferrer noopener">Accéder à 🔎
                    <b>CovidExplorer</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>


<?php
if (isset($_GET['dep']) and $_GET['dep']) {
    $department = $_GET["dep"];
    if (is_numeric($department) || $department == "2A" || $department == "2B") {
        echo('<script id="numeroDepartementSearched" type="text/template">' .$department . '</script>');
    }
}
?>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<div id="donneesDepartements"></div>

<script id="departementTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroDepartement" data-num="numeroDepartement" data-nom="nomDepartement" class="departement">
        <h2>
            numeroDepartement - nomDepartement
            <a class="masquerDepartement pull-right" href="#">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </a>
        </h2>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="shadow">
                    <span style="font-size: 160%; color: couleurIncidence"><b>incidenceDepartement</b></span><br>
                    <span><b>Taux d'incidence</b><br>
                Nombre de cas sur 7 jours pour 100k habitants. L'incidence moyenne en France est incidenceFrance, et le seuil d'alerte 50.<br></span>
                    <span style="font-size: 70%;">Mise à jour : dateMaj</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="shadow">
                    <span style="font-size: 160%; color: couleurSaturationRea"><b>saturationRea</b></span><br>
                    <span><b>Tension hospitalière</b>
                <br>Si supérieur à 100%, alors les patients Covid19 occupent plus de lits de réanimation qu'il n'y en avait avant l'épidémie.</span><br>
                    <span style="font-size: 70%;">Mise à jour : dateMaj</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="shadow">
                    <span style="font-size: 160%; color: couleurTauxPositivite"><b>tauxPositivite</b></span><br>
                    <span><b>Taux de positivité</b>
                <br>Proportion de tests positifs dans l'ensemble des tests. Un chiffre bas peut être dû à une faible circulation du virus ou à un testing massif.</span><br>
                    <span style="font-size: 70%;">Mise à jour : dateMaj</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="shadow">
                    <span style="font-size: 160%; color: couleurTauxPositivite"><b>n_dose1_cumsum_pop</b></span><br>
                    <span><b>Taux de vaccination</b>
                <br>Proportion de personnes ayant reçu une dose de vaccin.</span><br>
                    <span style="font-size: 70%;">Dernière donnée : dateVaccinationMaj</span>
                </div>
            </div>
        </div>

        <h3 style="margin-top: 40px;">Vue d'ensemble</h3>
        <p>Ces quatre graphiques permettent d'évaluer l'épidémie dans le département. Le nombre de cas correspond à
            l'activité du virus. Le nombre d'hospitalisations, de réanimations et de décès hospitaliers permettent de
            mesurer la crise sanitaire.</p>
        <div class="row">
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/cas_journ_nomDepartement.jpeg"
                   target="_blank" rel="noopener noreferrer">
                    <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/cas_journ_nomDepartement.jpeg"
                         width="100%" style="max-width: 1000px;">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/hosp_journ_nomDepartement.jpeg"
                   target="_blank" rel="noopener noreferrer">
                    <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/hosp_journ_nomDepartement.jpeg"
                         width="100%" style="max-width: 1000px;">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/rea_journ_nomDepartement.jpeg"
                   target="_blank" rel="noopener noreferrer">
                    <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/rea_journ_nomDepartement.jpeg"
                         width="100%" style="max-width: 1000px;">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dc_journ_nomDepartement.jpeg"
                   target="_blank" rel="noopener noreferrer">
                    <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dc_journ_nomDepartement.jpeg"
                         width="100%" style="max-width: 1000px;">
                </a>
            </div>
        </div>

        <h3 style="margin-top: 40px;">Nombre de variants</h3>
        <p>Estimation du nombre de chaque variants dans les cas détectés. L'estimation est réalisée à partir de la proportion de chaque variants dans les tests positifs criblés, et du nombre total de tests positifs.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/variants_nombre_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/variants_nombre_nomDepartement.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>

        <h3 style="margin-top: 40px;">Incidence par tranche d'âge</h3>
        <p>Le taux d'incidence correspond au nombre de cas cumulé sur 7 jours rapporté à 100 000 habitants du
            département. Cet indicateur représente l'activité épidémique du virus. Le seuil d'alerte est de 50.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_deps/heatmap_taux_numeroDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_deps/heatmap_taux_numeroDepartement.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>
        <h3 style="margin-top: 40px;">Flux hospitaliers</h3>
        <p>Ce graphique présente l'évolution des entrées et sorties de l'hôpital pour motif Covid19.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/hosp_journ_flux_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/hosp_journ_flux_nomDepartement.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>
        <h3 style="margin-top: 40px;">Tension hospitalière</h3>
        <p>Ce graphique présente la proportion de lits de réanimation occupés uniquement par les patients Covid19, par
            rapport au nombre de lits en temps normal (fin 2018, étude de la DREES).</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/saturation_rea_journ_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/saturation_rea_journ_nomDepartement.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>
        <!-- wp:spacer {"height":50} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        <p><a href="#menu">Haut de page</a></p>
    </div>
</script>

<script id="legendTemplatePre" type="text/template">
    <table>
        <tbody>
</script>

<script id="legendTemplateMid" type="text/template">
    <tr>
        <td style="text-align: center; background-color: colorBg; color: white; font-size: 50%; padding: 5px;">valeur
        </td>
    </tr>
</script>

<script id="legendTemplatePost" type="text/template">
    </tbody>
    </table>
</script>

