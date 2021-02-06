<!-- wp:html -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/google-palette/1.1.0/palette.js" integrity="sha512-C8lBe+d5Peg8kU+0fyU+JfoDIf0kP1rQBuPwRSBNHqqvqaPu+rkjlY0zPPAqdJOLSFlVI+Wku32S7La7eFhvlA==" crossorigin="anonymous"></script>
<p>h</p>

<!--
<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">
<b>11 janvier - Message important sur les données</b><br>
Lors du lancement de VaccinTracker le 27 décembre (jour du début de la campagne vaccinale), initiative indépendante, aucune donnée officielle de vaccination n’était disponible. Nous avons alors commencé à chercher, collecter et sommer les données publiées notamment dans la presse locale. Le Ministère de la Santé a contacté CovidTracker le 30 décembre afin de lui fournir des données officielles, plus exhaustives et à jour. Depuis, nous recevons régulièrement un nouveau chiffre du nombre de vaccinés de sa part, et nous le remercions pour cela. Cependant, cette situation n’est pas conforme avec nos principes d’OpenData. <b>VaccinTracker ne sera désormais mis à jour qu’à partir de données publiques officielles, dès que celles-ci seront disponibles.</b>
</div>
-->



<style>
#checkboxes label {
  float: left;
}
#checkboxes ul {
  margin: 0;
  list-style: none;
  float: left;
}
</style>

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
    

    <div class="row">

        <div class="col-sm-2" style="min-width: 100px;">
                <b>Données</b>
                <select name="type" id="typeDonees" onchange="buildChart()">
                    <option value="incidence">Taux d'incidence</option>
                    <option value="taux_positivite">Taux de positivite</option>
                    <option value="hospitalisations">Hospitalisations</option>
                    <option value="reanimations">Réanimations</option>
                    <option value="deces_hospitaliers">Décès hospitaliers</option>
                </select>
            <br>
            <br>
            <label>Territoires</label>
            <div id="checkboxes" style="text-align: left; overflow-y:scroll; height:500px;">
                
                <ul>
                    <li><input type='checkbox' id='france' checked onchange="boxChecked('france')"> France</li><br>
                    <span id="territoiresCheckboxes"></span>
                </ul>
            </div>
        </div>
        <div class="col-sm-10" style="min-width: 300px;">
            <div class="chart-container" style="position: relative; height:80vh; width:100%">
                <canvas id="dataExplorerChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
            </div>
        </div>
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
var selected_territoires=["france"];
var data;
var seq = palette('tol', 11);

function boxChecked(value){
    console.log(value)

    if (document.getElementById(value).checked) {
        selected_territoires.push(value);
    } else {
        selected_territoires = removeElementArray(selected_territoires, value);
        
    }
    console.log("territoires")
    console.log(selected_territoires)
    buildChart();

}

function buildChart(){
    dataExplorerChart.data.datasets = []
    selected_data = [document.getElementById("typeDonees").value]
    //selected_territoire = [document.getElementById("territoireDonnees").value]

    selected_territoires.map((value, idx) => {
        addTrace(selected_data[0], value);
    })
}

function populateTerritoireSelect(){
    var x = document.getElementById("territoireDonnees");
    var html_code = "";
    data.regions.map((region, idx) => {
        //var option = document.createElement("option");
        //option.text = region;
        //option.value = region;
        //x.add(option);
        
        html_code += "<li><input type='checkbox' id='" + replaceBadCharacters(region) + "' onchange='boxChecked(\"" + replaceBadCharacters(region) +"\")'> "+ region +"</li>"

    })

    document.getElementById("territoiresCheckboxes").innerHTML = html_code;
    
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
                //addTrace("incidence", "france");
                buildChart()
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x")
        }
        )
}

function removeElementArray(arr, element){
    for( var i = 0; i < arr.length; i++){
        if ( arr[i] === element) { 
            arr.splice(i, 1); 
            i--; 
        }
    }
    return arr
}

function replaceBadCharacters(dep){
    return dep.replace("'", "&apos;").replace("ô", "&ocirc;")
  }

function addTrace(value, territoire){
    console.log(value)
    data_temp = data[territoire][value]["valeur"].map((val, idx) => ({x: data[territoire][value]["jour"][idx], y: val}))
    console.log(data)
    
    var N = dataExplorerChart.data.datasets.length
    if(N>=10){
        N = 0
    }

    dataExplorerChart.data.datasets.push({
        yAxisID: value,
        label: territoire,
        data: data_temp,
        pointRadius: 0.5,
        backgroundColor: 'rgba(0, 168, 235, 0)',
        borderColor: "#"+seq[N],
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
            animation: {
                duration: 0
            },
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'top'
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