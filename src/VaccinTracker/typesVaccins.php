<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js" integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.js" integrity="sha512-o2vKsxnxl66o5bM3x+Z4jvweDAM7DMShyXHQ5C8bWsm2aOJKmJl1V5JtRjoZpHJfdas3VPpzXngtikzo7u4rcw==" crossorigin="anonymous"></script>

<h2 id="types-vaccins" style="margin-top : 80px;">Par type de vaccin</h2>
<div class="row">
<div class="col-sm-12">
    <h3>Doses injectées</h3>
    Le cumul des premières et secondes injections est considéré.<br><br>
</div>

    <div class='col-sm-4'>
        <div class="chart-container" style="position: relative; height:60vh; width:100%">
            <canvas id="barChartTypesVaccins" style="margin-top:20px; max-height: 700px; max-width: 50vw;"></canvas>
        </div>
        <span><i><br><br>Cliquez sur un élément du graphique en barre pour l'afficher en détail.</i></span>
    </div>

    <div class = "col-sm-8" shadow="">
    
    <span id=titreTypeVaccin><i><br><br>Cumul doses injectées</i></span>
    <div id="boutonFermer"></div>
        <div class="chart-container" style="position: relative; ">
            <canvas id="lineChartTypesVaccins" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
        </div>
    </div>
</div>

<h3 style="margin-top: 40px;">Livraisons</h3>
Livraisons passées ou officiellement prévues pour les prochaines semaines par type de vaccin.
<div class="chart-container" style="position: relative; ">
        <canvas id="lineChartTypesVaccinsLivraisons" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
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
                //console.log(typesVaccins)
                buildChartTypesVaccins();
                buildLineTypeChart_tous();
                nextFetch();
                
                
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("error-types")
                }
            )
}

function nextFetch(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/flux-tot-nat.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.typesVaccinsLivraisons = json;
                console.log('----');
                console.log(json);
                buildLineTypeChartLivraisons();
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("error-types-livraisons")
                }
            )
}


var barChartTypesVaccins;
var colors=["#1796e6", "#ef9a9a", "#B39DDB", "#21d421"]

