<h2 style="margin-top : 80px;">
    Répartition des vaccinés
</h2>

<div class="" style="margin-bottom: 40px;">
    Coloration en fonction du pourcentage de population vaccinée.
    Données fournies par le Ministère de la Santé.
    Cliquez sur une région pour afficher plus de détail.
</div>

<!--START HTML-->
<div id="menu" class="row">
    <div class="col-md-6 text-center">
        <h4 id="titre_map" class="" style="display: inline-block">Pourcentage de la population vaccinée :</h4>
        <div id="carte" style="margin-top:20px;">
            <?php include(__DIR__ . '/carteSvg.php'); ?>
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

#region-graphique-detail {
    display: none;
}
</style>

<!--ENDBLOC JS -->
<!--BLOC JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"
        integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>

<!--<script src="carte.js"></script> -->
<script>
Array.prototype.asortBy = function (p) {
    return this.slice(0).sort(function (a, b) {
        return (a[p] < b[p]) ? 1 : (a[p] > b[p]) ? -1 : 0;
    });
};

Number.prototype.addZero = function () {
    if (this <= 9) {
        return "0" + this;
    }
    return this
};

jQuery(document).ready(function ($) {
    const POPULATION = [
        {
            region: 'REG-01',
            population: 376900
        },
        {
            region: 'REG-02',
            population: 358700
        },
        {
            region: 'REG-03',
            population: 290700
        },
        {
            region: 'REG-04',
            population: 860000
        },
        {
            region: 'REG-06',
            population: 279500
        },
        {
            region: 'REG-11',
            population: 12278200
        },
        {
            region: 'REG-24',
            population: 2559100
        },
        {
            region: 'REG-27',
            population: 2783000
        },
        {
            region: 'REG-28',
            population: 3303500
        },
        {
            region: 'REG-32',
            population: 5962700
        },
        {
            region: 'REG-44',
            population: 5511700
        },
        {
            region: 'REG-52',
            population: 3801800
        },
        {
            region: 'REG-53',
            population: 3340400
        },
        {
            region: 'REG-75',
            population: 6000000
        },
        {
            region: 'REG-76',
            population: 5924900
        },
        {
            region: 'REG-84',
            population: 8032400
        },
        {
            region: 'REG-93',
            population: 5055700
        },
        {
            region: 'REG-94',
            population: 344700
        },
    ];

    var donneesRegions;
    var nomRegions = [];
    var vaccinesRegions = [];
    var vaccinesRegionsHistorique = {};
    var dateMaj = "";
    var numeroRegion;
    let valeurs = [0.05, 0.1, 0.15, 0.2, 0.25, 0.3, 0.35, 0.4]
    let couleurs = ["#DCECCD", "#BDE0AE", "#98D390", "#73C679", "#55B86F", "#39A96B", "#1D9A6C", "#178973", "#117876"]


    fetch('https://www.data.gouv.fr/fr/datasets/r/16cb2df5-e9c7-46ec-9dbf-c902f834dab1')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(regions => {
            regions.forEach(region => {
                let code = region.code.replace('REG-', '');
                let data = {
                    code: code,
                    region: region.nom,
                    vaccines: region.totalVaccines,
                    date: region.date
                };
                data.population = POPULATION.find(reg => reg.region == "REG-" + code).population;
                if (!vaccinesRegionsHistorique[code]) {
                    vaccinesRegionsHistorique[code] = [];
                }
                vaccinesRegionsHistorique[code].push(data);

                if (region.date > dateMaj) {
                    dateMaj = region.date;
                    vaccinesRegions = [];
                }

                if (region.date == dateMaj) {
                    vaccinesRegions.push(data);

                    //traitement Mayotte
                    if (code == '06') {
                        var regionCarte = $('#carte g[data-code_insee="' + code + '"] path');
                    } else {
                        var regionCarte = $('#carte path[data-code_insee="' + code + '"]');
                    }
                    regionCarte.data("incidence-cas", region.totalVaccines);
                    let data_reg = (data.vaccines / data.population) * 100;
                    $('.etiquette.region-' + code).text(data_reg.toFixed(2) + ' %');
                    if (data_reg > valeurs[valeurs.length - 1]) {
                        // console.log("if")
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
            });
            vaccinesRegions = vaccinesRegions.asortBy('vaccines');
            buildBarChart();
        });

    var chartRegions;

    function buildBarChart() {

        var ctx = document.getElementById('chartRegions').getContext('2d');
        // graphique liste des régions
        this.chartRegions = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: vaccinesRegions.map(val => val.region),
                datasets: [{
                    label: 'Nombre de vaccinés ',
                    data: vaccinesRegions.map(val => val.vaccines),
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
    * Sans quoi chaque département commence son clignotement au moment où on lui attribue
    * la classe selected.
    */
    var stopAnimation = function () {
        $("#map").removeClass("animated")
    }

    var startAnimation = function () {
        $("#map").addClass("animated")
    }

    function afficherRegion(nomRegion, numeroRegion) {
        $('div[data-type="region-detail"]').remove();
        $('#region-nom').text(nomRegion);
        $('#carte path[data-code_insee]').removeClass('selected');
        $('#region-general').hide();
        let region = vaccinesRegions.find(region => region.code == numeroRegion);
        vaccinesRegion = region.vaccines;
        vaccinesRegionPop = (vaccinesRegion / region.population * 100).toFixed(2)

        dateMaj = dateMaj
        let fullDate = new Date(dateMaj);

        if (vaccinesRegion <= 0) {
            vaccinesRegion = "--"
        }

        if ($('#' + numeroRegion).length > 0) {
            return;
        }
        content = $('#regionTemplate').html();
        content = content.replace(/nomRegion/g, nomRegion);
        content = content.replace(/numeroRegion/g, numeroRegion);
        content = content.replace(/vaccinesRegion/g, vaccinesRegion.toLocaleString());
        content = content.replace(/vaccinesPopReg/g, vaccinesRegionPop);

        content = content.replace(/dateMaj/g, parseInt(fullDate.getDate()).addZero() + '/' + (fullDate.getMonth() + 1).addZero());

        $('#donneesRegions').prepend(content);
        vaccinesRegionsHistorique[numeroRegion] = vaccinesRegionsHistorique[numeroRegion].sortBy('date');
        let dataset = {
            label: 'Nombre cumulé de vaccinés - ' + nomRegion,
            data: vaccinesRegionsHistorique[numeroRegion].map(val => val.vaccines),
            borderWidth: 3,
            backgroundColor: 'rgba(0, 168, 235, 0.5)',
            borderColor: 'rgba(0, 168, 235, 1)',
            cubicInterpolationMode: 'monotone'
        };
        let labels = vaccinesRegionsHistorique[numeroRegion].map(val => val.date);
        $('#region-graphique-detail').show();

        updateData(labels, dataset);
        //trierRegions();
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
        $('#region-general').show();
        $('#region-graphique-detail').hide();
    });


    $('#carte path').hover(function (e) {
        numeroRegion = $(this).data("code_insee");
        if (numeroRegion == null) {
            numeroRegion = $(this).parent().data("code_insee");
        }
        nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
        $('#carte #map title').text(nomRegion);
    });

    $('#carte text').click(function (e) {
        numeroRegion = $(this).data("code_insee");
        nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
        var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"]');
        if (regionCarte.hasClass('selected')) {
            regionCarte.removeClass('selected');
            $('#' + numeroRegion).remove()
            $('#region-general').show();
            $('#region-graphique-detail').hide();
        } else {
            afficherRegion(nomRegion, numeroRegion);
            regionCarte.addClass('selected');
        }
    });

    $('#carte text tspan').click(function (e) {
        numeroRegion = $(this).parent().data("code_insee");
        nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
        var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"]');
        if (regionCarte.hasClass('selected')) {
            regionCarte.removeClass('selected');
            $('#' + numeroRegion).remove();
            $('#region-general').show();
            $('#region-graphique-detail').hide();
        } else {
            afficherRegion(nomRegion, numeroRegion);
            regionCarte.addClass('selected');
        }
    });

    $('#carte path.region, #carte g.region').click(function (e) {
        numeroRegion = $(this).data("code_insee");
        nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            $('#' + numeroRegion).remove();
            $('#region-general').show();
            $('#region-graphique-detail').hide();
        } else {
            afficherRegion(nomRegion, numeroRegion);
            $(this).addClass('selected');
        }
    });


    function updateData(labels, dataset) {
        let chart = document.getElementById('chartRegionDetail');

        // Graphique courbe d'une région
        var lineChartRegion = new Chart(chart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [dataset]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 100      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
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
                                return value.slice(8) + "/" + value.slice(5, 7);
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
});
</script>


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
            <span><b>Nombre de personnes vaccinées</b><br>
                Nombre de personnes ayant reçu au moins une dose de vaccin. Cela représente vaccinesPopReg% de la population de cette région.
            <br></span>
            <span style="font-size: 70%;">Mise à jour : dateMaj</span>

            <!-- wp:spacer {"height":50} -->
            <div style="height:15px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <div id="region-graphique-detail">
                <div class="chart-container" style="position: relative; height:250px; width:100%">
                    <canvas id="chartRegionDetail"
                            style="margin-top:0px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
            </div>
        </div>
        <!-- wp:spacer {"height":50} -->
        <div style="height:5px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
    </div>
</script>
<!--END JS-->
