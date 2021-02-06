<!-- wp:html -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

<p>h</p>

<!--
<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">
<b>11 janvier - Message important sur les données</b><br>
Lors du lancement de VaccinTracker le 27 décembre (jour du début de la campagne vaccinale), initiative indépendante, aucune donnée officielle de vaccination n’était disponible. Nous avons alors commencé à chercher, collecter et sommer les données publiées notamment dans la presse locale. Le Ministère de la Santé a contacté CovidTracker le 30 décembre afin de lui fournir des données officielles, plus exhaustives et à jour. Depuis, nous recevons régulièrement un nouveau chiffre du nombre de vaccinés de sa part, et nous le remercions pour cela. Cependant, cette situation n’est pas conforme avec nos principes d’OpenData. <b>VaccinTracker ne sera désormais mis à jour qu’à partir de données publiques officielles, dès que celles-ci seront disponibles.</b>
</div>
-->

<div id="news"></div>

<div class="alert alert-info clearFix"  style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍩 Offrez-moi un donut</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>
<div shadow="">
    <div style="border: 0.5px solid lightgrey; border-radius: 7px; padding: 10px;">
    <b>Données</b>
        <div class="row">
            <div class="col-xs-3">
                Type :
                <select name="type" id="typeDonees" onchange="buildChart()">
                    <option value="incidence">Taux d'incidence</option>
                    <option value="hospitalisations">Hospitalisations</option>
                    <option value="reanimations">Réanimations</option>
                    <option value="deces_hospitaliers">Décès hospitaliers</option>
                </select>
            </div>

            <div class="col-xs-4">
                Territoire :
                <select name="type" id="territoireDonnees" onchange="buildChart()">
                    <option value="france">France</option>
                </select>
            </div>

        </div>
    </div>


    <div class="chart-container" style="position: relative; height:80vh; width:100%">
        <canvas id="dataExplorerChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
    </div>
</div>

<style>
div[shadow] {
    border: 0px solid black;
    padding: 10px 20px;
    border-radius: 7px;
    text-align: center;
    box-shadow: 6px 4px 25px #d6d6d6;
}
</style>

<script>
var dataExplorerChart;
var selected_data=["hospitalisations", "incidence", "reanimations", "deces_hospitaliers"];
var data;

function buildChart(){
    dataExplorerChart.data.datasets = []
    selected_data = [document.getElementById("typeDonees").value]
    selected_territoire = [document.getElementById("territoireDonnees").value]
    selected_data.map((value, idx) => {
        addTrace(value, selected_territoire[idx]);
    })
}

function populateTerritoireSelect(){
    var x = document.getElementById("territoireDonnees");
    data.regions.map((region, idx) => {
        var option = document.createElement("option");
        option.text = region;
        option.value = region;
        x.add(option);
    })
    
}
fetchData();
function fetchData(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dataexplorer.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.data = json;
                populateTerritoireSelect();
                buildChart()
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x")
        }
        )
}

function addTrace(value, territoire){
    console.log(value)
    data_temp = data[territoire][value]["valeur"].map((val, idx) => ({x: data[territoire][value]["jour"][idx], y: val}))
    console.log(data)
    
    dataExplorerChart.data.datasets.push({
        yAxisID: value,
        label: value + " " + territoire,
        data: data_temp,
        pointRadius: 0.5,
        backgroundColor: 'rgba(0, 168, 235, 0.2)',
        borderColor: 'rgba(0, 168, 235, 1)',
        cubicInterpolationMode: 'monotone'
    })

    dataExplorerChart.options.scales.yAxes.push({
        id: value,
        display: false,
        gridLines: {
                        display: false
                    },
    })
    
    dataExplorerChart.update();
}

buildEmptyChart();
function buildEmptyChart() {
    var ctx = document.getElementById('dataExplorerChart').getContext('2d');

    this.dataExplorerChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: []
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: true
            },
            scales: {
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        min: 0
                    },

                }],
                xAxes: [{
                    type: 'time',
                    distribution: 'linear',
                    gridLines: {
                        display: false
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


</script>