function buildChartTypesVaccins(){
        var ctx = document.getElementById('barChartTypesVaccins').getContext('2d');
        N1 = typesVaccins["1"]["jour"].length-1
        N2 = typesVaccins["2"]["jour"].length-1
        N3 = typesVaccins["3"]["jour"].length-1
        N4 = typesVaccins["4"]["jour"].length-1

        this.barChartTypesVaccins = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: ["Vaccinations cumulées"],
                datasets: [
                    {
                    label: typesVaccins.noms_vaccins[1-1],
                    data: [{y: typesVaccins["1"]["n_cum_dose1"][N1]+typesVaccins["1"]["n_cum_dose2"][N1], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[0],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: typesVaccins.noms_vaccins[2-1],
                    data: [{y: typesVaccins["2"]["n_cum_dose1"][N2]+typesVaccins["2"]["n_cum_dose2"][N2], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[1],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: typesVaccins.noms_vaccins[3-1],
                    data: [{y: typesVaccins["3"]["n_cum_dose1"][N3] + typesVaccins["3"]["n_cum_dose2"][N3], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[2],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: typesVaccins.noms_vaccins[4-1],
                    data: [{y: typesVaccins["4"]["n_cum_dose1"][N4] + typesVaccins["4"]["n_cum_dose2"][N4], x:"Vaccinations cumulées"}],
                    borderWidth: 3,
                    backgroundColor: colors[3],
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
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
                                        return value/1000000 +" M";
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
        typeVaccin = typeVaccin.toString()
        //console.log(typesVaccinsLivraisons)
        N_livraisons = typesVaccinsLivraisons[typeVaccin].nb_doses_tot_cumsum.length
        max_value = typesVaccinsLivraisons[typeVaccin].nb_doses_tot_cumsum[N_livraisons-1]

        document.getElementById("boutonFermer").innerHTML = "<button onclick='fermerPanneauTypes()' style='padding: 2px 5px 2px 5px; font-size: 13px;'>Afficher tous les vaccins</button>"
        var ctx = document.getElementById('lineChartTypesVaccins').getContext('2d');
        this.lineChartTypeVaccin.destroy()
        this.lineChartTypeVaccin = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: labels,
                datasets: [
                    {
                        yAxisID:"injections",
                        label: 'Premières doses injectées ',
                        data: typesVaccins[typeVaccin.toString()].jour.map((day, idx) => ({x: day, y: typesVaccins[typeVaccin.toString()].n_cum_dose1[idx]})),
                        borderWidth: 1,
                        backgroundColor: "lightblue",
                        borderColor: "lightblue",
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections",
                        label: 'Secondes doses injectées ',
                        data: typesVaccins[typeVaccin.toString()].jour.map((day, idx) => ({x: day, y: typesVaccins[typeVaccin.toString()].n_cum_dose2[idx]})),
                        borderWidth: 1,
                        backgroundColor: "#1796e6",
                        borderColor: "#1796e6",
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections_stock",
                        label: 'Livraisons (passées et planifiées) ',
                        data: typesVaccinsLivraisons[typeVaccin].jour.map((day, idx) => ({x: moment(day).add(-3, 'd'), y: typesVaccinsLivraisons[typeVaccin].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 3,
                        borderColor: "grey",
                        pointRadius: 0,
                        pointHitRadius: 1,
                        steppedLine: true,
                    }
                    
                ]
            },
            options: {
                aspectRatio: 0.7,
                maintainAspectRatio: true,
                tooltips: {
                    mode: 'x',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value.toString();
                        }
                    }
                },
                hover: {
                    intersect: false,
                    mode: 'x'
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
                        stacked: true,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            max: max_value, 
                            callback: function (value) {
                                        return value/1000 +" k";
                                    }
                        }
                    }, {
                        id:"injections_stock",
                        display: false,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            max: max_value,
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

    function fermerPanneauTypes(){
        this.lineChartTypeVaccin.destroy()
        buildLineTypeChart_tous()
    }

    var lineChartTypeVaccinLivraisons;
    function buildLineTypeChartLivraisons(){
        
        var ctx = document.getElementById('lineChartTypesVaccinsLivraisons').getContext('2d');
        
        this.lineChartTypeVaccinLivraisons = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: labels,
                datasets: [
                    {
                        yAxisID:"livraisons",
                        label: typesVaccinsLivraisons.noms_vaccins[1-1] + " ",
                        data: typesVaccinsLivraisons[1].jour.map((day, idx) => ({x: day, y: typesVaccinsLivraisons[1].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: colors[1-1],
                        borderColor: colors[1-1],
                        pointRadius: 0,
                        pointHitRadius: 5,
                    },
                    {
                        yAxisID:"livraisons",
                        label: typesVaccinsLivraisons.noms_vaccins[2-1] + " ",
                        data: typesVaccinsLivraisons[2].jour.map((day, idx) => ({x: day, y: typesVaccinsLivraisons[2].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: colors[2-1],
                        borderColor: colors[2-1],
                        pointRadius: 0,
                        pointHitRadius: 5,
                    },
                    {
                        yAxisID:"livraisons",
                        label: typesVaccinsLivraisons.noms_vaccins[3-1] + " ",
                        data: typesVaccinsLivraisons[3].jour.map((day, idx) => ({x: day, y: typesVaccinsLivraisons[3].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: colors[3-1],
                        borderColor: colors[3-1],
                        pointRadius: 0,
                        pointHitRadius: 5,
                    },
                    {
                        yAxisID:"livraisons",
                        label: typesVaccinsLivraisons.noms_vaccins[4-1] + " ",
                        data: typesVaccinsLivraisons[4].jour.map((day, idx) => ({x: day, y: typesVaccinsLivraisons[4].nb_doses_tot_cumsum[idx]})),
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: colors[4-1],
                        borderColor: colors[4-1],
                        pointRadius: 0,
                        pointHitRadius: 5,
                    },
                ]
            },
            options: {
                aspectRatio: 0.7,
                maintainAspectRatio: true,
                tooltips: {
                    mode: 'x',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value.toString();
                        }
                    }
                },
                hover: {
                    intersect: false,
                    mode: 'x'
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
                        id:"livraisons",
                        stacked: true,
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
                        //stacked: true,
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
                        {
                            drawTime: "afterDatasetsDraw",
                            type: "line",
                            mode: "vertical",
                            scaleID: "x-axis-0",
                            value: moment(),
                            borderWidth: 2,
                            borderColor: "black",
                            label: {
                                content: "Aujourd'hui",
                                enabled: true,
                                position: "top"
                            }
                        }
                    ]
                }
            }
        });

    }

    function buildLineTypeChart_tous(){
        document.getElementById("boutonFermer").innerHTML = "";
        
        var ctx = document.getElementById('lineChartTypesVaccins').getContext('2d');

        document.getElementById("titreTypeVaccin").innerHTML = "<h3>Cumul doses injectées</h3>"
        
        this.lineChartTypeVaccin = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: labels,
                datasets: [
                    {
                        yAxisID:"injections",
                        label: typesVaccins.noms_vaccins[1-1] + " ",
                        data: typesVaccins["1"].jour.map((day, idx) => ({x: day, y: typesVaccins["1"].n_cum_dose1[idx]+typesVaccins["1"].n_cum_dose2[idx]})),
                        borderWidth: 4,
                        fill: false,
                        backgroundColor: colors[1-1],
                        borderColor: colors[1-1],
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections",
                        label: typesVaccins.noms_vaccins[2-1] + " ",
                        data: typesVaccins["2"].jour.map((day, idx) => ({x: day, y: typesVaccins["2"].n_cum_dose1[idx]+typesVaccins["2"].n_cum_dose2[idx]})),
                        borderWidth: 4,
                        fill: false,
                        backgroundColor: colors[2-1],
                        borderColor: colors[2-1],
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections",
                        label: typesVaccins.noms_vaccins[3-1] + " ",
                        data: typesVaccins["3"].jour.map((day, idx) => ({x: day, y: typesVaccins["3"].n_cum_dose1[idx]+typesVaccins["3"].n_cum_dose2[idx]})),
                        borderWidth: 4,
                        fill: false,
                        backgroundColor: colors[3-1],
                        borderColor: colors[3-1],
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections",
                        label: typesVaccins.noms_vaccins[4-1] + " ",
                        data: typesVaccins["4"].jour.map((day, idx) => ({x: day, y: typesVaccins["4"].n_cum_dose1[idx]+typesVaccins["4"].n_cum_dose2[idx]})),
                        borderWidth: 4,
                        fill: false,
                        backgroundColor: colors[4-1],
                        borderColor: colors[4-1],
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                ]
            },
            options: {
                aspectRatio: 0.7,
                maintainAspectRatio: true,
                tooltips: {
                    mode: 'x',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value.toString();
                        }
                    }
                },
                hover: {
                    intersect: false,
                    mode: 'x'
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
                        //stacked: true,
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
                        //stacked: true,
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