<script>
    // ref: http://stackoverflow.com/a/1293163/2343
    // This will parse a delimited string into an array of
    // arrays. The default delimiter is the comma, but this
    // can be overriden in the second argument.
    function CSVToArray( strData, strDelimiter ){
        // Check to see if the delimiter is defined. If not,
        // then default to comma.
        strDelimiter = (strDelimiter || ",");

        // Create a regular expression to parse the CSV values.
        var objPattern = new RegExp(
            (
                // Delimiters.
                "(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +

                // Quoted fields.
                "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +

                // Standard fields.
                "([^\"\\" + strDelimiter + "\\r\\n]*))"
            ),
            "gi"
            );


        // Create an array to hold our data. Give the array
        // a default empty first row.
        var arrData = [[]];

        // Create an array to hold our individual pattern
        // matching groups.
        var arrMatches = null;


        // Keep looping over the regular expression matches
        // until we can no longer find a match.
        while (arrMatches = objPattern.exec( strData )){

            // Get the delimiter that was found.
            var strMatchedDelimiter = arrMatches[ 1 ];

            // Check to see if the given delimiter has a length
            // (is not the start of string) and if it matches
            // field delimiter. If id does not, then we know
            // that this delimiter is a row delimiter.
            if (
                strMatchedDelimiter.length &&
                strMatchedDelimiter !== strDelimiter
                ){

                // Since we have reached a new row of data,
                // add an empty row to our data array.
                arrData.push( [] );

            }

            var strMatchedValue;

            // Now that we have our delimiter out of the way,
            // let's check to see which kind of value we
            // captured (quoted or unquoted).
            if (arrMatches[ 2 ]){

                // We found a quoted value. When we capture
                // this value, unescape any double quotes.
                strMatchedValue = arrMatches[ 2 ].replace(
                    new RegExp( "\"\"", "g" ),
                    "\""
                    );

            } else {

                // We found a non-quoted value.
                strMatchedValue = arrMatches[ 3 ];

            }


            // Now that we have our value string, let's add
            // it to the data array.
            arrData[ arrData.length - 1 ].push( strMatchedValue );
        }

        // Return the parsed data.
        return( arrData );
    }
    
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
        let valeurs = [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5]
        //let couleurs = ["#DCECCD", "#BDE0AE", "#98D390", "#73C679", "#55B86F", "#39A96B", "#1D9A6C", "#178973", "#117876"]
        let couleurs= ["#cfdde6", "#b8d4e6", "#a1cbe6", "#8ac2e6", "#73bae6", "#5cb1e6", "#45a8e6", "#2e9fe6", "#1796e6", "#008ee6"] // HSV(203, xx, 90) avec xx de 10 à 100

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
        
        var doses_recues_regions = {}

        fetch('https://www.data.gouv.fr/fr/datasets/r/c3f04527-2d19-4476-b02c-0d86b5a9d3da', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.text();
        })
        .then(csv => {

            array_data_stock = CSVToArray(csv, ";");
            array_data_stock.slice(1, array_data_stock.length-1).map((value, idx) => {
                let region_num = value[0];
                let region = value[1];
                let doses_reg = parseInt(value[3]);
                let date = value[5];

                if (region_num in doses_recues_regions) {
                    let N = doses_recues_regions[region_num]["valeurs"].length

                    if (date == doses_recues_regions[region_num]["dates"][N-1]){
                        doses_recues_regions[region_num]["valeurs"][N-1] += doses_reg;
                    } else {
                        doses_recues_regions[region_num]["valeurs"].push(doses_reg)
                        doses_recues_regions[region_num]["dates"].push(date)
                    }

                } else {
                    doses_recues_regions[region_num] = {"valeurs": [doses_reg], "dates": [date]};
                }
            })
            console.log(doses_recues_regions)
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x")
        }
        )

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
            vaccinesRegion = numberWithSpaces(region.vaccines);

            if (numeroRegion in doses_recues_regions){
                let N = doses_recues_regions[numeroRegion]["valeurs"].length;
                dosesRecuesRegion = numberWithSpaces(doses_recues_regions[numeroRegion]["valeurs"][N-1]);

            } else {
                dosesRecuesRegion = "--";
            }

            dateMaj = dateMaj
            let fullDate = new Date(dateMaj);

            if (vaccinesRegion <= 0) {
                vaccinesRegion = "--";
            }

            if ($('#' + numeroRegion).length > 0) {
                return;
            }
            content = $('#regionTemplate').html();
            content = content.replace(/nomRegion/g, nomRegion);
            content = content.replace(/numeroRegion/g, numeroRegion);
            content = content.replace(/vaccinesRegion/g, vaccinesRegion);
            content = content.replace(/vaccinesPopReg/g, vaccinesRegionPop);
            content = content.replace(/dosesReceptionneesRegion/g, dosesRecuesRegion);

            content = content.replace(/dateMaj/g, parseInt(fullDate.getDate()).addZero() + '/' + (fullDate.getMonth() + 1).addZero());

            $('#donneesRegions').prepend(content);
            vaccinesRegionsHistorique[numeroRegion] = vaccinesRegionsHistorique[numeroRegion].sortBy('date');
            let datasets = [{
                label: 'Nombre vaccinés - ' + nomRegion,
                data: vaccinesRegionsHistorique[numeroRegion].map(val => val.vaccines),
                borderWidth: 3,
                backgroundColor: 'rgba(0, 168, 235, 0.5)',
                borderColor: 'rgba(0, 168, 235, 1)',
                cubicInterpolationMode: 'monotone'
            }, //{
                //label: 'Nombre doses réceptionnées - ' + nomRegion,
                //data: doses_recues_regions[numeroRegion]["valeurs"].map((value, idx) => ({x:doses_recues_regions[numeroRegion]["valeurs"], y: value})),
                //borderWidth: 3,
                //backgroundColor: 'rgba(0, 168, 235, 0.5)',
                //borderColor: 'rgba(0, 168, 235, 1)',
                //cubicInterpolationMode: 'monotone'
            //}
            ];
            let labels = vaccinesRegionsHistorique[numeroRegion].map(val => val.date);
            $('#region-graphique-detail').show();

            updateData(labels, datasets);
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


        function updateData(labels, datasets) {
            let chart = document.getElementById('chartRegionDetail');

            // Graphique courbe d'une région
            var lineChartRegion = new Chart(chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
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