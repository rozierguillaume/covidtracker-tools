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
                        <option value="ti">Taux d'incidence</option>
                        <option value="tp">Taux de positivite</option>
                        <option value="td">Taux de dépistage</option>
                    </optgroup>
                </select>
                <br>
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
var associationTranchesNoms = {}

var age_descriptions = {
    "ti": "Nombre de cas positifs par semaine pour 100 000 personnes.",
    "ti": "Ratio entre les cas positifs et les tests réalisés.",
    "td": "Nombre de tests par semaine pour 100 000 personnes.",
}

var age_titres = {
    "ti": "Taux d'incidence",
    "tp": "Taux de positivité",
    "td": "Taux de dépistage",
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

function boxAgeChecked(value){
    if (document.getElementById("ages_"+value).checked) {
        age_selected_tranches.push(value);
    } else {
        age_selected_tranches = removeElementArray(age_selected_tranches, value);
        
    }
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
    
    //if(age_selected_age_data=="cas_croissance_hebdo"){
       // y_max=200
    //}

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

    var param_age={'fill': true, 'borderWidth': 4};

    if(age_selected_tranches.length>1){
        param_age['fill'] = false
        param_age['borderWidth'] = 3.5
    }
    if(age_selected_tranches.length>3){
        param_age['fill'] = false
        param_age['borderWidth'] = 3
    }
    if(age_selected_tranches.length>10){
        param_age['borderWidth'] = 2
    }
    if(document.querySelector('#territoireAge option:checked').parentElement.label == "Départements"){
        if(document.querySelector('#typeDoneesAge option:checked').parentElement.label == "Indicateurs sanitaires"){
            window.alert("Santé publique France ne publie pas les données hospitaliaires par tranche d'âge au niveau départemental. Merci de sélectionner un indicateur épidémique, ou de sélectionner un autre territoire (region, France entière).");
        }
    }
    
    age_selected_territoires.map((territoire_temp, idx_temp) => { 
        age_selected_tranches.map((value, idx) => {
            addTraceAge(age_selected_age_data[0], value, document.getElementById("territoireAge").value, param_age);
    })
    })
    
    age_dataExplorerAgeChart.update();
    var territoire_temp = document.getElementById("territoireAge").value
    
    document.getElementById("age_titre").innerHTML = age_titres[age_selected_age_data[0]] + " - " + territoire_temp;
    document.getElementById("age_description").innerHTML = age_descriptions[age_selected_age_data[0]] + age_credits;
    
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

setTimeout(function () {
    fetchage_data();
        }, 500);

function fetchage_data(){
    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/dataexplorer_education.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.age_data = json;
                console.log("init-a")
                //associationTranches();
                console.log("association-a")
                populateAgesSelect();
                console.log("populate-a")
                console.log("populate-territoires-a")
                buildSliderAge();
                
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

function addTraceAge(value, tranche, territoire_temp, param){
    diviseur = 1;
    
    var jour_nom = age_data[territoire_temp][tranche][value]["jour_nom"]
    
    y = 0
    array_data_age = age_data[territoire_temp][tranche][value]["valeur"]
    
    age_data_temp = array_data_age.map((val, idx) => ({x: age_data["france"][jour_nom][idx], y: val/diviseur}))
    
    var N = age_dataExplorerAgeChart.data.datasets.length
    if(N>=age_seq.length-1){
        N = 0
    }
    
    complement = " ";
    
    if(tranche in noms_tranches){
        tranche=noms_tranches[tranche]
    }
    
    hex_color="#"+age_seq[N];
    color=hexToRgbA(hex_color).match(/\d+/g);
    age_dataExplorerAgeChart.data.datasets.push({
        yAxisID: value,
        label: associationTranchesNoms[tranche] + complement,
        data: age_data_temp,
        pointRadius: 0,
        fill: param['fill'],
        backgroundColor: `rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.2)`,
        borderColor: "#"+age_seq[N],
        borderWidth: param["borderWidth"],
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
    let vw=Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

    margin_right=120;
    if(vw>1000){
        margin_right=120;
    } else if(vw>800){
        margin_right=80;
    } else {
        margin_right=0;
    }

    this.age_dataExplorerAgeChart = new Chart(ctx, {
        type: 'line',
        age_data: {
            age_datasets: []
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
                        if (context.dataset.data[context.dataIndex].x == age_dataExplorerAgeChart.options.scales.xAxes[0].ticks.max)
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

    console.log("buildSliderAge")

    buildChartAge();
    
}

</script>
