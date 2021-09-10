<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js" integrity="sha512-igVQ7hyQVijOUlfg3OmcTZLwYJIBXU63xL9RC12xBHNpmGJAktDnzl9Iw0J4yrSaQtDxTTVlwhY730vphoVqJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>
.btn-actif{
    border: 1px solid black;
    padding: 6px;
    border-radius: 5px;
    color:black;
}
.btn-inactif{
    border: 1px solid white;
    padding: 6px;
    border-radius: 5px;
    color:black;
}

.btn-inactif:hover{
    border: 1px solid black;
    background-color: lightgrey;
    padding: 6px;
    border-radius: 5px;
    color:white;
}


.shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        background: #ffffff;
        margin-top: 10px;
    }
    
p {
    font-size: 17px;
}
.wrap {
        display: flex;
        margin-top: 0px;
        flex-wrap: wrap;
    }
.wrap>* {
    flex: 1 1 200px;
}
.boxshadow {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        margin-right: 15px;
        max-width: 500px;
        text-align: left;
        /*box-shadow: 6px 4px 25px #c3d19d;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100%;
        background: #ffffff;
    }

.boxshadow-wide {
    border: 0px solid black;
    margin-top: 20px;
    padding: 10px 10px 10px 10px;
    border-radius: 7px;
    margin-right: 15px;
    max-width: 800px;
    text-align: left;
    /*box-shadow: 6px 4px 25px #c3d19d;*/
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    width: 100%;
    background: #ffffff;
}
.title_h2 {
    margin-top: 80px;
    margin-bottom: 10px;
}
.title {
    margin-top: 50px;
}
</style>

<body>


    <p>Combien d'écoles, de collèges et de lycées sont fermées à cause du Covid ? Combien d'élèves ou de personnels ont obtenu un test positif cette semaine ? Quelle proportion des classes scolaires sont fermées ? Ce tableau de bord permet de suivre l'évolution de l'épidémie de Covid19 dans l'Éducation Nationale. Les données proviennent du Ministère de l'Éducation Nationale de la Jeunesse et des Sports, et sont mises à jour chaque</p>
    
    <div style="background: #f5f5f5; padding: 30px; border-radius: 20px;">
    <div class="row">
    <div class="col-md-10 col-lg-8 col-xs-12">
    <b>Académie : </b>
        <select id="select_region" class="selectors" autocomplete="off" onchange="selectChanged(this)">

                <optgroup label="France">
                    <option selected="selected" value="FR">Toute la France</option>
                </optgroup>

                <optgroup label="Académies" id="academies-select">
                </optgroup>

            </select><br>
            <i> Certains indicateurs ne sont disponibles qu'à l'échelle nationale.</i>
        </div>
    </div>
    </div>
    
    <br><h2>Résumé</h2>
    <div class="wrap">
        <div class="one">
            <span id="nb_classes_fermees" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(<span id="nb_classes_fermees_7j">--</span> en 7j)<br>
            <b>Classes fermées</b><br>
            pour Covid, soit <span id="taux_classes_fermees">--</span>% de l'ensemble des classes.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>

        <div class="one">
            <span id="nb_structures_fermees" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(<span id="nb_structures_fermees_7j">--</span> en 7j)<br>
            <b>Structures scolaires fermées</b><br>
            pour Covid, soit <span id="taux_structures_fermees">--</span>% de l'ensemble des structures scolaires.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>

        <div class="one">
            <span id="nb_cas_positifs" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(<span id="nb_cas_positifs_7j">--</span> en 7j)<br>
            <b>Cas positifs</b><br>
            quotidiens en moyenne sur 7j, dont <span id="nb_cas_positifs_eleves">--</span> parmi les personnels et <span id="nb_cas_positifs_personnels">--</span> parmi les élèves.<br>
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>
    </div>

    <br><h2>Fermetures</h2>
    
    <div shadow="" id="div-structures-scolaires-fermees" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px;">
            <h3>Structures scolaires fermées</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-structures-scolaires-fermees" width="500" height="200" style="max-height: 70vh;"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" id="div-fermetures-par-type-de-structure" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Fermetures par type de structure</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-fermetures-par-type-de-structure" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" id="div-classes-fermees" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Classes fermées</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-classes-fermees" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <br><h2>Cas positifs</h2>

    <div shadow="" id="div-cas-positifs-personnels" style="margin-top: 20px; margin-bottom: 30px;">
        <div class="row nowrap" style="padding: 7px;">
            <h3>Cas positifs personnels</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-cas-positifs-personnels" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" id="div-cas-positifs-eleves" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Cas positifs élèves</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-cas-positifs-eleves" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <br><h2>Tests salivaires</h2>

    <div shadow="" id="div-tests-salivaires" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Tests salivaires en milieu scolaire</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-tests-salivaires" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" id="div-tests-salivaires-taux-positivite" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Taux de positivité des tests salivaires</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="chart-tests-salivaires-taux-positivite" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <br>
    Données : Ministère de l'Éducation Nationale et de la Jeunesse
    <br>
  
    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
   
