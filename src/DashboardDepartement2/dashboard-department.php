<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>
<?php		
 if (isset($_GET['dep']) and $_GET['dep']) {		
     echo('<script id="departementSearched" type="text/template">' . $_GET["dep"] . '</script>');		
 }		
 ?>

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
            <div class="col-md-4 shadow">
                <span style="font-size: 160%; color: couleurIncidence"><b>incidenceDepartement</b></span><br>
                <span><b>Taux d'incidence</b><br>
                Nombre de cas sur 7 jours pour 100k habitants. L'incidence moyenne en France est incidenceFrance, et le seuil d'alerte 50.<br></span>
                <span style="font-size: 70%;">Mise à jour : dateMaj</span>
            </div>
            <div class="col-md-4 shadow">
                <span style="font-size: 160%; color: couleurSaturationRea"><b>saturationRea</b></span><br>
                <span><b>Tension hospitalière</b>
                <br>Si supérieur à 100%, alors les patients Covid19 occupent plus de lits de réanimation qu'il n'y en avait avant l'épidémie</span><br>
                <span style="font-size: 70%;">Mise à jour : dateMaj</span>
            </div>
            <div class="col-md-4 shadow">
                <span style="font-size: 160%; color: couleurTauxPositivite"><b>tauxPositivite</b></span><br>
                <span><b>Taux de positivité</b>
                <br>Proportion de tests positifs dans l'ensemble des tests. Un chiffre bas peut être dû à une faible circulation du virus ou à un testing massif.</span><br>
                <span style="font-size: 70%;">Mise à jour : dateMaj</span>
            </div>
        </div>

        <h3 style="margin-top: 40px;">Vue d'ensemble</h3>
        <p>Ces quatre graphiques permettent d'évaluer l'épidémie dans le département. Le nombre de cas correspond à
            l'activité du virus. Le nombre d'hospitalisations, de réanimations et de décès hospitaliers permettent de
            mesurer la crise sanitaire.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dashboard_jour_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dashboard_jour_nomDepartement.jpeg"
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

