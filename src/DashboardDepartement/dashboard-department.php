<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>

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
        <td style="text-align: center; background-color: colorBg; color: white; font-size: 50%; padding: 5px;">valeur</td>
    </tr>
</script>

<script id="legendTemplatePost" type="text/template">
        </tbody>
    </table>

</script>

<script>
    jQuery(document).ready(function ($) {

        var valeurs_cas = [">", "750", "650", "550", "450", "350", "300", "250", "200", "150", "100", "50", "25"]
        var couleurs_cas = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"]

        var valeurs_hosp = [">", "50", "45", "40", "35", "30", "25", "20", "15", "10", "9", "6", "3"]
        var couleurs_hosp = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"]

        var valeurs_dc = [">", "12", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1"]
        var couleurs_dc = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"]

            var donneesDepartements;
        var donneesFrance;
        var dateMaj;
        var typeCarte = 'cas';

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

        function construireLegende(values=[], colors=[]){
            content = $('#legendTemplatePre').html();
            values.map((val, idx) => {
                content += $('#legendTemplateMid').html().replaceAll("valeur", val).replaceAll("colorBg", colors[idx]);
            })
            content += $('#legendTemplatePost').html();
            console.log(content)
            $('#legendeCarte').html(content);
        }

        function colorerCarte() {
            for (departement in donneesDepartements) {
                // console.log(departement);
                numeroDepartement = $('#listeDepartements option[value="' + departement + '"]').data("num");
                // console.log(numeroDepartement);
                donneesDepartement = donneesDepartements[departement];
                // console.log(donneesDepartement);
                var departementCarte = $('#carte path[data-num="' + numeroDepartement + '"]');

                if (typeCarte == 'cas') {
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants.")
                    construireLegende(valeurs_cas, couleurs_cas);
                    departementCarte.data("incidence-cas", donneesDepartement["incidence_cas"]);
                    for (i = 12; i > 0; i--) {
                        if (i == 1){
                            departementCarte.css("fill", couleurs_cas[i]);
                            break;
                        } else if (donneesDepartement["incidence_cas"] <= valeurs_cas[i]){
                            departementCarte.css("fill", couleurs_cas[i]);
                            break;
                        }
                    }
                } else if (typeCarte == 'hospitalisations') {
                    $('#descriptionCarte').html("Nombre d'admissions à l'hôpital avec Covid19 cette semaine pour 100k habitants.")
                    construireLegende(valeurs_hosp, couleurs_hosp);

                    departementCarte.data("incidence-hosp", donneesDepartement["incidence_hosp"]);
                    for (i = 12; i > 0; i--) {
                        if (i == 1){
                            departementCarte.css("fill", couleurs_hosp[i]);
                            break;
                        } else if (donneesDepartement["incidence_hosp"] <= valeurs_hosp[i]){
                            departementCarte.css("fill", couleurs_hosp[i]);
                            break;
                        }
                    }
                } else if (typeCarte == 'deces') {
                    $('#descriptionCarte').html("Nombre de décès avec Covid19 cette semaine pour 100k habitants.")
                    construireLegende(valeurs_dc, couleurs_dc);

                    departementCarte.data("incidence-dc", donneesDepartement["incidence_dc"]);
                    for (i = 12; i > 0; i--) {
                        if (i == 1){
                            departementCarte.css("fill", couleurs_dc[i]);
                            break;
                        } else if (donneesDepartement["incidence_dc"] <= valeurs_dc[i]){
                            departementCarte.css("fill", couleurs_dc[i]);
                            break;
                        }
                    }
                } else {
                    $('#carte path').css("fill", "#c4c4cb");
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
                couleurIncidence = "red"

            } else if (incidenceDepartement > 50) {
                couleurIncidence = "orange"

            } else {
                couleurIncidence = "green"
            }

            if (saturationRea > 80) {
                couleurSaturationRea = "red"

            } else if (saturationRea > 30) {
                couleurSaturationRea = "orange"

            } else {
                couleurSaturationRea = "green"
            }

            if (tauxPositivite>=5){
                couleurTauxPositivite = "red"

            } else if (tauxPositivite>=1){
                couleurTauxPositivite = "orange"
            } else {
                couleurTauxPositivite = "green"
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
            console.log($("select option[data-num='" + numeroDepartement + "']"));
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
            if (typeCarte == 'cas') {
                $('#carte #map title').text(nomDepartement + ' (incidence: ' + $(this).data("incidence-cas") + ')');
            } else if (typeCarte == 'hospitalisations') {
                $('#carte #map title').text(nomDepartement + ' (incidence: ' + $(this).data("incidence-hosp").toFixed(2) + ')');
            } else if (typeCarte == 'deces') {
                $('#carte #map title').text(nomDepartement + ' (incidence: ' + $(this).data("incidence-dc").toFixed(2) + ')');
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

        $("#choixTypeCarte button").click(function () {
            typeCarteChoisi = $(this).data('type-carte');
            if (typeCarte != typeCarteChoisi) {
                typeCarte = typeCarteChoisi;
                $("#choixTypeCarte button").removeClass('selected');
                $(this).addClass('selected');
                colorerCarte();
            }
            if (typeCarte == 'cas'){
                $("#legendeCas").removeClass("hidden");
            } else {
                $("#legendeCas").addClass("hidden");
            }
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
        fill: none;
        stroke-width: 1.5;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none;
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

