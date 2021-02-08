<!-- wp:html -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/google-palette/1.1.0/palette.js" integrity="sha512-C8lBe+d5Peg8kU+0fyU+JfoDIf0kP1rQBuPwRSBNHqqvqaPu+rkjlY0zPPAqdJOLSFlVI+Wku32S7La7eFhvlA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />

<p>CovidExplorer est un outil de CovidTracker permettant d'explorer les données de l'épidémie en France. Sélectionnez un type de données ainsi qu'un ou plusieurs territoires ci-dessous, puis la courbe s'affichera à droite (ou en-dessous sur mobile). <i>Cette page est encore en cours de construction, d'autres fonctionnalités arriveront progressivement.</i> <i>Dernière donnée : <span id="dateDonnee">--/--</span>.</i></p>

<?php include(__DIR__ . '/styles.php'); ?>

<!--
<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">
<b>11 janvier - Message important sur les données</b><br>
Lors du lancement de VaccinTracker le 27 décembre (jour du début de la campagne vaccinale), initiative indépendante, aucune donnée officielle de vaccination n’était disponible. Nous avons alors commencé à chercher, collecter et sommer les données publiées notamment dans la presse locale. Le Ministère de la Santé a contacté CovidTracker le 30 décembre afin de lui fournir des données officielles, plus exhaustives et à jour. Depuis, nous recevons régulièrement un nouveau chiffre du nombre de vaccinés de sa part, et nous le remercions pour cela. Cependant, cette situation n’est pas conforme avec nos principes d’OpenData. <b>VaccinTracker ne sera désormais mis à jour qu’à partir de données publiques officielles, dès que celles-ci seront disponibles.</b>
</div>
-->


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

        <div class="col-sm-3" style="min-width: 100px;">
        <h2>CovidExplorer</h2><br>
            <b>Donnée à afficher</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    
                <select name="type" id="typeDonees" onchange="buildChart()" style="margin-top:10px;">
                    <option value="incidence">Taux d'incidence</option>
                    <option value="cas">Cas positifs</option>
                    <option value="tests">Dépistage</option>
                    <option value="taux_positivite">Taux de positivite</option>
                    <option value="hospitalisations">Hospitalisations</option>
                    <option value="reanimations">Réanimations</option>
                    <option value="deces_hospitaliers">Décès hospitaliers</option>
                </select>
                <br>
                <input type='checkbox' id='pour100k' onchange="pour100kChecked()" style="margin-bottom:10px;"> Pour 100 k habitants
                
                </div>
            <br>
            
            <label>Territoires</label>
            <div id="checkboxes" style="text-align: left; overflow-y:scroll; padding: 10px; border-radius: 7px; height: 550px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                
                
                    <input type='checkbox' id='france' checked onchange="boxChecked('france')"> France<br>
                    <span id="territoiresCheckboxes"></span>
                
            </div>
        </div>
        
        <div class="col-sm-9" style="min-width: 300px;">
        <h3 id="titre">Chargement...</h3>
        <span id="description">...</span>
            <div class="chart-container" style="position: relative; height:70vh; width:90%">
                <canvas id="dataExplorerChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
                
            </div>
            <div id="sliderUI" style="margin-top:10px; margin-bottom: 10px;"></div>
            <!--
            <div class="slidecontainer" style="margin-top: 10px; margin-bottom: 5px;">
                    <input type="range" min="0" max="1" value="0" class="slider" id="timeSlider" oninput="changeTime()" onchange="changeTime()">
                </div>
                -->
        </div>
    </div>
</div>

<?php include(__DIR__ . '/menuBasPage.php'); ?>
<br><br>

<script>


var dataExplorerChart;
var selected_data=["incidence"];
var selected_territoires=["france"];
var data;
var seq = palette('tol', 12);
var pour100k = false;

var descriptions = {
    "hospitalisations": "Nombre de lits occupés à l'hôpital pour Covid19.",
    "incidence": "Nombre de cas par semaine pour 100 000 habitants.",
    "taux_positivite": "Proportion des tests qui sont positifs (en %).",
    "reanimations": "Nombre de lits de réanimation occupés à l'hôpital pour Covid19.",
    "deces_hospitaliers": "Nombre de décès quotidiens pour Covid19 à l'hôpital (moyenne glissante 7j.).",
    "cas": "Nombre de tests positifs quotidiens (RT-PCR et antigéniques) (moyenne glissante 7j.).",
    "tests": "Nombre de tests quotidiens (positifs et négatifs) (moyenne glissante 7j.)."
}

var titres = {
    "hospitalisations": "Hospitalisations",
    "incidence": "Taux d'incidence",
    "taux_positivite": "Taux de positivité",
    "reanimations": "Réanimations",
    "deces_hospitaliers": "Décès hospitaliers",
    "cas": "Cas positifs",
    "tests": "Dépistage",
}

var credits = "<br><small>CovidTracker.fr - Données : Santé publique France</small>"
let incompatibles_pour100k = ["incidence", "taux_positivite"]

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

