<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<div><p><i>CovidExplorer Niveaux Scolaires</i> permet d'explorer l'évolution dans les différentes tranches d'âge des niveaux scolaires. Il est possible de sélectionner une région en particulier, ou la France entière.</p>
</div>
<div shadow="" id="age_box">
    <div class="row">
        <div class="col-sm-3" style="min-width: 100px; max-width: 90%;">
        
        <span style="font-size: 200%"><b>CovidExplorer</b></span><br>
        
        <span style="font-size: 180%">Niveaux Scolaires</span><br><br>
            <b>Donnée à afficher</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    
                <select name="type" id="typeDoneesNiveauxScolaires" onchange="secureChangeTime_scolaire()" style="margin-top:10px;">
                    <optgroup label="Indicateurs épidémiques">
                        <option value="incidence">Taux d'incidence</option>
                        <option value="depistage">Taux de dépistage</option>
                        <option value="positivite">Taux de positivite</option>
                    </optgroup>
                </select>
                <br>
                </div>
            <br>

            <b>Territoire</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                <br>
                <select name="type" id="territoireNiveauxScolaires" onchange="buildChartNiveauxScolaires()" style="margin-top:10px;">
                    <optgroup label="">
                        <option value="france">France</option>
                    </optgroup>
                    
                </select>      
                <br><br>          
                </div>
            <br>
            <label>Tranches d'âge</label>
            <div id="checkboxes" style="text-align: left; height:300px; overflow-y:scroll; padding: 5px; border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    <span id="niveauxScolairesCheckboxes"></span>
            </div>
            <br>
            Animation<br>
            <a id="myLink" onclick="animation_niveaux_scolaires();"><i class="material-icons" style="cursor: pointer;">play_arrow</i></a>
            <a id="stop" onclick="stopExec_niveaux_scolaires();"><i class="material-icons" style="cursor: pointer;">stop</i></a>
        </div>
        
        <div class="col-sm-9" style="min-width: 300px;">
        <h3 id="niveaux_scolaires_titre">Chargement...</h3>
        <span id="niveaux_scolaires_description">...</span>
        <br>
        <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                alt="un triangle aux trois côtés égaux"
                height="87px"
                width="130px" 
        />
            <div class="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="age_dataExplorerNiveauxScolairesChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
                
            </div>
            <div id="sliderUINiveauxScolaires" style="margin-top:10px; margin-bottom: 10px;"></div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        Palette de couleurs : 
        <select name="type" id="age_colorniveaux_scolaires_seqSelect" onchange="niveaux_scolaires_changeColorniveaux_scolaires_seq()" style="margin-top:10px;" style="width:100%">
            <option value="mpn65">Par défaut (mpn65)</option>
            <option value="tol">tol</option>
            <option value="tol-dv">tol-dv</option>
            <option value="tol-sq">tol-sq</option>
            <option value="tol-rainbow">tol-rainbow</option>
            <option value="cb-Paired">cb-Paired </option>
            <option value="cb-BrBG">cb-BrBG</option>
        </select>
    </div>
</div>

<br>

<script>


var age_dataExplorerNiveauxScolairesChart;
var age_selected_niveaux_scolaires_data=["incidence"];
var niveaux_scolaires_selected_territoires=["france"];
var niveaux_scolaires_selected_tranches=["tous_scol"];
var niveaux_scolaires_data;
var niveaux_scolaires_seq = palette('mpn65', 40).slice(1, 40);
var associationTranchesNiveauxScolairesNoms = {}

var niveaux_scolaires_descriptions = {
    "incidence": "Nombre de cas par semaine pour 100 000 habitants.",
    "positivite": "Proportion des tests qui sont positifs (en %).",
    "depistage": "Nombre de tests effectués par semaine pour 100 000 habitants.",
}

var niveaux_scolaires_titres = {
    "incidence": "Taux d'incidence",
    "positivite": "Taux de positivité",
    "depistage": "Taux de dépistage",
}



