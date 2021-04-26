<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<div><p><i>CovidExplorer Types</i> permet d'explorer l'évolution des différents types de données. Il est possible de sélectionner un territoire, et de comparer des données différentes.</p>
</div>
<div shadow="" id="age_box">
    <div class="row">
        <div class="col-sm-3" style="min-width: 100px; max-width: 90%;">
        
        <span style="font-size: 200%"><b>CovidExplorer</b></span><br>
        
        <span style="font-size: 180%">Types</span><br><br>

            <b>Territoire</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                <br>
                <select name="type" id="types_territoireAge" onchange="buildChartTypes()" style="margin-top:10px;">
                    <optgroup label="">
                        <option value="france">France</option>
                    </optgroup>
                    
                </select> 
                <br>
                <input type='checkbox' id='type_cumsum' onchange="type_cumSumChecked()" style="margin-bottom:10px;"> Somme cumulée         
                </div>
            <br>
            <label>Données à afficher</label>
            <div id="checkboxes" style="text-align: left; height:300px; overflow-y:scroll; padding: 5px; border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    <div class='checkbox'><label> <input type='checkbox' id="types_incidence" onchange='boxTypeChecked("incidence")' checked>Taux d'incidence </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_cas" onchange='boxTypeChecked("cas")'>Cas positifs (prélèvement)</label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_cas_spf" onchange='boxTypeChecked("cas_spf")'>Cas positifs (remontée)</label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_tests" onchange='boxTypeChecked("tests")'>Dépistage </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_taux_positivite" onchange='boxTypeChecked("taux_positivite")'>Taux de positivite </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_hospitalisations" onchange='boxTypeChecked("hospitalisations")'>Hospitalisations </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_incid_hospitalisations" onchange='boxTypeChecked("incid_hospitalisations")'>Admissions à l'hôpital </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_reanimations" onchange='boxTypeChecked("reanimations")' checked>Réanimations </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_incid_reanimations" onchange='boxTypeChecked("incid_reanimations")'>Admissions en réanimation </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_deces_hospitaliers" onchange='boxTypeChecked("deces_hospitaliers")'>Décès hospitaliers </label></div> <br>
                    <div class='checkbox'><label> <input type='checkbox' id="types_n_cum_dose1" onchange='boxTypeChecked("n_cum_dose1")'>Personnes vaccinées </label></div> <br>
                    <!--<div class='checkbox'><label> <input type='checkbox' id="types_obepine" onchange='boxTypeChecked("obepine")'>Eaux usées (Obépine) </label></div> <br>-->
            </div>
            <br>
            Animation<br>
            <a id="myLink" onclick="animation_types();"><i class="material-icons" style="cursor: pointer;">play_arrow</i></a>
            <a id="stop" onclick="stopExec_types();"><i class="material-icons" style="cursor: pointer;">stop</i></a>
            <br>
        </div>
        
        <div class="col-sm-9" style="min-width: 300px;">
        <h3 id="types_titre">Chargement...</h3>
        <span id="types_description">...</span>
        <br>
        <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                alt="un triangle aux trois côtés égaux"
                height="87px"
                width="130px" 
        />
            <div class="chart-container" style="position: relative; height:60vh; width:100%">
                <canvas id="types_dataExplorerAgeChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
            </div>
            
            <div id="sliderUITypes" style="margin-top:10px; margin-bottom: 10px;"></div>
            <!--
            <div class="slidecontainer" style="margin-top: 10px; margin-bottom: 5px;">
                    <input type="range" min="0" max="1" value="0" class="slider" id="timeSlider" oninput="changeTimeTypes()" onchange="changeTimeTypes()">
                </div>
                -->
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        Palette de couleurs : 
        <select name="type" id="types_colorage_seqSelect" onchange="types_changeColorage_seq()" style="margin-top:10px;" style="width:100%">
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


var types_dataExplorerAgeChart;
var types_selected_age_data=["incidence"];
var data;
var age_seq = palette('mpn65', 40).slice(1, 40);
var type_cumsum = false;

