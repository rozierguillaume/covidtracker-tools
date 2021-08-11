<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<div><p><i>CovidExplorer Tranches d'âge</i> permet d'explorer l'évolution dans les différentes tranches d'âge. Il est possible de sélectionner une région en particulier, ou la France entière.</p>
</div>
<div shadow="" id="age_box">
    <div class="row">
        <div class="col-sm-3" style="min-width: 100px; max-width: 90%;">
        
        <span style="font-size: 200%"><b>CovidExplorer</b></span><br>
        
        <span style="font-size: 180%">Tranches d'âge</span><br><br>
            <b>Donnée à afficher</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    
                <select name="type" id="typeDoneesAge" onchange="secureChangeTime_age()" style="margin-top:10px;">
                    <optgroup label="Indicateurs épidémiques">
                        <option value="incidence">Taux d'incidence</option>
                        <option value="cas">Cas positifs</option>
                        <option value="cas_croissance_hebdo">Croissance cas pos.</option>
                        <option value="tests">Dépistage</option>
                        <option value="taux_positivite">Taux de positivite</option>
                    </optgroup>
                    <optgroup label="Indicateurs sanitaires">
                        <option value="hospitalisations">Hospitalisations</option>
                        <option value="reanimations">Réanimations</option>
                        <option value="deces_hospitaliers">Décès hospitaliers</option>
                    </optgroup>
                </select>
                <br>
                <input type='checkbox' id='age_pour100kAge' onchange="age_pour100kAgeChecked()" style="margin-bottom:10px;"> Pour 100 k habitants<br>
                <input type='checkbox' id='age_cumsum' onchange="age_cumSumChecked()" style="margin-bottom:10px;"> Somme cumulée
                </div>
            <br>

            <b>Territoire</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                <br>
                <select name="type" id="territoireAge" onchange="buildChartAge()" style="margin-top:10px;">
                    <optgroup label="">
                        <option value="france">France</option>
                    </optgroup>
                    
                </select>      
                <br><br>          
                </div>
            <br>
            <label>Tranches d'âge</label>
            <div id="checkboxes" style="text-align: left; height:300px; overflow-y:scroll; padding: 5px; border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    <span id="agesCheckboxes"></span>
            </div>
            <br>
            Animation<br>
            <a id="myLink" onclick="animation_age();"><i class="material-icons" style="cursor: pointer;">play_arrow</i></a>
            <a id="stop" onclick="stopExec_age();"><i class="material-icons" style="cursor: pointer;">stop</i></a>
        </div>
        
        <div class="col-sm-9" style="min-width: 300px;">
        <h3 id="age_titre">Chargement...</h3>
        <span id="age_description">...</span>
        <br>
        <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                alt="un triangle aux trois côtés égaux"
                height="87px"
                width="130px" 
        />
            <div class="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="age_dataExplorerAgeChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
                
            </div>
            <div id="sliderUIAge" style="margin-top:10px; margin-bottom: 10px;"></div>
            <!--
            <div class="slidecontainer" style="margin-top: 10px; margin-bottom: 5px;">
                    <input type="range" min="0" max="1" value="0" class="slider" id="timeSlider" oninput="changeTimeAge()" onchange="changeTimeAge()">
                </div>
                -->
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        Palette de couleurs : 
        <select name="type" id="age_colorage_seqSelect" onchange="age_changeColorage_seq()" style="margin-top:10px;" style="width:100%">
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


var age_dataExplorerAgeChart;
var age_selected_age_data=["incidence"];
var age_selected_territoires=["france"];
var age_selected_tranches=["tous"];
var age_data;
var age_seq = palette('mpn65', 40).slice(1, 40);
var age_pour100k = false;
var age_cumsum = false;
var associationTranchesNoms = {}