var noms_tranches = {
    "zone_a": "Zone A",
    "zone_b": "Zone B",
    "zone_c": "Zone C",
    "france": "France"
}

function telechargerImage(){
    document.getElementById("link").href = age_dataExplorerNiveauxScolairesChart.toBase64Image()
}

var niveaux_scolaires_credits = ""//"<br><small>CovidTracker.fr/<b>CovidExplorer</b> - Données : Santé publique France</small>"

function boxNiveauxScolairesChecked(value){
    if (document.getElementById("niveaux_scolaires_"+value).checked) {
        niveaux_scolaires_selected_tranches.push(value);
    } else {
        niveaux_scolaires_selected_tranches = removeElementArray(niveaux_scolaires_selected_tranches, value);
        
    }
    buildChartNiveauxScolaires();

}

function niveaux_scolaires_changeColorniveaux_scolaires_seq(){
    let type_age_seq = document.getElementById("age_colorniveaux_scolaires_seqSelect").value;

    let N = 11;

    niveaux_scolaires_seq = palette(type_niveaux_scolaires_seq, N) 

    if(type_niveaux_scolaires_seq=="mpn65"){
        N=40;
        niveaux_scolaires_seq = palette(type_niveaux_scolaires_seq, N) 
        niveaux_scolaires_seq = niveaux_scolaires_seq.slice(1, 40)
    }

    buildChartNiveauxScolaires();

}

function indexOf_age(jour){
    var nom_jour = niveaux_scolaires_data["france"]["tous_scol"][age_selected_niveaux_scolaires_data]["jour_nom"]

    var to_return = true
    for (var idx = 0; idx < niveaux_scolaires_data["france"][nom_jour].length; idx++) {
        value = niveaux_scolaires_data["france"][nom_jour][idx]
        if ( moment(value) >= moment(jour) ){
            return idx;
            to_return = false;
            break;
        }
    }
    if(to_return){
        return 0;
    }
    
}

function secureChangeTime_scolaire(){
    var sliderNoUi = document.getElementById('sliderUINiveauxScolaires');
    let idx = document.getElementById('sliderUINiveauxScolaires').noUiSlider.get(); // document.getElementById("timeSlider").value
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    var nom_jour = niveaux_scolaires_data["france"]["tous_scol"][age_selected_niveaux_scolaires_data]["jour_nom"]
    let date_min = niveaux_scolaires_data["france"][nom_jour][idx_min]
    let date_max = niveaux_scolaires_data["france"][nom_jour][idx_max]

    buildChartNiveauxScolaires();
    
    var dmin = indexOf_age(date_min)
    var dmax = indexOf_age(date_max)

    var nom_jour = niveaux_scolaires_data["france"]["tous_scol"][age_selected_niveaux_scolaires_data]["jour_nom"]
    let N_temp = niveaux_scolaires_data["france"][nom_jour].length
    if(dmax==0){
        dmax = N_temp-1;
    }
    if((N_temp-dmax)<=10){
        dmax = N_temp-1;
    }

    sliderNoUi.noUiSlider.set([dmin, dmax])
    changeTimeNiveauxScolaires();
}

