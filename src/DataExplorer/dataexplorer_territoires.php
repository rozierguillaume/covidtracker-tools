<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div shadow="" style="width: 100%;">
    <div class="row">
        <div class="col-sm-3" style="min-width: 100px; max-width: 90%;">
        <span style="font-size: 200%"><b>CovidExplorer</b></span><br>
        <span style="font-size: 180%">Territoires</span><br><br>
            <b>Donnée à afficher</b>
                <div style="border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    
                <select name="type" id="typeDonees" onchange="secureChangeTime()" style="margin-top:10px;">
                    <optgroup label="Indicateurs épidémiques">
                        <option value="incidence">Taux d'incidence</option>
                        <option value="cas">Cas positifs</option>
                        <option value="tests">Dépistage</option>
                        <option value="taux_positivite_rolling_before">Taux de positivité</option>
                        <option value="obepine">Eaux usées (Obépine)</option>
                    </optgroup>
                    <optgroup label="Indicateurs sanitaires">
                        <option value="hospitalisations">Hospitalisations</option>
                        <option value="incid_hospitalisations">Admissions à l'hôpital</option>
                        <option value="reanimations">Réanimations</option>
                        <option value="incid_reanimations">Adm. réanimation</option>
                        <option value="saturation_reanimations">Saturation réanimation</option>
                    
                        <option value="nbre_acte_corona">Actes SOS médecin</option>
                        <option value="nbre_pass_corona">Passages aux urgences</option>
                        <option value="deces_hospitaliers">Décès hospitaliers</option>
                        <option value="deces_ehpad">Décès EHPAD</option>
                    </optgroup>
                    <optgroup label="Vaccination">
                        <option value="n_cum_dose1">Vaccinations (cumul)</option>
                        <option value="n_dose1">Vaccinations (quotidien)</option>
                    </optgroup>
                </select>
                <br>
                <input type='checkbox' id='pour100k' onchange="pour100kChecked()" style="margin-bottom:10px;"> Pour 100k habitants<br>
                <input type='checkbox' id='cumsum' onchange="cumSumChecked()" style="margin-bottom:10px;"> Somme cumulée
                </div>
            <br>
            
            <label>Territoires</label>
            <div id="checkboxes" style="text-align: left; height:80vw; max-height: 40vh; overflow-y:scroll; padding: 10px; border-radius: 7px; box-shadow: inset 0px 0px 10px 5px rgba(0, 0, 0, 0.07)">
                    <span id="territoiresCheckboxes"></span>
                
            </div>
            <br>
            Animation<br>
            <a id="myLink" onclick="animation();"><i class="material-icons" style="cursor: pointer;">play_arrow</i></a>
            <a id="stop" onclick="stopExec();"><i class="material-icons" style="cursor: pointer;">stop</i></a>
        </div>
        
        <div class="col-sm-9" style="min-width: 300px;">
            <h3 id="titre">Chargement...</h3>
            
            <span id="description">...</span><br>
            <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                height="87px"
                width="130px" 
            />
                <!-- height:70vh; width:100%; max-height: 75% -->
                <!-- margin-top:20px; max-height: 800px; max-width: 1500px;-->
                <div class="chart-container" style="position: relative; height:70vh; width:100%; max-height: 75%">
                    <canvas id="dataExplorerChart" style="margin-top:20px; max-height: 800px; max-width: 1500px;"></canvas>
                    
                </div>
                <div id="sliderUI" style="margin-top:10px; margin-bottom: 10px;">
                </div>
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

<br>

<script>


var dataExplorerChart;
var selected_data=["incidence"];
var selected_territoires=["france"];
var data;
var seq = palette('mpn65', 40).slice(1, 40);
var pour100k = false;
var cumsum = false;