var age_descriptions = {
    "hospitalisations": "Nombre de lits occupés à l'hôpital pour Covid19.",
    "incid_hospitalisations": "Nombre d'admissions quotidiennes à l'hôpital pour Covid19 (moyenne glissante 7 jours).",
    "incidence": "Nombre de cas par semaine pour 100 000 habitants.",
    "taux_positivite": "Proportion des tests qui sont positifs (en %).",
    "reanimations": "Nombre de lits de réanimation occupés à l'hôpital pour Covid19.",
    "incid_reanimations": "Nombre d'admissions quotidiennes en réanimation pour Covid19 (moyenne glissante 7 jours).",
    "deces_hospitaliers": "Nombre de décès quotidiens pour Covid19 à l'hôpital (moyenne glissante 7 jours).",
    "cas": "Nombre de tests positifs quotidiens (RT-PCR et antigéniques) (moyenne glissante 7 jours).",
    "cas_croissance_hebdo": "Croissance du nombre de cas positifs (moyenne mobile de 7 j.) sur une semaine (en %). Les taux de croissance sont plafonnés à -200% et +200% (afin de corriger les jours fériés).",
    "tests": "Nombre de tests quotidiens (positifs et négatifs) (moyenne glissante 7 jours).",
    "nbre_acte_corona": "Nombre d'actes SOS médecin pour suspicion Covid19 (moyenne glissante 7 jours).",
    "nbre_pass_corona": "Nombre de passages aux urgences pour suspicion Covid19 (moyenne glissante 7 jours).",
}

var age_titres = {
    "hospitalisations": "Hospitalisations",
    "incid_hospitalisations": "Nouvelles admissions à l'hôpital",
    "incidence": "Taux d'incidence",
    "taux_positivite": "Taux de positivité",
    "reanimations": "Réanimations",
    "incid_reanimations": "Nouvelles admissions en réanimation",
    "deces_hospitaliers": "Décès hospitaliers",
    "cas": "Cas positifs",
    "cas_croissance_hebdo": "Croissance sur 7 jours des cas positifs",
    "tests": "Dépistage",
    "nbre_acte_corona": "Actes SOS médecin pour Covid19",
    "nbre_pass_corona": "Passages aux urgences pour Covid19",
}



var noms_tranches = {
    "zone_a": "Zone A",
    "zone_b": "Zone B",
    "zone_c": "Zone C",
    "france": "France"
}

function telechargerImage(){
    document.getElementById("link").href = age_dataExplorerAgeChart.toBase64Image()
}

var age_credits = ""//"<br><small>CovidTracker.fr/<b>CovidExplorer</b> - Données : Santé publique France</small>"
let incompatibles_age_pour100k = ["incidence", "taux_positivite"]

function boxAgeChecked(value){
    if (document.getElementById("ages_"+value).checked) {
        age_selected_tranches.push(value);
    } else {
        age_selected_tranches = removeElementArray(age_selected_tranches, value);
        
    }
    buildChartAge();

}

function age_pour100kAgeChecked(){
    age_pour100k = !age_pour100k;
    buildChartAge();
}

function age_cumSumChecked(){
    age_cumsum = !age_cumsum;
    buildChartAge();
}

function age_changeColorage_seq(){
    let type_age_seq = document.getElementById("age_colorage_seqSelect").value;

    let N = 11;

    age_seq = palette(type_age_seq, N) 

    if(type_age_seq=="mpn65"){
        N=40;
        age_seq = palette(type_age_seq, N) 
        age_seq = age_seq.slice(1, 40)
    }

    buildChartAge();

}

