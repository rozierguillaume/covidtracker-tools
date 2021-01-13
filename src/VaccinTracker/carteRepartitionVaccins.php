<h2 style="margin-top : 80px;">Répartition des vaccinés</h2>
Coloration en fonction du pourcentage de population vaccinée. Données fournies par le Ministère de la Santé. Cliquez sur une région pour afficher plus de détail.
<!--START MAP-->

<!--START JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"
        integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>

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
        <div class="shadow">
            <span style="font-size: 160%; color: black"><b>vaccinesRegion</b></span><br>
            <span><b>Nombre de personnes vaccinées</b><br>
                Nombre de personnes ayant reçu au moins une dose de vaccin. Cela représente vaccinesPopReg% de la population de cette région.
            <br></span>
            <div class="text-right clearFix" style="font-size: 70%;">Mise à jour : dateMaj</div>
        </div>

        <!-- wp:spacer {"height":50} -->
        <div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

    </div>
</script>
<script>
    jQuery(document).ready(function ($) {

        var donneesRegions;
        var nomRegions = [];
        var vaccinesRegions = [];
        var dateMaj;
        $('.etiquette tspan').text('...');

        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data_regions.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                donneesRegions = json['donnees_regions'];
                dateMaj = json["date_update"]

                for (region in donneesRegions) {
                    // console.log(departement);
                    numeroRegion = $('#listeRegions option[value="' + region + '"]').data("num");
                    // console.log(numeroDepartement);
                    donneesRegion = donneesRegions[region];
                    nomRegions.push(region);
                    vaccinesRegions.push(donneesRegions[region]["vaccines"]);
                    // console.log(donneesDepartement);

                    var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"]');
                    regionCarte.data("incidence-cas", donneesRegion["vaccines"]);


                    let valeurs = [0.05, 0.1, 0.15, 0.2, 0.25, 0.3, 0.35, 0.4]
                    let couleurs = ["#DCECCD", "#BDE0AE", "#98D390", "#73C679", "#55B86F", "#39A96B", "#1D9A6C", "#178973", "#117876"]
                    let data_reg = (donneesRegion["vaccines"] / donneesRegion["population"]) * 100
                    console.log(data_reg);
                    $('.etiquette.region-' + numeroRegion).text(data_reg.toFixed(2) + ' %');

                    if (data_reg > valeurs[valeurs.length - 1]) {
                        console.log("if")
                        regionCarte.css("fill", couleurs[couleurs.length - 1]);
                    } else {
                        for (var i = 0; i < valeurs.length; i++) {
                            if (data_reg <= valeurs[i]) {
                                regionCarte.css("fill", couleurs[i]);
                                break;
                            }
                        }
                    }

                }

                buildBarChart();
            });

        var chartRegions;

        function buildBarChart() {
            var ctx = document.getElementById('chartRegions').getContext('2d');
            this.chartRegions = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: nomRegions,
                    datasets: [{
                        label: 'Nombre de vaccinés ',
                        data: vaccinesRegions,
                        borderWidth: 3,
                        backgroundColor: 'rgba(0, 168, 235, 0.5)',
                        borderColor: 'rgba(0, 168, 235, 1)',
                        cubicInterpolationMode: 'monotone'
                    },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                min: 0
                            },

                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxRotation: 0,
                                minRotation: 0,
                                maxTicksLimit: 6,
                                callback: function (value, index, values) {
                                    return value; //value.slice(8) + "/" + value.slice(5, 7);
                                }
                            }

                        }]
                    },
                    annotation: {
                        events: ["click"],
                        annotations: []
                    }
                }
            });
        }


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

        function afficherRegion(nomRegion, numeroRegion) {
            vaccinesRegion = donneesRegions[nomRegion]["vaccines"];
            vaccinesRegionPop = (vaccinesRegion / donneesRegions[nomRegion]["population"] * 100).toFixed(2);
            if (vaccinesRegion <= 0) {
                vaccinesRegion = "--";
            }
            if ($('#' + numeroRegion).length > 0) {
                return;
            }
            content = $('#regionTemplate').html();
            content = content.replace(/nomRegion/g, nomRegion);
            content = content.replace(/numeroRegion/g, numeroRegion);
            content = content.replace(/vaccinesRegion/g, vaccinesRegion.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 "));
            content = content.replace(/vaccinesPopReg/g, vaccinesRegionPop);

            content = content.replace(/dateMaj/g, dateMaj);

            $('#donneesRegions').prepend(content);
            stopAnimation();
            setTimeout(startAnimation, 200);
        }

        $('div.region').addClass('hidden');
        $('body').on('click', '.masquerRegion', function (e) {
            e.preventDefault();
            numeroRegion = $(this).parents('.region').data("num");
            // $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
            $('#map path[data-code_insee=' + numeroRegion + ']').removeClass('selected');
            // $("#listeRegions").trigger('change');
            $('#' + numeroRegion).remove();
        });

        $('#carte path').hover(function (e) {
            numeroRegion = $(this).data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            $('#carte #map title').text(nomRegion);
        });

        $('#carte text').click(function (e) {
            numeroRegion = $(this).data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"]');
            if (regionCarte.hasClass('selected')) {
                regionCarte.removeClass('selected');
                $('#' + numeroRegion).remove();
            } else {
                regionCarte.addClass('selected');
                afficherRegion(nomRegion, numeroRegion);
            }
        });

        $('#carte text tspan').click(function (e) {
            console.log($(this).parent());
            numeroRegion = $(this).parent().data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"]');
            if (regionCarte.hasClass('selected')) {
                regionCarte.removeClass('selected');
                $('#' + numeroRegion).remove();
            } else {
                regionCarte.addClass('selected');
                afficherRegion(nomRegion, numeroRegion);
            }
        });

        $('#carte path').click(function (e) {
            numeroRegion = $(this).data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#' + numeroRegion).remove();
            } else {
                $(this).addClass('selected');
                afficherRegion(nomRegion, numeroRegion);
            }
        });

    })
</script>
<style>

    .shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100% !important;
        background: #ffffff;
        /*margin-left: 10px;*/
        margin-top: 10px;
    }

    #listeRegions {
        width: 100%;
    }

    #map {
        max-width: 100%;
        height: auto;
    }

    #map path:hover {
        fill-opacity: 0.6;
        transition: fill-opacity 2s, fill 0.2s, stroke 0.3s;
        cursor: pointer;
    }

    #carte text, #carte text tspan {
        cursor: pointer;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #000000;
        stroke-width: 1;
        transition: fill-opacity 2s, fill 0.2s, stroke 0.3s;
        z-index: 1000;
        /*transition: fill 2s;*/
        fill-opacity: 1;
    }

    #map.animated path.selected {
        /*.animated*stroke: #000000;*/
        /*stroke-width: 1.5;*/
        transition: fill 0.2s, stroke 0.3s;
        z-index: 9000;
        fill-opacity: 0.6;
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            stroke-width: 1;
            fill-opacity: 0.2;
        }
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

</style>

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
                <option data-num="11" value="Ile-de-France">Île-de-France</option>
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
                    <!--                   --><?php //include(__DIR__.'/carteOld.php'); ?>
                    <?php include(__DIR__ . '/carteNew.php'); ?>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-5" style="padding-top: 0px;" id="donneesRegions">
        Nombre de personnes ayant reçu une dose&nbsp;:
        <div class="chart-container" style="position: relative; height:50vh; width:100%">
            <canvas id="chartRegions" style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
        </div>
    </div>
</div>


<!--END MAP-->

