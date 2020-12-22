<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>

<script id="regionTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroRegion" data-num="numeroRegion" data-nom="nomRegion" class="region">
        <h2>
            nomRegion
            <a class="masquerRegion pull-right" href="#">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </a>
        </h2>

        <div class="row">
            <div class="col-md-4 shadow">
                <span style="font-size: 160%; color: couleurIncidence"><b>incidenceRegion</b></span><br>
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
                <span style="font-size: 160%; color: couleurReffectif"><b>reffectifRegion</b></span><br>
                <span><b>R effectif</b>
                <br>Si le taux de reproduction est supérieur à 1, alors l'épidémie progresse. S'il est inférieur à 1, elle régresse.</span><br>
                <span style="font-size: 70%;">Mise à jour : dateMaj</span>
            </div>
        </div>

        <h3 style="margin-top: 40px;">Vue d'ensemble</h3>
        <p>Ces quatre graphiques permettent d'évaluer l'épidémie dans la région. Le nombre de cas correspond à l'activité du virus. Le nombre d'hospitalisations, de réanimations et de décès hospitaliers permettent de mesurer la crise sanitaire.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/dashboard_jour_nomRegion.jpeg" target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/dashboard_jour_nomRegion.jpeg" width="100%"> </a>
        </p>
        <h3 style="margin-top: 40px;">Incidence par tranche d'âge</h3>
        <p>Le taux d'incidence correspond au nombre de cas cumulé sur 7 jours rapporté à 100 000 habitants du département. Cet indicateur représente l'activité épidémique du virus. Le seuil d'alerte est de 50.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_regs/heatmap_taux_nomRegion.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_regs/heatmap_taux_nomRegion.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>
        <h3 style="margin-top: 40px;">Flux hospitaliers</h3>
        <p>Ce graphique présente l'évolution des entrées et sorties de l'hôpital pour motif Covid19.</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/hosp_journ_flux_nomRegion.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/hosp_journ_flux_nomRegion.jpeg"
                     width="100%" style="max-width: 1000px;">
            </a>
        </p>
        <h3 style="margin-top: 40px;">Tension hospitalière</h3>
        <p>Ce graphique présente la proportion de lits de réanimation occupés uniquement par les patients Covid19, par rapport au nombre de lits en temps normal (fin 2018, étude de la DREES).</p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/saturation_rea_journ_nomRegion.jpeg" target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/saturation_rea_journ_nomRegion.jpeg" width="100%">
            </a>
        </p>

        <!-- wp:spacer {"height":50} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <p><a href="#menu">Haut de page</a></p>
    </div>