function changeTimeNiveauxScolaires(){
    
    let age_selected_niveaux_scolaires_data = document.getElementById("typeDoneesNiveauxScolaires").value
    let nom_jour = niveaux_scolaires_data["france"]["tous_scol"][age_selected_niveaux_scolaires_data]["jour_nom"]
    let idx = document.getElementById('sliderUINiveauxScolaires').noUiSlider.get(); // document.getElementById("timeSlider").value
    
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])
    
    let x_min = niveaux_scolaires_data["france"][nom_jour][idx_min]
    let x_max = niveaux_scolaires_data["france"][nom_jour][idx_max]
    
    age_dataExplorerNiveauxScolairesChart.options.scales.xAxes[0].ticks = {
        min: x_min,
        max: niveaux_scolaires_data["france"][nom_jour][idx_max]
        }
    var y_max = 0
    
    age_dataExplorerNiveauxScolairesChart.data.datasets.map((age_dataset, idx_age_dataset) => {
        
        age_dataset.data.map((value, idx_age_data) => {
            if(value.x >= x_min){
                if(value.x <= x_max){
                    if(value.y*1.1 > y_max){
                        y_max = value.y*1.1
                    }
                }
            }

        })
    })
    
    //if(age_selected_niveaux_scolaires_data=="cas_croissance_hebdo"){
       // y_max=200
    //}

    age_dataExplorerNiveauxScolairesChart.options.scales.yAxes.map((axis, idx) => {
        axis.ticks = {
        //min: 0,
        max: Math.round(y_max)
        }
    })
    
    age_dataExplorerNiveauxScolairesChart.update()

}

function stopExec_niveaux_scolaires(){
    clearTimeout(timeout_niveaux_scolaires)
}

var timeout_niveaux_scolaires;
function animation_niveaux_scolaires(){
    let slider = document.getElementById('sliderUINiveauxScolaires');
    let max = slider.noUiSlider.options.range.max

    var j = parseInt(slider.noUiSlider.get()[0])
    slider.noUiSlider.set([j, j+1])
    var i = parseInt(slider.noUiSlider.get()[1]); 

    function myLoop() {         //  create a loop function
        timeout_niveaux_scolaires = setTimeout(function() {   //  call a 3s setTimeout when the loop is called
            idx = slider.noUiSlider.get();
            slider.noUiSlider.set([parseInt(idx[0]), parseInt(idx[1])+1]);   //  your code here
            i++;                    //  increment the counter
            if (i < max) {           //  if the counter < 10, call the loop function
                myLoop();             //  ..  again which will trigger another 
            }                       //  ..  setTimeout()
        }, 30)
    }
    myLoop()

}