var types_descriptions = {
    "hospitalisations": "Nombre de lits occupés à l'hôpital pour Covid19.",
    "incid_hospitalisations": "Nombre d'admissions quotidiennes à l'hôpital pour Covid19 (moyenne glissante 7 jours).",
    "incidence": "Nombre de cas par semaine pour 100 000 habitants. Par date de prélèvement (J-3).",
    "taux_positivite": "Proportion des tests qui sont positifs (en %). Par date de prélèvement (J-3).",
    "reanimations": "Nombre de lits de réanimation occupés à l'hôpital pour Covid19.",
    "incid_reanimations": "Nombre d'admissions quotidiennes en réanimation pour Covid19 (moyenne glissante 7 jours).",
    "deces_hospitaliers": "Nombre de décès quotidiens pour Covid19 à l'hôpital (moyenne glissante 7 jours).",
    "cas": "Nombre de tests positifs quotidiens par date de prélèvement (J-3) (RT-PCR et antigéniques) (moyenne glissante 7 jours).",
    "cas_spf": "Nombre de tests positifs quotidiens par date de remontée du résultat (RT-PCR et antigéniques) (moyenne glissante 7 jours).",
    "tests": "Nombre de tests quotidiens (positifs et négatifs) (moyenne glissante 7 jours).",
    "nbre_acte_corona": "Nombre d'actes SOS médecin pour suspicion Covid19 (moyenne glissante 7 jours).",
    "nbre_pass_corona": "Nombre de passages aux urgences pour suspicion Covid19 (moyenne glissante 7 jours).",
    "n_cum_dose1": "Nombre de personnes ayant reçu au moins une dose de vaccin (J-1).",
    "obepine": "Concentration du Sars-Cov-2 dans les eaux usées (réseau Obépine)."
}

var types_titres = {
    "hospitalisations": "Hospitalisations",
    "incid_hospitalisations": "Nouvelles admissions à l'hôpital",
    "incidence": "Taux d'incidence",
    "taux_positivite": "Taux de positivité",
    "reanimations": "Réanimations",
    "incid_reanimations": "Nouvelles admissions en réanimation",
    "deces_hospitaliers": "Décès hospitaliers",
    "cas": "   Cas positifs (prélèvement)",
    "cas_spf": "Cas positifs (remontée)",
    "tests": "Dépistage",
    "nbre_acte_corona": "Actes SOS médecin pour Covid19",
    "nbre_pass_corona": "Passages aux urgences pour Covid19",
    "n_cum_dose1": "Personnes vaccinées",
    "obepine": "Covid19 dans les eaux usées"
}


var age_credits = ""//"<br><small>CovidTracker.fr/<b>CovidExplorer</b> - Données : Santé publique France</small>"
//let incompatibles_age_pour100k = ["incidence", "taux_positivite"]
let types_selected = ["incidence", "reanimations"]

function boxTypeChecked(value){
    if (document.getElementById("types_"+value).checked) {
        types_selected.push(value);
        console.log(types_selected)
    } else {
        types_selected = removeElementArray(types_selected, value);
        
    }
    buildChartTypes();

}

function type_cumSumChecked(){
    type_cumsum = !type_cumsum;
    buildChartTypes();
}

function types_changeColorage_seq(){
    let type_age_seq = document.getElementById("types_colorage_seqSelect").value;

    let N = 11;

    age_seq = palette(type_age_seq, N) 

    if(type_age_seq=="mpn65"){
        N=40;
        age_seq = palette(type_age_seq, N) 
        age_seq = age_seq.slice(1, 40)
    }

    buildChartTypes();

}

