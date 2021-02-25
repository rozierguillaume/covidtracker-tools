<h2 id="types-vaccins" style="margin-top : 80px;">Par type de vaccin</h2>
<div class="row">
<div class="col-sm-12">
    <h3>Nombre de personnes vaccinées</h3>
    Toutes les personnes ayant reçu au moins une dose de vaccin sont comptabilisées.<br><br>
</div>

    <div class='col-sm-4'>
        <div class="chart-container" style="position: relative; height:60vh; width:100%">
            <canvas id="barChartTypesVaccins" style="margin-top:20px; max-height: 700px; max-width: 50vw;"></canvas>
        </div>
    </div>

    <div class = "col-sm-8" shadow="">
        <span id=titreTypeVaccin><i><br><br>Cliquez sur un élément du graphique en barre pour l'afficher en détail.</i></span>

        <div class="chart-container" style="position: relative; height:60vh;">
            <canvas id="lineChartTypesVaccins" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
        </div>
    </div>
</div>

<script>
var typesVaccins;
var typesVaccinsLivraisons;

fetchTypesVaccins();
function fetchTypesVaccins(){
        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-v-fra.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.typesVaccins = json;
                console.log(typesVaccins)
                buildChartTypesVaccins();
                console.log(typesVaccins["1"]["n_dose1"][1])
                
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("error-types")
                }
            )

            fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/livraisons-v.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.typesVaccinsLivraisons = json;
                
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("error-types-livraisons")
                }
            )
}

var barChartTypesVaccins;
var colors=["#1796e6", "#a1cbe6", "#93b3c7"]

function buildChartTypesVaccins(){
        var ctx = document.getElementById('barChartTypesVaccins').getContext('2d');
        N1 = typesVaccins["1"]["jour"].length-1
        N2 = typesVaccins["2"]["jour"].length-1
        N3 = typesVaccins["3"]["jour"].length-1

        this.barChartTypesVaccins = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: ["Vaccinations cumulées (1ères doses)"],
                datasets: [
                    {
                    label: typesVaccins.noms_vaccins[1-1],
                    data: [{y: typesVaccins["1"]["n_cum_dose1"][N1], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[0],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: typesVaccins.noms_vaccins[2-1],
                    data: [{y: typesVaccins["2"]["n_cum_dose1"][N2], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[1],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: typesVaccins.noms_vaccins[3-1],
                    data: [{y: typesVaccins["3"]["n_cum_dose1"][N3], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[2],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                ]
            },
            options: {
                onClick: handleClick,
                maintainAspectRatio: false,
                scales: {
                            xAxes: [{
                                display: false,
                                gridLines: {
                                    display: true
                                },
                                stacked: true,
                                
                            }],
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                stacked: true,
                                ticks: {
                                    callback: function (value) {
                                        return value/1000 +" k";
                                    }
                                }
                            }]
                        },
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                    },
                annotation: {
                events: ["click"],
                annotations: [
                ]
            }
            }
        });
    }

    var lineChartTypeVaccin;
    function buildLineTypeChart(typeVaccin){
        var ctx = document.getElementById('lineChartTypesVaccins').getContext('2d');
        console.log(typesVaccinsLivraisons)
        this.lineChartTypeVaccin = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: labels,
                datasets: [
                    {
                        yAxisID:"injections",
                        label: 'Premières doses injectées ',
                        data: typesVaccins[typeVaccin.toString()].jour.map((day, idx) => ({x: day, y: typesVaccins[typeVaccin.toString()].n_cum_dose1[idx]})),
                        borderWidth: 3,
                        backgroundColor: "lightblue",
                        borderColor: colors[typeVaccin-1],
                        pointRadius: 2,
                    },
                    {
                        yAxisID:"injections",
                        label: 'Secondes doses injectées (données non fournies) ',
                        data: [],
                        borderWidth: 3,
                        backgroundColor: "#1796e6",
                        borderColor: colors[typeVaccin-1],
                        pointRadius: 2,
                    },
                    {
                        yAxisID:"injections",
                        label: 'Livraisons (passées et plannifiées) ',
                        data: typesVaccinsLivraisons[typeVaccin].jour.map((day, idx) => ({x: day, y: typesVaccinsLivraisons[typeVaccin].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 3,
                        borderColor: "grey",
                        pointRadius: 2,
                        steppedLine: true,
                    }
                    
                ]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value.toString();
                        }
                    }
                },
                maintainAspectRatio: false,
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                scales: {
                    yAxes: [{
                        id:"injections",
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            callback: function (value) {
                                        return value/1000 +" k";
                                    }
                        }
                    }],
                    xAxes: [{
                        ticks:{
                            source: 'auto'
                        },
                        type: 'time',
                        distribution: 'linear',
                        gridLines: {
                            display: false
                        }
                    }]
                },
                annotation: {
                    events: ["click"],
                    annotations: [
                    ]
                }
            }
        });
    
    }

    function handleClick(evt){
        var activeElement = barChartTypesVaccins.getElementAtEvent(evt);
        typeVaccin = activeElement[0]._datasetIndex + 1;
        //console.log(activeElement._chart.)
        buildLineTypeChart(typeVaccin);
        document.getElementById("titreTypeVaccin").innerHTML = "<h3>Vaccin " + typesVaccins.noms_vaccins[typeVaccin-1] + "</h3>"
    }


</script>