var descriptions = {
    "hospitalisations": "Nombre de lits occupés à l'hôpital pour Covid19.",
    "incid_hospitalisations": "Nombre d'admissions quotidiennes à l'hôpital pour Covid19 (moyenne glissante 7 jours).",
    "incidence": "Nombre de cas par semaine pour 100 000 habitants. Par date de prélèvement (J-3).",
    "taux_positivite": "Proportion des tests qui sont positifs (en %). Calcul : moyenne(positifs / total). Par date de prélèvement (J-3).",
    "taux_positivite_rolling_before": "Proportion des tests qui sont positifs (en %). Par date de prélèvement (J-3). <small>Calcul : moyenne_mobile(tests_positifs) / moyenne_mobile(total_tests).</small>",
    "reanimations": "Nombre de lits de réanimation occupés à l'hôpital pour Covid19.",
    "incid_reanimations": "Nombre d'admissions quotidiennes en réanimation pour Covid19 (moyenne glissante 7 jours).",
    "deces_hospitaliers": "Nombre de décès quotidiens pour Covid19 à l'hôpital (moyenne glissante 7 jours).",
    "deces_ehpad": "Nombre de décès quotidiens en EHPAD (moyenne glissante 7 jours) — <i>données communiquées une fois par semaine, d'où les irrégularités</i>.",
    "cas": "Nombre de tests positifs quotidiens (RT-PCR et antigéniques) (moyenne glissante 7 jours). Par date de prélèvement (J-3).",
    "tests": "Nombre de tests quotidiens (positifs et négatifs) (moyenne glissante 7 jours). Par date de prélèvement (J-3).",
    "nbre_acte_corona": "Nombre d'actes SOS médecin pour suspicion Covid19 (moyenne glissante 7 jours).",
    "nbre_pass_corona": "Nombre de passages aux urgences pour suspicion Covid19 (moyenne glissante 7 jours).",
    "saturation_reanimations": "Proportion des lits disponibles avant l'épidémie (DREES 2018) occupés uniquement par les patients Covid19 (en %).",
    "n_cum_dose1": "Nombre de personnes ayant reçu au moins une dose de vaccin (J-1, cumulé).",
    "n_dose1": "Nombre de personnes ayant reçu au moins une dose de vaccin (J-1, quotidien).",
    "obepine": "Concentration du Sars-Cov-2 dans les eaux usées (réseau Obépine)."
}

var titres = {
    "hospitalisations": "Hospitalisations",
    "incid_hospitalisations": "Nouvelles admissions à l'hospital",
    "incidence": "Taux d'incidence",
    "taux_positivite": "Taux de positivité",
    "taux_positivite_rolling_before": "Taux de positivité",
    "reanimations": "Réanimations",
    "incid_reanimations": "Nouvelles admissions en réanimation",
    "deces_hospitaliers": "Décès hospitaliers",
    "deces_ehpad": "Décès en EHPAD",
    "cas": "Cas positifs",
    "tests": "Dépistage",
    "nbre_acte_corona": "Actes SOS médecin pour Covid19",
    "nbre_pass_corona": "Passages aux urgences pour Covid19",
    "saturation_reanimations": "Saturation des réanimations par les patients Covid19",
    "n_cum_dose1": "Personnes ayant reçu une dose de vaccin",
    "n_dose1": "Personnes ayant reçu une dose de vaccin",
    "obepine": "Covid19 dans les eaux usées"
}

var noms_zones = {
    "confines_mars_2021": "Dép. confinés (03/21)",
    "zone_a": "Zone A",
    "zone_b": "Zone B",
    "zone_c": "Zone C",
    "france": "France",
    "metropole": "Métropole",
    "drom_com": "DROM-COM",
}

var credits = ""//"<br><small>CovidTracker.fr/<b>CovidExplorer</b></small>"
let incompatibles_pour100k = ["incidence", "taux_positivite", "taux_positivite_rolling_before"]

