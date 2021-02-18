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
                    <optgroup label="Indicateurs épidémiques">
                        <option value="incidence">Taux d'incidence</option>
                        <option value="cas">Cas positifs</option>
                        <option value="tests">Dépistage</option>
                        <option value="taux_positivite">Taux de positivite</option>
                    </optgroup>
                    <optgroup label="Indicateurs sanitaires">
                        <option value="hospitalisations">Hospitalisations</option>
                        <option value="incid_hospitalisations">Admissions à l'hôpital</option>
                        <option value="reanimations">Réanimations</option>
                        <option value="incid_reanimations">Admissions en réanimation</option>
                    
                        <option value="nbre_acte_corona">Actes SOS médecin</option>
                        <option value="nbre_pass_corona">Passages aux urgences</option>
                        <option value="deces_hospitaliers">Décès hospitaliers</option>
                    </optgroup>
                </select>
                <br>
                <input type='checkbox' id='pour100k' onchange="pour100kChecked()" style="margin-bottom:10px;"> Pour 100 k habitants
                
                </div>
            <br>
            
            <label>Territoires</label>
            <div id="checkboxes" style="text-align: left; overflow-y:scroll; padding: 10px; border-radius: 7px; height: 550px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                
                
                    <div class="checkbox">
                        <label>
                            <input type='checkbox' id='france' checked onchange="boxChecked('france')">France
                        </label>
                    </div>
                    <br>
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

<div>
    Palette de couleurs : 
    <select name="type" id="colorSeqSelect" onchange="changeColorSeq()" style="margin-top:10px;">
        <option value="mpn65">Par défaut (mpn65)</option>
        <option value="tol">tol</option>
        <option value="tol-dv">tol-dv</option>
        <option value="tol-sq">tol-sq</option>
        <option value="tol-rainbow">tol-rainbow</option>
        <option value="cb-Paired">cb-Paired </option>
        <option value="cb-BrBG">cb-BrBG</option>
    </select>
</div>

<?php include(__DIR__ . '/menuBasPage.php'); ?>
<br><br>

<script>


var dataExplorerChart;
var selected_data=["incidence"];
var selected_territoires=["france"];
var data;
var seq = palette('mpn65', 40).slice(1, 40);
var pour100k = false;

var descriptions = {
    "hospitalisations": "Nombre de lits occupés à l'hôpital pour Covid19.",
    "incid_hospitalisations": "Nombre d'admissions quotidiennes à l'hôpital pour Covid19 (moyenne glissante 7 jours).",
    "incidence": "Nombre de cas par semaine pour 100 000 habitants.",
    "taux_positivite": "Proportion des tests qui sont positifs (en %).",
    "reanimations": "Nombre de lits de réanimation occupés à l'hôpital pour Covid19.",
    "incid_reanimations": "Nombre d'admissions quotidiennes en réanimation pour Covid19 (moyenne glissante 7 jours).",
    "deces_hospitaliers": "Nombre de décès quotidiens pour Covid19 à l'hôpital (moyenne glissante 7 jours).",
    "cas": "Nombre de tests positifs quotidiens (RT-PCR et antigéniques) (moyenne glissante 7 jours).",
    "tests": "Nombre de tests quotidiens (positifs et négatifs) (moyenne glissante 7 jours).",
    "nbre_acte_corona": "Nombre d'actes SOS médecin pour suspicion Covid19 (moyenne glissante 7 jours).",
    "nbre_pass_corona": "Nombre de passages aux urgences pour suspicion Covid19 (moyenne glissante 7 jours).",
}

var titres = {
    "hospitalisations": "Hospitalisations",
    "incid_hospitalisations": "Nouvelles admissions à l'hospital",
    "incidence": "Taux d'incidence",
    "taux_positivite": "Taux de positivité",
    "reanimations": "Réanimations",
    "incid_reanimations": "Nouvelles admissions en réanimation",
    "deces_hospitaliers": "Décès hospitaliers",
    "cas": "Cas positifs",
    "tests": "Dépistage",
    "nbre_acte_corona": "Actes SOS médecin pour Covid19",
    "nbre_pass_corona": "Passages aux urgences pour Covid19",
}

var noms_zones = {
    "zone_a": "Zone A",
    "zone_b": "Zone B",
    "zone_c": "Zone C"
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
    
    buildChart();

}