function updateSliderNiveauxScolaires(){
    var sliderNoUi = document.getElementById('sliderUINiveauxScolaires');

    let age_selected_niveaux_scolaires_data = document.getElementById("typeDoneesNiveauxScolaires").value
    
    let jour_nom = niveaux_scolaires_data["france"]["tous_scol"][age_selected_niveaux_scolaires_data]["jour_nom"]
    let N = niveaux_scolaires_data["france"][jour_nom].length;
    
    let idx = document.getElementById('sliderUINiveauxScolaires').noUiSlider.get();
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

function buildChartNiveauxScolaires(){

    updateSliderNiveauxScolaires();
    age_dataExplorerNiveauxScolairesChart.destroy();
    buildEmptyChartNiveauxScolaires();

    age_dataExplorerNiveauxScolairesChart.data.datasets = []
    age_dataExplorerNiveauxScolairesChart.options.scales.yAxes = []
    age_selected_niveaux_scolaires_data = [document.getElementById("typeDoneesNiveauxScolaires").value]
    var param_age={'fill': true, 'borderWidth': 4};

    if(niveaux_scolaires_selected_tranches.length>1){
        param_age['fill'] = false
        param_age['borderWidth'] = 3.5
    }
    if(niveaux_scolaires_selected_tranches.length>3){
        param_age['fill'] = false
        param_age['borderWidth'] = 3
    }
    if(niveaux_scolaires_selected_tranches.length>10){
        param_age['borderWidth'] = 2
    }
    if(document.querySelector('#territoireNiveauxScolaires option:checked').parentElement.label == "Départements"){
        if(document.querySelector('#typeDoneesNiveauxScolaires option:checked').parentElement.label == "Indicateurs sanitaires"){
            window.alert("Santé publique France ne publie pas les données hospitaliaires par tranche d'âge au niveau départemental. Merci de sélectionner un indicateur épidémique, ou de sélectionner un autre territoire (region, France entière).");
        }
    }
    niveaux_scolaires_selected_territoires.map((territoire_temp, idx_temp) => {
        niveaux_scolaires_selected_tranches.map((tranche, idx) => {
            addTraceNiveauxScolaires(age_selected_niveaux_scolaires_data[0], tranche, document.getElementById("territoireNiveauxScolaires").value, param_age);
        })
    })
    age_dataExplorerNiveauxScolairesChart.update();
    
    var territoire_temp = document.getElementById("territoireNiveauxScolaires").value
    if(territoire_temp in noms_zones){
        territoire_temp=noms_zones[territoire_temp]
    }

    document.getElementById("niveaux_scolaires_titre").innerHTML = niveaux_scolaires_titres[age_selected_niveaux_scolaires_data[0]] + " - " + territoire_temp;
    document.getElementById("niveaux_scolaires_description").innerHTML = niveaux_scolaires_descriptions[age_selected_niveaux_scolaires_data[0]] + niveaux_scolaires_credits;
    changeTimeNiveauxScolaires();
}

function populateNiveauxScolairesSelect(){
    console.log("enter populateNiveauxScolairesSelect")
    
    var html_code = "";
    //html_code += "<br><i>Tranches d'âge</i><br>"

    niveaux_scolaires_data.france.tranches_noms_scolaires.map((tranche, idx) => {
        complement = "";
        html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + "niveaux_scolaires_" + tranche + "' onchange='boxNiveauxScolairesChecked(\"" + tranche +"\")'> "+ niveaux_scolaires_data.france.tranches_noms_affichage_scolaires[idx] + complement + "</label></div>" + "<br>"
    })

    document.getElementById("niveauxScolairesCheckboxes").innerHTML = html_code;
    document.getElementById("niveaux_scolaires_tous_scol").checked = true;
    
    document.getElementById("niveaux_scolaires_"+niveaux_scolaires_data.france.tranches_noms_scolaires[1]).checked = true;
    document.getElementById("niveaux_scolaires_"+niveaux_scolaires_data.france.tranches_noms_scolaires[5]).checked = true;

    niveaux_scolaires_selected_tranches.push(niveaux_scolaires_data.france.tranches_noms_scolaires[1])
    niveaux_scolaires_selected_tranches.push(niveaux_scolaires_data.france.tranches_noms_scolaires[5])
    
    console.log("exit populateNiveauxScolairesSelect")
    
}

function truncate(value, n=15){
    if(value.length>n){
        if(value.slice(n)==" "){
            value.slice(0, n-1) + ".";
        }
        return value.slice(0, n) + ".";
    }
    return value;
}

function populateNiveauxScolairesTerritoires(){
    console.log("enter_populate_territoires ns")

    html_code = "<optgroup label='Régions'>"
    niveaux_scolaires_data.regions.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + truncate(niveaux_scolaires_data.regions_noms[idx]) + "</option>"
    })
    html_code += "</optgroup>"

    html_code += "<optgroup label='Départements'>"

    niveaux_scolaires_data.departements.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + value + " " + truncate(niveaux_scolaires_data.departements_noms[idx]) + "</option>"
    })
    html_code += "</optgroup>"

    document.getElementById("territoireNiveauxScolaires").innerHTML += html_code;
    console.log("exit_populate_territoires ns")
}

setTimeout(function () {
    fetchniveaux_scolaires_data();
        }, 500);

function fetchniveaux_scolaires_data(){
    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/dataexplorer_education.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.niveaux_scolaires_data = json;
                console.log("init-ns")
                associationTranchesNiveauxScolaires();
                console.log("association-ns")
                populateNiveauxScolairesSelect();
                console.log("populate-ns")
                populateNiveauxScolairesTerritoires()
                console.log("populate-territoires-ns")
                buildSliderNiveauxScolaires();
                console.log("done-ns")    
            })
        .catch(function () {
            this.niveaux_scolaires_dataError = true;
            console.log("error-x-ns")
        }
        )
}