</script>
<script>
    jQuery(document).ready(function ($) {

        var donneesRegions
        var reffectifRegions
        var donneesFrance
        var saturationReaRegions
        var dateMaj

        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/incidence_regions.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })

            .then(json => {
                donneesRegions = json['donnees_regions'];
                donneesFrance = json['donnees_france'];
                dateMaj = json["date_update"]

                for (region in donneesRegions){
                    // console.log(departement);
                    numeroRegion = $('#listeRegions option[value="'+region+'"]').data("num");
                    // console.log(numeroDepartement);
                    donneesRegion = donneesRegions[region];
                    // console.log(donneesDepartement);

                    var regionCarte = $('#carte path[data-num="' + numeroRegion + '"]');
                    regionCarte.data("incidence-cas", donneesRegion["incidence_cas"]);

                    if (donneesRegion["incidence_cas"]<=25){
                        regionCarte.css("fill", "#118408");
                    } else if (donneesRegion["incidence_cas"]<=50){
                        regionCarte.css("fill", "#98ac3b");
                    } else if (donneesRegion["incidence_cas"]<=100){
                        regionCarte.css("fill", "#fb9449");
                    } else if (donneesRegion["incidence_cas"]<=150){
                        regionCarte.css("fill", "#f95228");
                    }  else if (donneesRegion["incidence_cas"]<=200){
                        regionCarte.css("fill", "#f50e07");
                    } else if (donneesRegion["incidence_cas"]<=250){
                        regionCarte.css("fill", "#e20001");
                    } else if (donneesRegion["incidence_cas"]<=300){
                        regionCarte.css("fill", "#d50100");
                    } else if (donneesRegion["incidence_cas"]<=350){
                        regionCarte.css("fill", "#c40001");
                    } else if (donneesRegion["incidence_cas"]<=450){
                        regionCarte.css("fill", "#a00000");
                    } else if (donneesRegion["incidence_cas"]<=550){
                        regionCarte.css("fill", "#840000");
                    } else if (donneesRegion["incidence_cas"]<=650){
                        regionCarte.css("fill", "#6a0000");
                    } else if (donneesRegion["incidence_cas"]<=750){
                        regionCarte.css("fill", "#4c0000");
                    } else {
                        regionCarte.css("fill", "#3c0000");
                    }
                }
            });

            fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/reffectif_region.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                reffectifRegions = json;
            });

            fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/saturation_rea_regions.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                saturationReaRegions = json;
            });


        function afficherRegion(nomRegion, numeroRegion) {
            incidenceRegion = donneesRegions[nomRegion]["incidence_cas"]
            incidenceFrance = Math.round(donneesFrance["incidence_cas"])
            saturationRea = Math.round(saturationReaRegions[nomRegion])
            reffectifRegion = Math.round((reffectifRegions[nomRegion]["value"]*100))/100

            if (incidenceRegion>100){
                couleurIncidence = "red"

            } else if (incidenceRegion>50){
                couleurIncidence = "orange"

            } else {
                couleurIncidence = "green"
            }

            if (saturationRea>80){
                couleurSaturation = "red"

            } else if (saturationRea>40){
                couleurSaturation = "orange"

            } else {
                couleurSaturation = "green"
            }

            if (reffectifRegion>1.5){
                couleurReffectif = "red"

            } else if (reffectifRegion>=0.9){
                couleurReffectif = "orange"

            } else {
                couleurReffectif = "green"
            }

            if ($('#' + numeroRegion).length > 0) {
                return;
            }
            content = $('#regionTemplate').html();
            content = content.replaceAll('nomRegion', nomRegion);
            content = content.replaceAll('numeroRegion', numeroRegion);
            content = content.replaceAll('incidenceRegion', incidenceRegion);
            content = content.replaceAll('incidenceFrance', incidenceFrance);
            content = content.replaceAll('saturationRea', saturationRea + "%");
            content = content.replaceAll('dateMaj', dateMaj);
            content = content.replaceAll('couleurIncidence', couleurIncidence);
            content = content.replaceAll('couleurSaturationRea', couleurSaturation);
            content = content.replaceAll('couleurReffectif', couleurReffectif);
            content = content.replaceAll('reffectifRegion', reffectifRegion);
            //content = content.replaceAll('couleurSaturationRea', couleurSaturationRea);

            $('#donneesRegions').prepend(content);
            trierRegions();
        }

        function trierRegions() {
            $divs = jQuery("#donneesRegions div.region");
            alphabeticallyOrderedRegions = $divs.sort(function (a, b) {
                // alert($(a).data('nom').toLowerCase());
                // alert($(b).data('nom').toLowerCase());
                return String.prototype.localeCompare.call($(a).data('nom').toLowerCase(), $(b).data('nom').toLowerCase());
            });
            $("#donneesRegions").html(alphabeticallyOrderedRegions);
        }

        //
        $('.select2').select2({
            placeholder: 'Sélectionnez les régions que vous voulez consulter....',
            closeOnSelect: false,
        });

        $('.select2').val(null).trigger('change');

        $('div.region').addClass('hidden');

        $('.select2').on('select2:select', function (e) {
            nomRegion = e.params.data.id;
            numeroRegion = e.params.data.element.dataset.num;
            $('#map path[data-num=' + numeroRegion + ']').addClass('selected');
            afficherRegion(nomRegion, numeroRegion);
        });

        $('.select2').on('select2:unselect', function (e) {
            nomRegion = e.params.data.id;
            numeroRegion = e.params.data.element.dataset.num;
            $('#map path[data-num=' + numeroRegion + ']').removeClass('selected');
            $('#' + numeroRegion).remove();
        });


        $('body').on('click', '.masquerRegion', function (e) {
            e.preventDefault();
            numeroRegion = $(this).parents('.region').data("num");
            $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
            $('#map path[data-num=' + numeroRegion + ']').removeClass('selected');
            $("#listeRegions").trigger('change');
            $('#' + numeroRegion).remove();
        });

        $('#unselectAll').click(function () {
            $("#listeRegions option").each(function() {
                $(this).attr('selected', false);
                $("#listeRegions").trigger('change');
            });
            $('.region').remove();
            $('#map path').removeClass('selected');
        });

        $('#selectAll').click(function () {
            //Sélection des toutes les options du select.
            $("#listeRegions option").each(function() {
                nomRegion = $(this).val();
                if (!$(this).attr('selected')) {
                    $(this).attr('selected', true);
                    if ($("#listeRegions").val()) {
                        $("#listeRegions").val($.merge([nomRegion], $("#listeRegions").val()));
                    } else {
                        $("#listeRegions").val(nomRegion);
                    }
                    afficherRegion(nomRegion, $(this).data("num"));
                }
            });
            $("#listeRegions").trigger('change');
            //Sélection des toutes les régions de la carte.
            $('#map path').addClass('selected');

        });

        $('#carte path').hover(function (e) {
            numeroRegion = $(this).data("num");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            $('#carte #map title').text(nomRegion);
        });

        $('#carte path').click(function (e) {
            numeroRegion = $(this).data("num");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
                $("#listeRegions").trigger('change');
                $('#' + numeroRegion).remove();
            } else {
                $(this).addClass('selected');
                if ($("#listeRegions").val()) {
                    $("#listeRegions").val($.merge([nomRegion], $("#listeRegions").val()));
                } else {
                    $("#listeRegions").val(nomRegion);
                }
                $("#listeRegions").trigger('change');
                afficherRegion(nomRegion, numeroRegion);
            }
        });

    })
</script>
<style>

    .shadow{
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
    
    #listeRegions {
        width: 100%;
    }

    #map {
        max-width: 100%;
        max-height: 100%;
    }

    #map path {
        fill: #86AAE0;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
    }

    #map path.selected {
        fill: #547096;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
    }

    #map path:hover {
        fill: #547096;
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

    .btn-primary{
        background-color: #86AAE0;
        border-color: #86AAE0;
    }

    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus {
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

</style>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!--<p>-->
<!--    <a href="#menu">Retour au menu</a>-->
<!--</p>-->
<div id="donneesRegions">

</div>