function pour100kChecked(){
    pour100k = !pour100k;
    buildChart();
}

function changeColorSeq(){
    let type_seq = document.getElementById("colorSeqSelect").value;
    console.log(type_seq)
    let N = 11;

    seq = palette(type_seq, N) 

    if(type_seq=="mpn65"){
        N=40;
        seq = palette(type_seq, N) 
        seq = seq.slice(1, 40)
    }

    buildChart();

}

function changeTime(){
    
    
    let selected_data = document.getElementById("typeDonees").value
    let nom_jour = data["france"][selected_data]["jour_nom"]
    
    let idx = document.getElementById('sliderUI').noUiSlider.get(); // document.getElementById("timeSlider").value
    
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])
    
    let x_min = data["france"][nom_jour][idx_min]

    dataExplorerChart.options.scales.xAxes[0].ticks = {
        min: x_min,
        max: data["france"][nom_jour][idx_max]
        }
    var y_max = 0
    dataExplorerChart.data.datasets.map((dataset, idx_dataset) => {
        dataset.data.map((value, idx_data) => {
            if(value.x > x_min){
                if(value.y*1.1 > y_max){
                    y_max = value.y*1.1
                }
            }

        })
    })

    dataExplorerChart.options.scales.yAxes.map((axis, idx) => {
        axis.ticks = {
        min: 0,
        max: y_max
        }
    })
    
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
    
    let jour_nom = data["france"][selected_data]["jour_nom"]
    let N = data["france"][jour_nom].length;
    
    let idx = document.getElementById('sliderUI').noUiSlider.get();
    let idx_min = 0
    let idx_max = N-1

    if (idx[1]<N){
        if(idx[1]!=0){
        idx_min = parseInt(idx[0])
        idx_max = parseInt(idx[1])
        }
    }
    sliderNoUi.noUiSlider.updateOptions({
        range: {
            'min': 0,
            'max': N-1
        }
    });

    sliderNoUi.noUiSlider.set([idx_min, idx_max])

    //slider.max = N-1;  
}

function buildChart(){
    
    updateSlider();
    dataExplorerChart.destroy();
    buildEmptyChart();
    changeTime();

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
        html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(region) + "' onchange='boxChecked(\"" + replaceBadCharacters(region) +"\")'> "+ region + "</label></div>" + "<br>"

    })
    html_code += "<br><i>Départements</i><br>"
    
    data.departements.map((departement, idx) => {
        complement = " ";
        if (departement in data["departements_noms"]) {
            complement += data["departements_noms"][departement];
        }

        html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(departement) + "' onchange='boxChecked(\"" + replaceBadCharacters(departement) +"\")'> "+ departement + complement + "</label></div>" + "<br>"

    })

    html_code += "<br><i>Zones de vacances</i><br>"
    
    data.zones_vacances.map((zone, idx) => {
        complement = " ";
        html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(zone) + "' onchange='boxChecked(\"" + replaceBadCharacters(zone) +"\")'> "+ noms_zones[zone] + complement + "</label></div>" + "<br>"

    })

    document.getElementById("territoiresCheckboxes").innerHTML = html_code;
    
}
fetchData();
function fetchData(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dataexplorer_compr.json', {cache: 'no-cache'})
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
                console.log("0")
                buildSlider();
                console.log("1")
                buildChart()
                console.log("2")
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
    var jour_nom = data[territoire][value]["jour_nom"]
    console.log(jour_nom)
    data_temp = data[territoire][value]["valeur"].map((val, idx) => ({x: data["france"][jour_nom][idx], y: val/diviseur}))
    
    var N = dataExplorerChart.data.datasets.length
    if(N>=seq.length-1){
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
        pointRadius: 0,
        backgroundColor: 'rgba(0, 168, 235, 0)',
        borderColor: "#"+seq[N],
        cubicInterpolationMode: 'monotone',
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#"+seq[N],
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
            hover: {
                intersect: false
            },
            tooltips: {
                mode: 'x',
                intersect: false
            },
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
        start: [0, 0],
        connect: true,
        behaviour: 'drag',
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

<style type="text/css">
    .checkbox {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .noUi-connect {
    background-color: rgba(0, 0, 0, 0.2);
    }
</style>
