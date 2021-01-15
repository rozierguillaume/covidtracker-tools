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