function boxChecked(value){

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

function cumSumChecked(){
    cumsum = !cumsum;
    buildChart();
}

function changeColorSeq(){
    let type_seq = document.getElementById("colorSeqSelect").value;

    let N = 11;

    seq = palette(type_seq, N) 

    if(type_seq=="mpn65"){
        N=40;
        seq = palette(type_seq, N) 
        seq = seq.slice(1, 40)
    }

    buildChart();

}

function stopExec(){
    clearTimeout(timeout)
}

function secureChangeTime(){
    populateTerritoireSelect();

    var sliderNoUi = document.getElementById('sliderUI');
    let idx = document.getElementById('sliderUI').noUiSlider.get(); // document.getElementById("timeSlider").value
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    var nom_jour = data["france"][selected_data]["jour_nom"]
    let date_min = data["france"][nom_jour][idx_min]
    let date_max = data["france"][nom_jour][idx_max]

    buildChart();

    var dmin = indexOf(date_min)
    var dmax = indexOf(date_max)

    var nom_jour = data["france"][selected_data]["jour_nom"]
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

function indexOf(jour){
    var nom_jour = data["france"][selected_data]["jour_nom"]

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
var timeout;
function animation(){
    let slider = document.getElementById('sliderUI');
    let max = slider.noUiSlider.options.range.max

    var j = parseInt(slider.noUiSlider.get()[0])
    slider.noUiSlider.set([j, j+1])
    var i = parseInt(slider.noUiSlider.get()[1]); 

    function myLoop() {         //  create a loop function
        timeout = setTimeout(function() {   //  call a 3s setTimeout when the loop is called
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

var x_min_date = ""
var x_max_date = ""

function changeTime(){
    let selected_data = document.getElementById("typeDonees").value
    let nom_jour = data["france"][selected_data]["jour_nom"]
    
    let idx = document.getElementById('sliderUI').noUiSlider.get(); // document.getElementById("timeSlider").value
    
    let idx_min = parseInt(idx[0])
    let idx_max = parseInt(idx[1])

    let x_min = data["france"][nom_jour][idx_min]
    let x_max = data["france"][nom_jour][idx_max]

    dataExplorerChart.options.scales.xAxes[0].ticks = {
        min: x_min,
        max: x_max
        }

    var y_max = 0
    dataExplorerChart.data.datasets.map((dataset, idx_dataset) => {
        dataset.data.map((value, idx_data) => {
            if(value.x >= x_min){
                if(value.x <= x_max){
                    if(value.y*1.1 > y_max){
                        y_max = value.y*1.1
                    }
                }
            }

        })
    })

    if((idx_max-idx_min)<100){
        dataExplorerChart.data.datasets.map((dataset, idx_dataset) => {
            dataset.pointRadius = 1;
        })
    } else {
        dataExplorerChart.data.datasets.map((dataset, idx_dataset) => {
            dataset.pointRadius = 0;
        })
    }

    dataExplorerChart.options.scales.yAxes.map((axis, idx) => {
        axis.ticks = {
            min: 0,
            max: Math.round(y_max)
        }
    })
    
    dataExplorerChart.update()

}

function checkPour100k(selected_data){
    
    if (selected_data == "incidence"){
        document.getElementById("pour100k").checked = true;
        document.getElementById("pour100k").setAttribute("disabled", "");
        return false;

    } else if (selected_data == "taux_positivite_rolling_before") {
        
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

    dataExplorerChart.data.datasets = []
    dataExplorerChart.options.scales.yAxes = []
    selected_data = [document.getElementById("typeDonees").value]

    pour100k_temp = checkPour100k(selected_data[0]);
    
    var param={'fill': true, 'borderWidth': 4};
    var show_alert=false

    if(selected_territoires.length>1){
        param['fill'] = false
        param['borderWidth'] = 3.5
    }
    if(selected_territoires.length>3){
        param['fill'] = false
        param['borderWidth'] = 3
    }
    if(selected_territoires.length>10){
        param['borderWidth'] = 2
    }

    selected_territoires.map((value, idx) => {
        if(value!="france"){
            show_alert=true
        }
        addTrace(selected_data[0], value, pour100k_temp, param);
    })
    dataExplorerChart.update();

    if(show_alert==true){
        if(selected_data=="deces_ehpad"){
            window.alert("Santé publique France ne publie pas les décès en EHPAD au niveau départemental ou régional. Merci de sélectionner un indicateur épidémique, ou de sélectionner le territorie France entière).");
        }
    }
    
    document.getElementById("titre").innerHTML = titres[selected_data[0]];

    if (pour100k){
        if(! incompatibles_pour100k.includes(selected_data[0])){
            document.getElementById("titre").innerHTML += " pour 100k habitants";
        }
    }
    
    document.getElementById("description").innerHTML = descriptions[selected_data[0]] + credits;

    if (cumsum){
        document.getElementById("titre").innerHTML += " -  cumulé<sup>1</sup>";
        document.getElementById("description").innerHTML += "<br><small><i><sup>1</sup> Le cumul des indicateurs comportant une moyenne mobile peut varier légèrement avec le cumul réel.</i></small>";
    }
    
    changeTime();
}

function updateBoxChecked(){
    selected_territoires.map((territoire, idx)=>{
        try {
            document.getElementById(territoire).checked = true;
        } catch (error) {
            console.error(error);
        }
    }
    )
}

function populateTerritoireSelect(){
    
    var typeDonnees = document.getElementById("typeDonees").value;
    var html_code = "";
    
    if (typeDonnees!="obepine"){
        html_code += "<br><i>France</i><br>"
        html_code += "<div class='checkbox'><label>" + `<input type='checkbox' id='france' onchange="boxChecked('france')">France` + "</label></div><br>"
        html_code += "<div class='checkbox'><label>" + `<input type='checkbox' id='metropole' onchange="boxChecked('metropole')">Métropole` + "</label></div>" + "<br>"
        html_code += "<div class='checkbox'><label>" + `<input type='checkbox' id='drom_com' onchange="boxChecked('drom_com')">DROM-COM` + "</label></div>" + "<br>"

    }

    if (typeDonnees!="deces_ehpad"){

        html_code += "<br><i>Régions</i><br>"
        data.regions.map((region, idx) => {
            html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(region) + "' onchange='boxChecked(\"" + replaceBadCharacters(region) +"\")'> "+ region + "</label></div>" + "<br>"

        })

        if (typeDonnees!="obepine"){
            html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters("confines_mars_2021") + "' onchange='boxChecked(\"" + replaceBadCharacters("confines_mars_2021") +"\")'>Dép. confinés (19/03/21)</label></div>" + "<br>"
            
            html_code += "<br><i>Zones de vacances</i><br>"
            
            data.zones_vacances.map((zone, idx) => {
                complement = " ";
                html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(zone) + "' onchange='boxChecked(\"" + replaceBadCharacters(zone) +"\")'> "+ noms_zones[zone] + complement + "</label></div>" + "<br>"
            })



            html_code += "<br><i>Départements</i><br>"
            
            data.departements.map((departement, idx) => {
                complement = " ";
                if (departement in data["departements_noms"]) {
                    complement += data["departements_noms"][departement];
                }

                html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(departement) + "' onchange='boxChecked(\"" + replaceBadCharacters(departement) +"\")'> "+ departement + complement + "</label></div>" + "<br>"

            })
        } else {
            html_code += "<br><i>Les données eaux usées ne sont publiés par Obépine que pour la France entière et les régions.</i>"
            unselectAll();
        }
    } else {
        html_code += "<br><i>Les décès en EHPAD ne sont publiés par Santé publique France que pour la France entière.</i>"
        unselectAll("france");
    }

    if (typeDonnees=="incidence"){
        html_code += "<br><i>Métropoles</i><br>"
        complement = ""
        data.metropoles.map((metropole, idx) => {
            html_code += "<div class='checkbox'><label>" + "<input type='checkbox' id='" + replaceBadCharacters(metropole) + "' onchange='boxChecked(\"" + replaceBadCharacters(metropole) +"\")'> "+ metropole + complement + "</label></div>" + "<br>"
        })
    } else {
        html_code += "<br><i>Métropoles : seul le taux d'incidence est publié par Santé publique France.</i>"
    }

    document.getElementById("territoiresCheckboxes").innerHTML = html_code;
    updateBoxChecked();
}

function unselectAll(keep_selected){
    selected_territoires.map((value, idx)=>{
        document.getElementById(value).checked = false
    })
    
    selected_territoires = []
    document.getElementById("france").checked = false

    if(keep_selected!=null){
        selected_territoires = [keep_selected]
        document.getElementById(keep_selected).checked = true
    }
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
                console.log("init-terr")
                populateTerritoireSelect();
                //addTrace("incidence", "france");
                console.log("0-terr")
                
                buildSlider();
                console.log("1-terr")
                buildChart()
                console.log("2")
                majDataUpdate();
                //startTypesChart();
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x1")
        }
        )
}

function majDataUpdate(){
    let N = data["france"]["jour_hosp"].length;
    document.getElementById("dateDonnee").innerHTML = data["france"]["jour_hosp"][N-1];
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

function hexToRgbA(hex){
    var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
        c= hex.substring(1).split('');
        if(c.length== 3){
            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c= '0x'+c.join('');
        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
    }
    throw new Error('Bad Hex');
}

function addTrace(value, territoire, pour100k_temp, param){
    diviseur = 1;
    if (pour100k_temp){
        diviseur = data[territoire]["population"]/100000;
    }
    var jour_nom = data[territoire][value]["jour_nom"]
    var liste_jours = data["france"][jour_nom]

    if(value=="obepine"){
        liste_jours=data[territoire][value]["jours"]
    }

    y = 0
    array_data_territoires = data[territoire][value]["valeur"]

    if(cumsum==true){
        array_data_territoires = array_data_territoires.map(d=>y+=d);
    }

    data_temp = array_data_territoires.map((val, idx) => ({x: liste_jours[idx], y: val/diviseur}))
    
    var N = dataExplorerChart.data.datasets.length
    if(N>=seq.length-1){
        N = 0
    }

    complement = " ";
    if (territoire in data["departements_noms"]) {
        complement += data["departements_noms"][territoire];
    }

    if(territoire in noms_zones){
        territoire=noms_zones[territoire]
    }

    hex_color="#"+seq[N];
    color=hexToRgbA(hex_color).match(/\d+/g);

    dataExplorerChart.data.datasets.push({
        yAxisID: value,
        label: territoire + complement,
        data: data_temp,
        pointRadius: 0,
        backgroundColor: `rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.2)`,
        fill: param['fill'],
        borderColor: hex_color,
        cubicInterpolationMode: 'monotone',
        pointHoverRadius: 5,
        borderWidth: param["borderWidth"],
        pointHoverBackgroundColor: "#"+seq[N],
    })

    dataExplorerChart.options.scales.yAxes.push({
        id: value,
        display: true,
        gridLines: {
                        display: true
                    }
    })
    
}

buildEmptyChart();
function buildEmptyChart() {
    var ctx = document.getElementById('dataExplorerChart').getContext('2d');
    let vw=Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

    margin_right=120;
    if(vw>1000){
        margin_right=120;
    } else if(vw>800){
        margin_right=80;
    } else {
        margin_right=0;
    }
    
    this.dataExplorerChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: []
        },
        options: {
            layout: {
                padding: {
                    left: -2,
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
                        if (context.dataset.data[context.dataIndex].x == dataExplorerChart.options.scales.xAxes[0].ticks.max)
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
                intersect: false,
                mode: 'index',
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
                    ticks: {
                        min: 0,
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