</body>

<script>

var data_France;
var data_academies;

download_data();
function download_data(){
    var grzURL = 'https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/edutracker/data/fr-en-situation_nationale_covid.json';
    var grzrequest = new XMLHttpRequest();
    grzrequest.open('GET', grzURL);
    grzrequest.responseType = 'json';
    grzrequest.send();
    grzrequest.onload = function() {
        data_France = grzrequest.response;
        updateChartAndData(grzrequest.response);
    }
}

function updateChartAndData(data){
    populateResume(data);
    buildBarChartStructuresFermees(data);
    buildBarChartClassesFermees(data);
    buildBarChartCasPositifsPersonnels(data);
    buildBarChartCasPositifsEleves(data);
    buildDoughnutFermturesParType(data);
    buildChartTestsSalivaires(data);
    buildChartTestsSalivairesTauxPositivite(data);
}

download_data_academies()
function download_data_academies(){
    var grzURL = 'https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/edutracker/data/fr-en-situation_academique_covid.json';
    var grzrequest = new XMLHttpRequest();
    grzrequest.open('GET', grzURL);
    grzrequest.responseType = 'json';
    grzrequest.send();
    grzrequest.onload = function() {
        data_academies = grzrequest.response;
        populateAcademies(grzrequest.response);
    }
}

function populateAcademies(data_academies){
    data_academies.academies.map((val, idx) => {
        document.getElementById("academies-select").innerHTML += `<option value="${val}">${val}</option>`;
    })
}

let list_data_unavailable_academies=[
    "div-fermetures-par-type-de-structure",
    "div-cas-positifs-eleves",
    "div-cas-positifs-personnels",
    "div-tests-salivaires",
    "div-tests-salivaires-taux-positivite",
]
function selectChanged(selected){
        if(selected.value!="FR"){
            let data_aca = data_academies[selected.value]
            populateResume(data_aca);
            buildBarChartStructuresFermees(data_aca);
            buildBarChartClassesFermees(data_aca);
            list_data_unavailable_academies.map((val, idx) => {document.getElementById(val).style.display = "none";})
            
        } else {
            
            list_data_unavailable_academies.map((val, idx) => {document.getElementById(val).style.display = "block";})
            updateChartAndData(data_France);
        }
        
}

function populateResume(data_France){
    let N = data_France["date"].length;
    document.getElementById("nb_classes_fermees").innerHTML = numberWithSpaces(data_France.nombre_classes_fermees[N-1]) ;
    document.getElementById("nb_classes_fermees_7j").innerHTML = numberWithSpaces((data_France.nombre_classes_fermees[N-1] - data_France.nombre_classes_fermees[N-2])) ;
    
    if(data_France.nombre_total_classes){
        document.getElementById("taux_classes_fermees").innerHTML = (data_France.nombre_classes_fermees[N-1]/data_France.nombre_total_classes[N-1] * 100).toFixed(1) ;
    } else {
        document.getElementById("taux_classes_fermees").innerHTML = "--";
    }

    document.getElementById("nb_structures_fermees").innerHTML = data_France.nombre_structures_fermees[N-1] ;
    document.getElementById("nb_structures_fermees_7j").innerHTML = data_France.nombre_structures_fermees[N-1] -  data_France.nombre_structures_fermees[N-2];
    
    if(data_France.nombre_total_structures){
        document.getElementById("taux_structures_fermees").innerHTML = (data_France.nombre_structures_fermees[N-1] / data_France.nombre_total_structures[N-1] * 100 ).toFixed(1)
    } else {
        document.getElementById("taux_structures_fermees").innerHTML = "--";
    }

    if(data_France["nombre_cas_personnels_7j"]){
        let nb_cas_positifs = ((data_France.nombre_cas_eleves_7j[N-1] + data_France.nombre_cas_personnels_7j[N-1]) / 7 ).toFixed()
        document.getElementById("nb_cas_positifs").innerHTML = numberWithSpaces(nb_cas_positifs) ;
        document.getElementById("nb_cas_positifs_7j").innerHTML = numberWithSpaces(nb_cas_positifs - ((data_France.nombre_cas_eleves_7j[N-2] + data_France.nombre_cas_personnels_7j[N-2]) / 7 ).toFixed()) ;

        document.getElementById("nb_cas_positifs_eleves").innerHTML = (data_France.nombre_cas_eleves_7j[N-1] / 7).toFixed()
        document.getElementById("nb_cas_positifs_personnels").innerHTML = (data_France.nombre_cas_personnels_7j[N-1] / 7).toFixed()
    } else {
        document.getElementById("nb_cas_positifs").innerHTML = "--" ;
        document.getElementById("nb_cas_positifs_7j").innerHTML = "--" ;

        document.getElementById("nb_cas_positifs_eleves").innerHTML = "--"
        doc
    }
    for (element of document.getElementsByClassName('date_maj'))
	{element.innerHTML = data_France.date[N-1];}
}