function indexOf_age(jour){
    var nom_jour = age_data["france"]["tous"][age_selected_age_data]["jour_nom"]

    var to_return = true
    for (var idx = 0; idx < age_data["france"][nom_jour].length; idx++) {
        value = age_data["france"][nom_jour][idx]
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

function secureChangeTime_age(){
    var sliderNoUi = document.getElementById('sliderUIAge');
    let idx = document.getElementById('sliderUIAge').noUiSlider.get(); // document.getElementById("timeSlider").value
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    var nom_jour = age_data["france"]["tous"][age_selected_age_data]["jour_nom"]
    let date_min = age_data["france"][nom_jour][idx_min]
    let date_max = age_data["france"][nom_jour][idx_max]

    buildChartAge();
    
    var dmin = indexOf_age(date_min)
    var dmax = indexOf_age(date_max)

    var nom_jour = age_data["france"]["tous"][age_selected_age_data]["jour_nom"]
    let N_temp = age_data["france"][nom_jour].length
    if(dmax==0){
        dmax = N_temp-1;
    }
    if((N_temp-dmax)<=10){
        dmax = N_temp-1;
    }

    sliderNoUi.noUiSlider.set([dmin, dmax])
    changeTimeAge();
}

function changeTimeAge(){
    let age_selected_age_data = document.getElementById("typeDoneesAge").value
    
    let nom_jour = age_data["france"]["tous"][age_selected_age_data]["jour_nom"]
    
    let idx = document.getElementById('sliderUIAge').noUiSlider.get(); // document.getElementById("timeSlider").value
    
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    let x_min = age_data["france"][nom_jour][idx_min]
    let x_max = age_data["france"][nom_jour][idx_max]
    
    age_dataExplorerAgeChart.options.scales.xAxes[0].ticks = {
        min: x_min,
        max: age_data["france"][nom_jour][idx_max]
        }
    var y_max = 0

    age_dataExplorerAgeChart.data.datasets.map((age_dataset, idx_age_dataset) => {
        
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
    
    if(age_selected_age_data=="cas_croissance_hebdo"){
        y_max=200
    }

    age_dataExplorerAgeChart.options.scales.yAxes.map((axis, idx) => {
        axis.ticks = {
        //min: 0,
        max: Math.round(y_max)
        }
    })
    
    age_dataExplorerAgeChart.update()

}

function stopExec_age(){
    clearTimeout(timeout_age)
}

var timeout_age;
function animation_age(){
    let slider = document.getElementById('sliderUIAge');
    let max = slider.noUiSlider.options.range.max

    var j = parseInt(slider.noUiSlider.get()[0])
    slider.noUiSlider.set([j, j+1])
    var i = parseInt(slider.noUiSlider.get()[1]); 

    function myLoop() {         //  create a loop function
        timeout_age = setTimeout(function() {   //  call a 3s setTimeout when the loop is called
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

function checkage_pour100kAge(age_selected_age_data){
    
    if (age_selected_age_data == "incidence"){
        document.getElementById("age_pour100kAge").checked = true;
        document.getElementById("age_pour100kAge").setAttribute("disabled", "");
        return false;

    } else if (age_selected_age_data == "taux_positivite") {
        
        document.getElementById("age_pour100kAge").checked = false;
        document.getElementById("age_pour100kAge").setAttribute("disabled", "");
        return false;
    } else {
        document.getElementById("age_pour100kAge").removeAttribute("disabled");
        if(!age_pour100k){
            document.getElementById("age_pour100kAge").checked = false;
        }

        return age_pour100k;
    }
}

function updateSliderAge(){
    var sliderNoUi = document.getElementById('sliderUIAge');

    let age_selected_age_data = document.getElementById("typeDoneesAge").value
    
    let jour_nom = age_data["france"]["tous"][age_selected_age_data]["jour_nom"]
    let N = age_data["france"][jour_nom].length;
    
    let idx = document.getElementById('sliderUIAge').noUiSlider.get();
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

function buildChartAge(){
    updateSliderAge();
    age_dataExplorerAgeChart.destroy();
    buildEmptyChartAge();

    age_dataExplorerAgeChart.data.datasets = []
    age_dataExplorerAgeChart.options.scales.yAxes = []
    age_selected_age_data = [document.getElementById("typeDoneesAge").value]
    
    age_pour100k_temp = checkage_pour100kAge(age_selected_age_data[0]);

    if(document.querySelector('#territoireAge option:checked').parentElement.label == "Départements"){
        if(document.querySelector('#typeDoneesAge option:checked').parentElement.label == "Indicateurs sanitaires"){
            window.alert("Santé publique France ne publie pas les données hospitaliaires par tranche d'âge au niveau départemental. Merci de sélectionner un indicateur épidémique, ou de sélectionner un autre territoire (region, France entière).");
        }
    }
    age_selected_territoires.map((territoire_temp, idx_temp) => {
        age_selected_tranches.map((value, idx) => {
        addTraceAge(age_selected_age_data[0], value, age_pour100k_temp, document.getElementById("territoireAge").value);
    })
    })

    age_dataExplorerAgeChart.update();
    
    var territoire_temp = document.getElementById("territoireAge").value
    if(territoire_temp in noms_zones){
        territoire_temp=noms_zones[territoire_temp]
    }

    document.getElementById("age_titre").innerHTML = age_titres[age_selected_age_data[0]] + " - " + territoire_temp;
    document.getElementById("age_description").innerHTML = age_descriptions[age_selected_age_data[0]] + age_credits;

    if (age_pour100k){
        if(! incompatibles_age_pour100k.includes(age_selected_age_data[0])){
            document.getElementById("age_titre").innerHTML += " - pour 100k habitants";
        }
    }
    if (age_cumsum){
        document.getElementById("age_titre").innerHTML += " -  cumulé<sup>1</sup>";
        document.getElementById("age_description").innerHTML += "<br><small><i><sup>1</sup> Le cumul des indicateurs comportant une moyenne mobile peut varier légèrement avec le cumul réel.</i></small>";
    }
    
    changeTimeAge();
}

function populateAgesSelect(){
    console.log("enter populateAgesSelect")
    var html_code = "";
    //html_code += "<br><i>Tranches d'âge</i><br>"
    
    age_data.france.tranches_noms.map((tranche, idx) => {
        complement = " ";
        html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + "ages_" + tranche + "' onchange='boxAgeChecked(\"" + tranche +"\")'> "+ age_data.france.tranches_noms_affichage[idx] + complement + "</label></div>" + "<br>"
    })
    
    document.getElementById("agesCheckboxes").innerHTML = html_code;
    document.getElementById("ages_tous").checked = true;

    document.getElementById("ages_"+age_data.france.tranches_noms[1]).checked = true;
    document.getElementById("ages_"+age_data.france.tranches_noms[5]).checked = true;

    age_selected_tranches.push(age_data.france.tranches_noms[1])
    age_selected_tranches.push(age_data.france.tranches_noms[5])
    
    console.log("exit populateAgesSelect")
    
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

function populateTerritoires(){
    console.log("enter_populate_territoires")
    console.log(age_data.regions)
    console.log(age_data.departements)

    html_code = "<optgroup label='Régions'>"
    age_data.regions.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + truncate(value) + "</option>"
    })
    html_code += "</optgroup>"

    html_code += "<optgroup label='Départements'>"

    age_data.departements.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + value + " " + truncate(age_data.departements_noms[value]) + "</option>"
    })
    html_code += "</optgroup>"

    document.getElementById("territoireAge").innerHTML += html_code;
    console.log("exit_populate_territoires")
}

fetchage_data();
function fetchage_data(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dataexplorer_compr_age.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.age_data = json;
                console.log("init-a")
                associationTranches();
                console.log("association-a")
                populateAgesSelect();
                console.log("populate-a")
                //Erreur au-dessus
                populateTerritoires()
                console.log("populate-territoires-a")
                setTimeout(function () {
                    buildSliderAge();
                }, 500);
                
                console.log("done-a")
                //telechargerImage()
                
            })
        .catch(function () {
            this.age_dataError = true;
            console.log("error-x-a")
        }
        )
}

function associationTranches(){
    console.log("enter associationTranches")
    age_data.france.tranches_noms.map((value, idx) => {associationTranchesNoms[value]=age_data.france.tranches_noms_affichage[idx]})
    console.log("exit associationTranches")
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

function addTraceAge(value, tranche, age_pour100k_temp, territoire_temp){
    diviseur = 1;
    if (age_pour100k_temp){
        diviseur = 1
        diviseur = age_data[territoire_temp][tranche]["population"]/100000;
    }
    
    var jour_nom = age_data[territoire_temp][tranche][value]["jour_nom"]

    y = 0
    array_data_age = age_data[territoire_temp][tranche][value]["valeur"]

    if(age_cumsum==true){
        array_data_age = array_data_age.map(d=>y+=d);
    }

    age_data_temp = array_data_age.map((val, idx) => ({x: age_data["france"][jour_nom][idx], y: val/diviseur}))
    
    var N = age_dataExplorerAgeChart.data.datasets.length
    if(N>=age_seq.length-1){
        N = 0
    }
    
    complement = " ";

    if(tranche in noms_tranches){
        tranche=noms_tranches[tranche]
    }
    
    age_dataExplorerAgeChart.data.datasets.push({
        yAxisID: value,
        label: associationTranchesNoms[tranche] + complement,
        data: age_data_temp,
        pointRadius: 0,
        backgroundColor: 'rgba(0, 168, 235, 0)',
        borderColor: "#"+age_seq[N],
        cubicInterpolationMode: 'monotone',
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#"+age_seq[N],
    })

    age_dataExplorerAgeChart.options.scales.yAxes.push({
        id: value,
        display: true,
        gridLines: {
                        display: true
                    },
    })
}

buildEmptyChartAge();
function buildEmptyChartAge() {
    var ctx = document.getElementById('age_dataExplorerAgeChart').getContext('2d');

    this.age_dataExplorerAgeChart = new Chart(ctx, {
        type: 'line',
        age_data: {
            age_datasets: []
        },
        options: {
            layout: {
                padding: {
                    left: 0,
                    right: 100,
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
                        if (context.dataset.data[context.dataIndex].x == age_dataExplorerAgeChart.options.scales.xAxes[0].ticks.max)
                        {
                            return  context.dataset.label;
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

function buildSliderAge(){
    var slider = document.getElementById('sliderUIAge');

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
        changeTimeAge()
    });

    buildChartAge();
    
}

</script>