function pour100kChecked(){
    pour100k = !pour100k;
    buildChart();
}

function changeTime(){
    let selected_data = document.getElementById("typeDonees").value
    let idx = document.getElementById('sliderUI').noUiSlider.get(); // document.getElementById("timeSlider").value
    
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])
    console.log(idx_min)
    dataExplorerChart.options.scales.xAxes[0].ticks = {
        min: data["france"][selected_data]["jour"][idx_min],
        max: data["france"][selected_data]["jour"][idx_max]
        }
    //console.log(dataExplorerChart.options.scales.xAxes.time)
    dataExplorerChart.update()

}

function checkPour100k(selected_data){
    
    if (selected_data == "incidence"){
        document.getElementById("pour100k").checked = true;
        document.getElementById("pour100k").setAttribute("disabled", "");
        return false;

    } else if (selected_data == "taux_positivite") {
        console.log(document.getElementById("pour100k").attributes)
        
        document.getElementById("pour100k").checked = false;
        document.getElementById("pour100k").setAttribute("disabled", "");
        return false;
    } else {
        document.getElementById("pour100k").removeAttribute("disabled");
        if(!pour100k){
            document.getElementById("pour100k").checked = false;
        }

        return pour100k;
    }
}

function updateSlider(){
    var sliderNoUi = document.getElementById('sliderUI');

    let selected_data = document.getElementById("typeDonees").value
    //let slider = document.getElementById("timeSlider");

    let N = data["france"][selected_data]["jour"].length;

    sliderNoUi.noUiSlider.updateOptions({
        range: {
            'min': 0,
            'max': N-1
        }
    });

    sliderNoUi.noUiSlider.set([0, N-1])

    //slider.max = N-1;  
}

function buildChart(){
    
    updateSlider();
    dataExplorerChart.destroy();
    buildEmptyChart();

    dataExplorerChart.data.datasets = []
    dataExplorerChart.options.scales.yAxes = []
    selected_data = [document.getElementById("typeDonees").value]

    pour100k_temp = checkPour100k(selected_data[0]);

    selected_territoires.map((value, idx) => {
        addTrace(selected_data[0], value, pour100k_temp);
    })
    document.getElementById("titre").innerHTML = titres[selected_data[0]];

    if (pour100k){
        if(! incompatibles_pour100k.includes(selected_data[0])){
            document.getElementById("titre").innerHTML += " pour 100k habitants";
        }
    }
    document.getElementById("description").innerHTML = descriptions[selected_data[0]] + credits;
}

function populateTerritoireSelect(){
    var x = document.getElementById("territoireDonnees");
    var html_code = "";
    html_code += "<br><i>Régions</i><br>"
    data.regions.map((region, idx) => {
        html_code += "<input type='checkbox' id='" + replaceBadCharacters(region) + "' onchange='boxChecked(\"" + replaceBadCharacters(region) +"\")'> "+ region +"<br>"

    })
    html_code += "<br><i>Départements</i><br>"
    
    data.departements.map((departement, idx) => {
        complement = " ";
        if (departement in data["departements_noms"]) {
            complement += data["departements_noms"][departement];
        }

        html_code += "<input type='checkbox' id='" + replaceBadCharacters(departement) + "' onchange='boxChecked(\"" + replaceBadCharacters(departement) +"\")'> "+ departement + complement +"<br>"

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
                buildSlider();
                buildChart()

                majDataUpdate();
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x")
        }
        )
}

function majDataUpdate(){
    let N = data["france"]["hospitalisations"]["jour"].length;
    document.getElementById("dateDonnee").innerHTML = data["france"]["hospitalisations"]["jour"][N-1];
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

function addTrace(value, territoire, pour100k_temp){
    diviseur = 1;
    if (pour100k_temp){
        diviseur = data[territoire]["population"]/100000;
    }
    data_temp = data[territoire][value]["valeur"].map((val, idx) => ({x: data[territoire][value]["jour"][idx], y: val/diviseur}))
    
    var N = dataExplorerChart.data.datasets.length
    if(N>=10){
        N = 0
    }

    complement = " ";
    if (territoire in data["departements_noms"]) {
        complement += data["departements_noms"][territoire];
    }

    dataExplorerChart.data.datasets.push({
        yAxisID: value,
        label: territoire + complement,
        data: data_temp,
        pointRadius: 0.5,
        backgroundColor: 'rgba(0, 168, 235, 0)',
        borderColor: "#"+seq[N],
        cubicInterpolationMode: 'monotone'
    })

    dataExplorerChart.options.scales.yAxes.push({
        id: value,
        display: true,
        gridLines: {
                        display: true
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

function buildSlider(){
    var slider = document.getElementById('sliderUI');

    noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        step: 1,
        range: {
            'min': 0,
            'max': 100,

        }
    });

    slider.noUiSlider.on('update', function (values, handle) {
        changeTime()
    });
}

</script>

<style>

.noUi-connect {
    background-color: rgba(0, 0, 0, 0.2);
  }


</style>