function associationTranchesNiveauxScolaires(){
    console.log("enter associationTranchesNiveauxScolaires")
    console.log(niveaux_scolaires_data)
    niveaux_scolaires_data.france.tranches_noms_scolaires.map((value, idx) => {associationTranchesNiveauxScolairesNoms[value]=niveaux_scolaires_data.france.tranches_noms_affichage_scolaires[idx]})
    console.log("exit associationTranchesNiveauxScolaires")
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

function addTraceNiveauxScolaires(value, tranche, territoire_temp, param){
    diviseur = 1;
    
    var jour_nom = niveaux_scolaires_data[territoire_temp][tranche][value]["jour_nom"]

    y = 0
    array_data_age = niveaux_scolaires_data[territoire_temp][tranche][value]["valeur"]

    niveaux_scolaires_data_temp = array_data_age.map((val, idx) => ({x: niveaux_scolaires_data["france"][jour_nom][idx], y: val/diviseur}))
    
    var N = age_dataExplorerNiveauxScolairesChart.data.datasets.length
    if(N>=niveaux_scolaires_seq.length-1){
        N = 0
    }
    
    complement = " ";

    if(tranche in noms_tranches){
        tranche=noms_tranches[tranche]
    }
    
    hex_color="#"+niveaux_scolaires_seq[N];
    color=hexToRgbA(hex_color).match(/\d+/g);
    age_dataExplorerNiveauxScolairesChart.data.datasets.push({
        yAxisID: value,
        label: associationTranchesNiveauxScolairesNoms[tranche] + complement,
        data: niveaux_scolaires_data_temp,
        pointRadius: 0,
        fill: param['fill'],
        backgroundColor: `rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.2)`,
        borderColor: "#"+niveaux_scolaires_seq[N],
        borderWidth: param["borderWidth"],
        cubicInterpolationMode: 'monotone',
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#"+niveaux_scolaires_seq[N],
    })

    age_dataExplorerNiveauxScolairesChart.options.scales.yAxes.push({
        id: value,
        display: true,
        gridLines: {
                        display: true
                    },
    })
}

buildEmptyChartNiveauxScolaires();
function buildEmptyChartNiveauxScolaires() {
    var ctx = document.getElementById('age_dataExplorerNiveauxScolairesChart').getContext('2d');
    let vw=Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

    margin_right=120;
    if(vw>1000){
        margin_right=120;
    } else if(vw>800){
        margin_right=80;
    } else {
        margin_right=0;
    }

    this.age_dataExplorerNiveauxScolairesChart = new Chart(ctx, {
        type: 'line',
        niveaux_scolaires_data: {
            niveaux_scolaires_datasets: []
        },
        options: {
            layout: {
                padding: {
                    left: 0,
                    right: margin_right,
                    top: 0,
                    bottom: 0
                }
            },
            plugins: {
                datalabels: {
                    anchor: "end",
                    clamp: true,
                    align: 'right',
                    color: function(ctx) {
                        return ctx.dataset.borderColor
                    },
                    formatter: function(value, context) {
                        if (context.dataset.data[context.dataIndex].x == age_dataExplorerNiveauxScolairesChart.options.scales.xAxes[0].ticks.max)
                        {
                            value = context.dataset.data[context.dataset.data.length-1].y
                            value = (value*100).toFixed()/100
                            return  value + " • " + context.dataset.label;
                        }
                        return "";
                    }
                },
            },
            hover: {
                mode: 'index',
                intersect: false
            },
            tooltips: {
                mode: 'index',
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
                    //ticks: {
                        //min: 0
                    //},

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

function buildSliderNiveauxScolaires(){
    var slider = document.getElementById('sliderUINiveauxScolaires');

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
        changeTimeNiveauxScolaires()
    });
    buildChartNiveauxScolaires();
}

</script>