function getDoubleDigit(value){
    if(value.toString().length == 1){
			return "0"+(value).toString()
			}	
    else {
            return (value).toString()
        }
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

function buildChartClassesFermees(){
    
}

var barChartStructuresFermees;
function buildBarChartStructuresFermees(data_France) {
        if(barChartStructuresFermees){
            barChartStructuresFermees.destroy();
        }
        var ctx = document.getElementById('chart-structures-scolaires-fermees').getContext('2d');
        labels = data_France.date
        
        structures_fermees = data_France.nombre_structures_fermees.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)}));

        barChartStructuresFermees = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Structures fermées ',
                        data: structures_fermees, //debut_2nd_doses.slice(0,N_tot-N2).concat(data_values_2doses),
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
    }

var doughnutFermturesParType;
function buildDoughnutFermturesParType(data_France) {
        var ctx = document.getElementById('chart-fermetures-par-type-de-structure').getContext('2d');
        labels = ["écoles", "collèges", "lycées"]
        let N = data_France.date.length;
        let data_par_structure = [data_France.nombre_ecoles_fermees[N-1], data_France.nombre_colleges_fermes[N-1], data_France.nombre_lycees_fermes[N-1]];
        
        this.doughnutFermturesParType = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Classes scolaires fermées ',
                        data: data_par_structure,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                            ],
                    },
                ]
            },
            options: {
                
            }
        });
    }

var barChartClassesFermees;
function buildBarChartClassesFermees(data_France) {
        if(this.barChartClassesFermees){
            this.barChartClassesFermees.destroy();
        }
        var ctx = document.getElementById('chart-classes-fermees').getContext('2d');
        labels = data_France.date
        
        classes_fermees = data_France.nombre_classes_fermees.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)}));

        this.barChartClassesFermees = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Classes scolaires fermées ',
                        data: classes_fermees, //debut_2nd_doses.slice(0,N_tot-N2).concat(data_values_2doses),
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
        
    }

var barChartCasPositifsPersonnels;
function buildBarChartCasPositifsPersonnels(data_France) {
        var ctx = document.getElementById('chart-cas-positifs-personnels').getContext('2d');
        labels = data_France.date
        
        cas_personnels = data_France.nombre_cas_personnels_7j.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)/7}));

        this.barChartCasPositifsPersonnels = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Cas personnels ',
                        data: cas_personnels,
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
    }

var barChartCasPositifsEleves;
function buildBarChartCasPositifsEleves(data_France) {
        var ctx = document.getElementById('chart-cas-positifs-eleves').getContext('2d');
        labels = data_France.date
        
        cas_eleves = data_France.nombre_cas_eleves_7j.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)/7}));

        this.barChartCasPositifsPersonnels = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Cas élèves ',
                        data: cas_eleves,
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
    }

var chartTestsSalivaires;
function buildChartTestsSalivaires(data_France) {
        var ctx = document.getElementById('chart-tests-salivaires').getContext('2d');
        labels = data_France.date
        
        tests_salivaires_realises = data_France.tests_salivaires_realises.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)}));
        tests_salivaires_proposes = data_France.tests_salivaires_proposes.map((val, idx) => ({x: data_France.date[idx], y:parseInt(val)}));

        this.barChartCasPositifsPersonnels = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Tests salivaires réalisés ',
                        data: tests_salivaires_realises,
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                    {
                        label: 'Tests salivaires proposés ',
                        data: tests_salivaires_proposes,
                        backgroundColor: 'lightgrey',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: true
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
    }

var chartTestsSalivairesTauxPositivite;
function buildChartTestsSalivairesTauxPositivite(data_France) {
        var ctx = document.getElementById('chart-tests-salivaires-taux-positivite').getContext('2d');
        labels = data_France.date
        
        taux_positivite_tests_salivaires = data_France.taux_positivite_tests_salivaires.map((val, idx) => ({x: data_France.date[idx], y:val}));

        this.barChartCasPositifsPersonnels = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Taux de positivité tests salivaires ',
                        data: taux_positivite_tests_salivaires,
                        backgroundColor: '#1796e6',
                        pointRadius: 0,
                        pointHoverRadius: 10 ,
                        steppedLine: 'middle',
                    },
                ]
            },
            options: {
                legend: {
                    display: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },
                scales: {
                    xAxes: [{
                    type: 'time',
                    ticks: {
                            source: 'auto'
                        },
                    distribution: 'linear',
                    gridLines: {
                        display:false
                    }
                }],
                }
            }
        });
    }

</script>