<script>
    jQuery(document).ready(function ($) {
            $('.dropdown-toggle').dropdown();

            var valeurs_cas = [">", "200", "150", "100", "50"]
            var couleurs_cas = ["#3c0000", "#a00000", "#e20001", "#f95228", "#98ac3b"]

            var valeurs_evolution = [">", "40", "30", "20", "10", "5", "0", "-5", "-10", "-20", "-30", "-40", "-50"];
            var couleurs_evolution = [
                "#4c0000",
                "#6a0000",
                "#f50e07",
                "#fb633b",
                "#fb9449",
                "#fbd763",
                "#b1df52",
                "#61c142",
                "#56ab3d",
                "#2e9c28",
                "#1c7b21",
                "#116522",
                "#084004"];


            var valeurs_hosp = [">", "50", "45", "40", "35", "30", "25", "20", "15", "10", "9", "6", "3"];
            var valeurs_lits_hosp = [">", "90", "80", "70", "60", "50", "40", "30", "25", "20", "15", "10", "5"];
            var couleurs_hosp = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_positivite = [">", "25", "20", "15", "12", "10", "8", "6", "5", "4", "3", "2", "1"];
            var couleurs_positivite = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_rea = [">", "10", "8", "6", "5", "4", "3", "2.5", "2", "1.5", "1", "0.5", "0.25"];
            var valeurs_lits_rea = [">", "25", "20", "17.5", "15", "12.5", "10", "7.5", "5", "4", "3", "2", "1"];
            var couleurs_rea = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_saturation_rea = [">", "300", "250", "200", "180", "150", "120", "100", "80", "60", "40", "20", "10"];
            var couleurs_saturation_rea = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_dc = [">", "12", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1"];
            var couleurs_dc = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var donneesDepartements;
            var donneesFrance;
            var dateMaj;
            var typeCarte = 'incidence-cas';

            fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/incidence_departements.json')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    return response.json();
                })
                .then(json => {
                    donneesDepartements = json['donnees_departements'];
                    donneesFrance = json['donnees_france'];
                    dateMaj = json["date_update"];
                    colorerCarte();
                    selectionnerDepartement();
                });

            /*
             * Le lancement de l'animation se fait en ajoutant et retirant la classe animated
             * de la carte afin que tous les départements clignotent en meme temps.
             * Sans quoi chaqué département commence son clignotement au moment où on lui attribue
             * la classe selected.
             */
            var stopAnimation = function () {
                $("#map").removeClass("animated")
            }

            var startAnimation = function () {
                $("#map").addClass("animated")
            }

            function construireLegende(values = [], colors = [], pourcentage = false) {
                content = $('#legendTemplatePre').html();
                values.map((val, idx) => {
                    if (pourcentage && (val != '>')) {
                        if (val>0){
                            content += $('#legendTemplateMid').html().replaceAll("valeur", '+'+val + ' %').replaceAll("colorBg", colors[idx]);
                        } else {
                            content += $('#legendTemplateMid').html().replaceAll("valeur", val + ' %').replaceAll("colorBg", colors[idx]);
                        }
                    } else {
                        content += $('#legendTemplateMid').html().replaceAll("valeur", val).replaceAll("colorBg", colors[idx]);
                    }
                })
                content += $('#legendTemplatePost').html();
                $('#legendeCarte').html(content);
            }

            function recupererCouleur(valeur, tableauDonnees, tableauCouleurs) {
                for (i = tableauCouleurs.length-1; i > 0; i--) {
                    if (i == 0) {
                        return tableauCouleurs[i];
                    } else if (valeur <= tableauDonnees[i]) {
                        return tableauCouleurs[i];
                    }
                }
                return "#c4c4cb";
            }

            function colorerCarte() {
                pourcentage = false;
                if (typeCarte == 'incidence-cas') {
                    $('#titreCarte').html("Taux d'incidence");
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants");
                    tableauValeurs = valeurs_cas;
                    tableauCouleurs = couleurs_cas;
                    nomDonnee = "incidence_cas";
                } else if (typeCarte == 'evolution-cas') {
                    $('#titreCarte').html("Évolution du nombre de cas sur les 7 derniers jours");
                    $('#descriptionCarte').html("Lecture : du rouge signifie une augmentation du nombre de cas sur les 7 derniers jours par rapport aux 7 jours précédents");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_evol";
                    pourcentage = true;
                } else if (typeCarte == 'taux-positivite') {
                    $('#titreCarte').html("Taux de positivité");
                    $('#descriptionCarte').html("Proportion des tests positifs cette semaine");
                    tableauValeurs = valeurs_positivite;
                    tableauCouleurs = couleurs_positivite;
                    nomDonnee = "taux_positivite";
                } else if (typeCarte == 'incidence-hospitalisations') {
                    $('#titreCarte').html("Admissions à l'hôpital avec Covid19");
                    $('#descriptionCarte').html("cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "incidence_hosp";
                } else if (typeCarte == 'lits-hospitalisations') {
                    $('#titreCarte').html("Nombre de lits occupés à l'hôpital pour Covid19");
                    $('#descriptionCarte').html("pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_hosp";
                } else if (typeCarte == 'evolution-lits-hospitalisations') {
                    $('#titreCarte').html("Évolution du nombre de lits occupés à l'hôpital pour Covid19");
                    $('#descriptionCarte').html("Du rouge signifie une augmentation du nombre de lits occupés par des patients Covid19 à l'hôpital");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_hosp_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-deces') {
                    $('#titreCarte').html("Nombre de décès avec Covid19");
                    $('#descriptionCarte').html("cette semaine pour 100k habitants.");
                    tableauValeurs = valeurs_dc;
                    tableauCouleurs = couleurs_dc;
                    nomDonnee = "incidence_dc";
                } else if (typeCarte == 'evolution-deces') {
                    $('#titreCarte').html("Évolution du nombre de décès");
                    $('#descriptionCarte').html("sur les 7 derniers jours par rapport aux 7 jours précédents");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_dc_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-reanimations') {
                    $('#titreCarte').html("Admissions à l'hôpital avec Covid19");
                    $('#descriptionCarte').html("cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_rea;
                    tableauCouleurs = couleurs_rea;
                    nomDonnee = "incidence_rea";
                } else if (typeCarte == 'saturation-reanimations') {
                    $('#titreCarte').html("Taux d'occupation des lits de réanimation");
                    $('#descriptionCarte').html("uniquement par les paitients Covid19");
                    tableauValeurs = valeurs_saturation_rea;
                    tableauCouleurs = couleurs_saturation_rea;
                    nomDonnee = "saturation_rea";
                } else if (typeCarte == 'lits-reanimations') {
                    $('#titreCarte').html("Nombre de lits de réanimation occupés pour Covid19");
                    $('#descriptionCarte').html("pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_rea;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_rea";
                } else if (typeCarte == 'evolution-lits-reanimations') {
                    $('#titreCarte').html("Évolution du nombre de lits de réanimation occupés pour Covid19");
                    $('#descriptionCarte').html("Du rouge signifie une augmentation du nombre de lits de réanimation occupés par des patients Covid19");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_rea_evol";
                    pourcentage = true;
                } else {
                    $('#carte path').css("fill", "#c4c4cb");
                    return;
                }

                construireLegende(tableauValeurs, tableauCouleurs, pourcentage);

                for (departement in donneesDepartements) {
                    // console.log(departement);
                    //Récupération du numéor de département à partir de la select.
                    numeroDepartement = $('#listeDepartements option[value="' + departement + '"]').data("num");
                    // console.log(numeroDepartement);
                    //Récupération des données du département.
                    donneesDepartement = donneesDepartements[departement];
                    // console.log(donneesDepartement);
                    //Affectation du numéro de département à sa représentation sur la carte. .
                    var departementCarte = $('#carte path[data-num="' + numeroDepartement + '"]');
                    //Affectation de la valeur de la donnée du département à sa représentation sur la carte. .
                    departementCarte.data(nomDonnee, donneesDepartement[nomDonnee]);
                    //Coloration du département sur la carte. .
                    departementCarte.css("fill", recupererCouleur(donneesDepartement[nomDonnee], tableauValeurs, tableauCouleurs));
                
                }
            }

            function selectionnerDepartement(){		
                 if ($("#departementSearched").length>0) {		
                     nomDepartement = $("#departementSearched").text();		
                     if ($("select option[value='" + nomDepartement + "']").length>0){		
                         numeroDepartement = $("select option[value='" + nomDepartement + "']").data('num');		
                         $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');		
                         if ($("#listeDepartements").val()) {		
                             $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));		
                         } else {		
                             $("#listeDepartements").val(nomDepartement);		
                         }		
                         $("#listeDepartements").trigger('change');		
                         afficherDepartement(nomDepartement, numeroDepartement);		
                         $('html,body').animate({scrollTop: $('#donneesDepartements').offset().top-80}, 2000);		
                     }
                 }
            }

            function afficherDepartement(nomDepartment, numeroDepartement) {
                console.log(donneesDepartements[nomDepartement]);
                incidenceDepartement = donneesDepartements[nomDepartement]["incidence_cas"]
                saturationRea = Math.round(donneesDepartements[nomDepartement]["saturation_rea"])
                tauxPositivite = donneesDepartements[nomDepartement]["taux_positivite"]
                incidenceFrance = Math.round(donneesFrance["incidence_cas"])

                if (incidenceDepartement > 100) {
                    couleurIncidence = "red";
                } else if (incidenceDepartement > 50) {
                    couleurIncidence = "orange";
                } else {
                    couleurIncidence = "green";
                }

                if (saturationRea > 80) {
                    couleurSaturationRea = "red";
                } else if (saturationRea > 30) {
                    couleurSaturationRea = "orange";
                } else {
                    couleurSaturationRea = "green";
                }

                if (tauxPositivite >= 5) {
                    couleurTauxPositivite = "red";
                } else if (tauxPositivite >= 1) {
                    couleurTauxPositivite = "orange";
                } else {
                    couleurTauxPositivite = "green";
                }

                if ($('#' + numeroDepartement).length > 0) {
                    return;
                }
                content = $('#departementTemplate').html();
                content = content.replaceAll('nomDepartement', nomDepartment);
                content = content.replaceAll('numeroDepartement', numeroDepartement);
                content = content.replaceAll('incidenceDepartement', incidenceDepartement);
                content = content.replaceAll('incidenceFrance', incidenceFrance);
                content = content.replaceAll('saturationRea', saturationRea + "%");
                content = content.replaceAll('tauxPositivite', tauxPositivite + "%");
                content = content.replaceAll('dateMaj', dateMaj);
                content = content.replaceAll('couleurIncidence', couleurIncidence);
                content = content.replaceAll('couleurSaturationRea', couleurSaturationRea);
                content = content.replaceAll('couleurTauxPositivite', couleurTauxPositivite);

                $('#donneesDepartements').prepend(content);
                //trierDepartements();
                stopAnimation();
                setTimeout(startAnimation, 0);
            }

            function trierDepartements() {
                $divs = jQuery("#donneesDepartements div.departement");

                alphabeticallyOrderedDeps = $divs.sort(function (a, b) {
                    return String.prototype.localeCompare.call($(a).data('num'), $(b).data('num'));
                });

                $("#donneesDepartements").html(alphabeticallyOrderedDeps);
            }

            $('.select2').select2({
                placeholder: 'Sélectionnez les départements que vous voulez consulter....',
                closeOnSelect: false,
            });

            $('.select2').val(null).trigger('change');

            $('div.departement').addClass('hidden');

            $('.select2').on('select2:select', function (e) {
                nomDepartement = e.params.data.id;
                numeroDepartement = e.params.data.element.dataset.num;
                $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');
                // $('#' + nomDepartement).parent().removeClass('hidden');
                afficherDepartement(nomDepartement, numeroDepartement);
            });

            $('.select2').on('select2:unselect', function (e) {
                nomDepartement = e.params.data.id;
                numeroDepartement = e.params.data.element.dataset.num;
                $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
                $('#' + numeroDepartement).remove();
            });

            $('#unselectAll').click(function () {
                $("#listeDepartements option").each(function () {
                    $(this).attr('selected', false);
                });
                $("#listeDepartements").trigger('change');
                $('.departement').remove();
                $('#map path').removeClass('selected');
            });

            $('body').on('click', '.masquerDepartement', function (e) {
                e.preventDefault();
                numeroDepartement = $(this).parents('.departement').data("num");
                $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
                $("#listeDepartements").trigger('change');
                $('#' + numeroDepartement).remove();
            });

            $('#selectAll').click(function () {

                //Sélection des toutes les options du select.
                $("#listeDepartements option").each(function () {
                    nomDepartement = $(this).val();
                    if (!$(this).attr('selected')) {
                        $(this).attr('selected', true);
                        if ($("#listeDepartements").val()) {
                            $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                        } else {
                            $("#listeDepartements").val(nomDepartement);
                        }
                        afficherDepartement(nomDepartement, $(this).data("num"));
                        trierDepartements();
                    }
                });
                $("#listeDepartements").trigger('change');
                //Sélection des toutes les régions de la carte.
                $('#map path:not(.separator)').addClass('selected');
            });

            $('#carte path').hover(function (e) {
                departement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
                if (typeCarte == 'incidence-cas') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_cas") + ')');
                } else if (typeCarte == 'evolution-cas') {
                    signe = '';
                    if ($(this).data("incidence_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution cas : ' + signe + $(this).data("incidence_evol") + '%)');
                } else if (typeCarte == 'taux-positivite') {
                    $('#carte #map title').text(nomDepartement + ' (taux positivité : ' + $(this).data("taux_positivite").toFixed(2) + ')');
                } else if (typeCarte == 'incidence-hospitalisations') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_hosp").toFixed(2) + ')');
                } else if (typeCarte == 'lits-hospitalisations') {
                    $('#carte #map title').text(nomDepartement + ' (lits occupés : ' + $(this).data("lits_hosp").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-lits-hospitalisations') {
                    signe = '';
                    if ($(this).data("lits_hosp_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution lits occupés : ' + signe + $(this).data("lits_hosp_evol") + '%)');
                } else if (typeCarte == 'incidence-deces') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_dc").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-deces') {
                    signe = '';
                    if ($(this).data("incidence_dc_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution décès : ' + signe + $(this).data("incidence_dc_evol").toFixed(2) + '%)');
                } else if (typeCarte == 'incidence-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_rea").toFixed(2) + ')');
                } else if (typeCarte == 'saturation-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (taux occupation : ' + $(this).data("saturation_rea").toFixed(0) + '%)');
                } else if (typeCarte == 'lits-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (lits réa occupés : ' + $(this).data("lits_rea").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-lits-reanimations') {
                    signe = '';
                    if ($(this).data("lits_rea_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution lits réa occupés : ' + signe + $(this).data("lits_rea_evol") + '%)');
                } else {
                    $('#carte #map title').text(nomDepartement);
                }
            });

            $('#carte path').click(function (e) {
                numeroDepartement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                    $("#listeDepartements").trigger('change');
                    $('#' + numeroDepartement).remove();
                } else {
                    $(this).addClass('selected');
                    if ($("#listeDepartements").val()) {
                        $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                    } else {
                        $("#listeDepartements").val(nomDepartement);
                    }
                    $("#listeDepartements").trigger('change');
                    // $('#' + nomDepartement).parent().removeClass('hidden');
                    afficherDepartement(nomDepartement, numeroDepartement);
                }
            });

            $("#choixTypeCarte li a").click(function (e) {
                e.preventDefault();
                typeCarteChoisi = $(this).parent().data('carte');
                if (typeCarte != typeCarteChoisi) {
                    typeCarte = typeCarteChoisi;
                    $("#choixTypeCarte button.selected").removeClass('selected');
                    $("#choixTypeCarte li a.selected").removeClass('selected');
                    $(this).parents('.btn-group').first().children('button').addClass('selected');
                    $(this).addClass('selected');
                    colorerCarte();
                }
                // if (typeCarte == 'cas'){
                //     $("#legendeCas").removeClass("hidden");
                // } else {
                //     // $("#legendeCas").addClass("hidden");
                // }
            });


        }
    )
</script>
<style>


    table,
    td {
        border: 0px solid #333;
        color: black;
        background-color: red;
    }

    .shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: #ffffff;
        margin-left: 10px;
        margin-top: 10px;
    }

    #listeDepartements {
        width: 100%;
    }

    #map {
        max-width: 100%;
        max-height: 100%;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
        z-index: 1000;
        transition: fill 2s;
        fill-opacity: 1;
    }

    #map.animated path.selected {
        transition: fill 0.2s, stroke 0.3s;
        z-index: 9000;
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            stroke-width: 2;
            fill-opacity: 0.5;
        }
    }

    #map path:hover {
        stroke-width: 2.6;
    }

    #map path.selected:hover {
        stroke-width: 0.6;
    }

    #map .separator {
        stroke: #ccc;
        fill: none !important;
        stroke-width: 1.5;
    }

    #titreCarte {
        font-size: 16px;
        font-weight: bold;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none !important;
    }

    .btn-primary {
        background-color: #86AAE0;
        border-color: #86AAE0;
    }

    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus {
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

    .dropdown-menu > li > a.selected {
        background-color: #a1d1ff;
    }

    #choixTypeCarte, #choixTypeDonnee {
        margin-bottom: 20px;
    }

    #choixTypeCarte button.selected {
        font-weight: bold;
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

</style>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<p>
</p>
<div id="donneesDepartements">

</div>