function indexOf_types(jour){
    var nom_jour = data["france"]["tous"][types_selected_age_data]["jour_nom"]

    var to_return = true
    for (var idx = 0; idx < data["france"][nom_jour].length; idx++) {
        value = data["france"][nom_jour][idx]
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

function secureChangeTime_types(){
    var sliderNoUi = document.getElementById('sliderUITypes');
    let idx = document.getElementById('sliderUITypes').noUiSlider.get(); // document.getElementById("timeSlider").value
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    var nom_jour = data["france"]["tous"][types_selected_age_data]["jour_nom"]
    let date_min = data["france"][nom_jour][idx_min]
    let date_max = data["france"][nom_jour][idx_max]

    buildChartTypes();
    
    var dmin = indexOf_types(date_min)
    var dmax = indexOf_types(date_max)

    var nom_jour = data["france"]["tous"][types_selected_age_data]["jour_nom"]
    let N_temp = data["france"][nom_jour].length
    if(dmax==0){
        dmax = N_temp-1;
    }
    if((N_temp-dmax)<=10){
        dmax = N_temp-1;
    }

    sliderNoUi.noUiSlider.set([dmin, dmax])
    changeTime();
}

function changeTimeTypes(){
    let types_selected_age_data = types_selected[0]

    let idx = document.getElementById('sliderUITypes').noUiSlider.get(); // document.getElementById("timeSlider").value
    let nom_jour = data["france"]["reanimations"]["jour_nom"]

    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    var x_min_minimum = data["france"][data["france"]["incidence"]["jour_nom"]][idx_min];
    var x_max_maximum = data["france"][data["france"]["incidence"]["jour_nom"]][idx_max];
    
    types_selected.map((value, idx) => {
        x1 = data["france"][data["france"][value]["jour_nom"]][idx_min]
        if (x1<x_min_minimum){
            x_min_minimum = x1
        }
        x2 = data["france"][data["france"][value]["jour_nom"]][idx_max]
        if (x2>x_max_maximum){
            x_max_maximum = x2
        }
    })
    
    types_dataExplorerAgeChart.options.scales.xAxes[0].ticks = {
        min: x_min_minimum,
        max: data["france"][nom_jour][idx_max]
        }
    
    console.log("xmaxmax")
    console.log(x_max_maximum)
    types_dataExplorerAgeChart.data.datasets.map((type_dataset, idx_type_dataset) => {
        var y_max = 0
        type_dataset.data.map((value, idx_type_data) => {
            if(value.x >= x_min_minimum){
                //if(value.x <= x_max_maximum){
                    if(value.y*1.1 > y_max){
                        y_max = value.y*1.1
                    }
                //}
            }

        })
        console.log(type_dataset.label)
        if(type_dataset.label.includes("Cas")){
            y_max = 55000;
        }

        types_dataExplorerAgeChart.options.scales.yAxes[idx_type_dataset].ticks.max = Math.round(y_max)
        })
    

    types_dataExplorerAgeChart.update()
}


function updateSliderTypes(){
    var sliderNoUi = document.getElementById('sliderUITypes');

    let types_selected_age_data = types_selected[0]
    
    let jour_nom = data["france"]["reanimations"]["jour_nom"]
    let N = data["france"][jour_nom].length;
    
    let idx = document.getElementById('sliderUITypes').noUiSlider.get();
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

function stopExec_types(){
    clearTimeout(timeout_types)
}

var timeout_types;
function animation_types(){
    let slider = document.getElementById('sliderUITypes');
    let max = slider.noUiSlider.options.range.max

    slider.noUiSlider.set([0, 1])

    var i = parseInt(slider.noUiSlider.get()[1]);                  //  set your counter to 1

    function myLoop() {         //  create a loop function
        timeout_types = setTimeout(function() {   //  call a 3s setTimeout when the loop is called
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

function buildChartTypes(){

    updateSliderTypes();
    
    types_dataExplorerAgeChart.destroy();
    buildEmptyChartTypes();
    
    types_dataExplorerAgeChart.data.datasets = []
    types_dataExplorerAgeChart.options.scales.yAxes = []
    
    types_selected_age_data = [types_selected[0]]

    document.getElementById("types_description").innerHTML = "";
    types_selected.map((type_data, idx_temp) => {
        addTraceTypes(type_data, document.getElementById("types_territoireAge").value);
        document.getElementById("types_description").innerHTML += types_titres[type_data] + " : " + types_descriptions[type_data] + " ";
    })
    types_dataExplorerAgeChart.update()
    
    var complement="";
    var territoire_temp = document.getElementById("types_territoireAge").value
    if(territoire_temp in noms_zones){
        territoire_temp=noms_zones[territoire_temp]
    }
    if (territoire_temp in data.departements_noms){
        complement += data.departements_noms[territoire_temp];
    }

    document.getElementById("types_titre").innerHTML = territoire_temp + " " + complement;

    if (type_cumsum){
        document.getElementById("types_titre").innerHTML += " -  cumulé<sup>1</sup>";
        document.getElementById("types_description").innerHTML += "<br><small><i><sup>1</sup> Le cumul des indicateurs comportant une moyenne mobile peut varier légèrement avec le cumul réel.</i></small>";
    }

    

    changeTimeTypes();
}

function populateTerritoiresTypes(){
    console.log("enter_populate_territoires")

    html_code = "<optgroup label='Régions'>"
    data.regions.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + value + "</option>"
    })
    html_code += "</optgroup>"

    html_code += "<optgroup label='Départements'>"

    data.departements.map((value, idx) => {
        html_code += "<option value='" + replaceBadCharacters(value) + "'>" + value + " " + data.departements_noms[value] + "</option>"
    })
    html_code += "</optgroup>"

    document.getElementById("types_territoireAge").innerHTML += html_code;
    console.log("exit_populate_territoires")
}

fetchtype_data()
function fetchtype_data(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dataexplorer_compr.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.data = json;
                console.log("HEYYYY")
                console.log(data)
                console.log("init-t")
                //associationTranches();
                console.log("association-t")
                //populateAgesSelect();
                console.log("populate-t")
                //Erreur au-dessus
                populateTerritoiresTypes()
                console.log("populate-territoires-t")
                buildSliderTypes();
                console.log("done-t")
                //telechargerImage()
                
            })
        .catch(function () {
            this.types_dataError = true;
            console.log("error-x-t")
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

function addTraceTypes(value, territoire_temp){
    diviseur = 1;
    
    var jour_nom = data[territoire_temp][value]["jour_nom"]
    var liste_jours = data["france"][jour_nom]

    if(value=="obepine"){
        liste_jours=data[territoire_temp][value]["jours"]
    }

    y = 0
    array_data_types = data[territoire_temp][value]["valeur"]

    if(type_cumsum){
        array_data_types = array_data_types.map(d=>y+=d);
    }

    data_temp = array_data_types.map((val, idx) => ({x: liste_jours[idx], y: val}))
    

    var N = types_dataExplorerAgeChart.data.datasets.length
    if(N>=age_seq.length-1){
        N = 0
    }
    
    complement = " ";
    if (territoire_temp in data.departements_noms){
        complement += data.departements_noms[territoire_temp];
    }
    
    types_dataExplorerAgeChart.data.datasets.push({
        yAxisID: value,
        label: types_titres[value],
        data: data_temp,
        pointRadius: 0,
        pointHitRadius: 0.5,
        backgroundColor: 'rgba(0, 168, 235, 0)',
        borderColor: "#"+age_seq[N],
        cubicInterpolationMode: 'monotone',
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#"+age_seq[N],
    })

    var axes = {
        id: value,
        display: true,
        gridLines: {
                    display: true,
                    lineWidth: 1,
                    borderDash: [0.2, 2],
                    color: "#"+age_seq[N],
                    },
        ticks: {
            fontColor: "#"+age_seq[N],
            fontSize: 8,
        }
    }

    if(value.includes("cas")){
        axes.ticks.max = 55000;
    }

    types_dataExplorerAgeChart.options.scales.yAxes.push(axes)
    
    types_dataExplorerAgeChart.update();
}

buildEmptyChartTypes();
function buildEmptyChartTypes() {
    var ctx = document.getElementById('types_dataExplorerAgeChart').getContext('2d');

    this.types_dataExplorerAgeChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: []
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
                        let idx = parseInt(document.getElementById('sliderUITypes').noUiSlider.get()[1]);

                        let min_x = types_dataExplorerAgeChart.options.scales.xAxes[0].ticks.max
                        if(context.dataset.data[context.dataset.data.length-1].x < types_dataExplorerAgeChart.options.scales.xAxes[0].ticks.max){
                            min_x = context.dataset.data[context.dataset.data.length-1].x
                        }
                        
                        if(context.dataset.data[context.dataIndex].x == min_x){
                            return  context.dataset.label;
                        }
                        
                        if (context.dataset.data[context.dataIndex].x == types_dataExplorerAgeChart.options.scales.xAxes[0].ticks.max)
                        {
                            console.log(context)
                            console.log()
                            //return  context.dataset.label;
                            //return  context.dataset.label;
                        }
                        return "";
                    }
                },
            },
            hover: {
                mode: 'x',
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

function buildSliderTypes(){
    var slider = document.getElementById('sliderUITypes');

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
        changeTimeTypes()
    });
    
    buildChartTypes();
    
}

</script>
