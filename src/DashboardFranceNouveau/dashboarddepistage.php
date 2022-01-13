<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<head>
        <script src="https://cdn.plot.ly/plotly-2.4.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/plotly.js/2.1.0/plotly-locale-fr.min.js" integrity="sha512-LNl5CA52EQN7w9dlZhK8x8OuX6yldsqBIU+GWM806iViujAw6KjQ1a9h34UEkidQotn+DOTjGHJcYJ4HgdsF/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<style>
h3 {
    margin-top: 30px;
}
h2 {
    margin-top: 50px;
}
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
    <div class="alert alert-info" role="alert">
        <i>Nouveau dashboard France</i><br>
        Bienvenue sur le nouveau dashboard France. Un problème ? <a href="https://covidtracker.fr/france">Accéder à l'ancien dashboard France</a>.  
    </div>

    <div id="depistage" class="btn-group btn-group-toggle" role="group" >
        <a href="#depistage" class="btn btn-secondary active">Dépistage</a>
        <a href="#hospitalisations" class="btn btn-secondary">Hospitalisations</a>
        <a href="#reanimations" class="btn btn-secondary">Soins critiques</a>
        <a href="#deces" class="btn btn-secondary">Décès</a>
    </div>

    <h2>Cas positifs</h2>

    <div class="wrap">
        <div class="one">
            <span id="nb_total_cas_positifs" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span><br>
            <b>Cas positifs (total)</b><br>
            Nombre total de cas positifs depuis le printemps 2020.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span> • Source : Santé publique France</i></div>
        </div>

        <div class="one">
            <span id="nb_quotidien_cas_positifs" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span><br>
            <b>Cas positifs (quotidien)</b><br>
            Nombre quotidien de cas positifs, en moyenne sur les 7 derniers jours.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span> • Source : Santé publique France</i></div>
        </div>
    </div>
    <br>
    <h3>Nombre de cas positifs (date de prélèvement)</h3>
    <p>Nombre de résultats de tests positifs chaque jour, par date de prélèvement du test sur le patient (dernière donnée : J-3).</p>
    <div id="cas" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span>
    
    <h3>Taux de croissance des cas (date de prélèvement)</h3>
    <p>Taux d'évolution du nombre de cas positifs (dernière donnée : J-3), en pourcent. Une barre rouge signifie une croissance des cas, une barre verte une décroissance.</p>
    <div id="cas_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span>

    <h3>Nombre de cas positifs (date de publication)</h3>
    <p>Nombre de résultats de tests positifs chaque jour, par date de saisie du résultat de test par le professionel de santé (dernière donnée : J-0).</p>
    <div id="cas_spf" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj_spf_opendata">--/--</span></span>

    <h3>Taux de croissance des cas (date de publication)</h3>
    <p>Taux d'évolution du nombre de cas positifs, par date de saisie du résultat (dernière donnée : J-0), en pourcent. Une barre rouge signifie une croissance des cas, une barre verte une décroissance.</p>
    <div id="cas_spf_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj_spf_opendata">--/--</span></span>


    <h3>Taux de positivité des tests</h3>
    <p>Proportion des tests qui sont positifs parmi l'ensemble des tests (dernière donnée : J-3).</p>
    <div id="cas_taux_positivite" style="width: 95vw; height: 35vw; max-width: 1100px; min-height: 300px; max-height: 800px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span>

    <h2>Dépistage</h2>
    <h3>Nombre de tests effectués</h3>
    <p>Nombre total de tests Covid effectués chaque jour (antigéniques et PCR).</p>
    <div id="tests" style="width: 95vw; height: 35vw; max-width: 1100px; min-height: 300px; max-height: 800px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span>
    <br>
    <h3>Taux de croissance des tests effectués</h3>
    <p>Taux d'évolution du nombre de tests réalisés (dernière donnée : J-3), en pourcent. Une barre rouge signifie une croissance des tests, une barre verte une décroissance.</p>
    <div id="tests_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1100px; min-height: 300px; max-height: 800px;"></div>
    <span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span>

    <br>
    Données : Santé publique France
    <br>

    <div style="margin-bottom: 200px;"> </div>

    <?php include(__DIR__ . '/dashboardhospitalisations.php'); ?>

    <div style="margin-bottom: 200px;"> </div>

    <?php include(__DIR__ . '/dashboardreanimations.php'); ?>

    <div style="margin-bottom: 200px;"> </div>

    <?php include(__DIR__ . '/dashboarddeces.php'); ?>

    <div style="margin-bottom: 100px;"> </div>

    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
   
</body>

<script>

let BUTTONS_TO_REMOVE = ['toImage', 'lasso2d', 'zoomIn2d', 'zoomOut2d'];
let config = {responsive: true,
              displaylogo: false,
              locale: 'fr',
              showAxisDragHandles: true,
              modeBarButtonsToRemove: BUTTONS_TO_REMOVE};
let IMAGES = [
            {
            x: 0.45,
            y: 1,
            sizex: 0.15,
            sizey: 0.15,
            source: "https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/images/covidtracker.svg",
            xanchor: "middle",
            xref: "paper",
            yanchor: "top",
            yref: "top"
            }
        ];

let MARGIN = {
            t: 0,
            b:40,
            r:0,
            l:50
    };

download_data();
function download_data(){
    var URL = 'https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/dataexplorer_compr_france.json';
    var request = new XMLHttpRequest();
    request.open('GET', URL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
        data_France = request.response;
        buildChartCas();
        buildChartCasSpf();
        buildChartCasTauxDeCroissance();
        buildChartCasSpfTauxDeCroissance();
        buildChartCasTauxDePositivite();
        buildChartTests();
        buildChartTestsTauxDeCroissance();

        buildChartHospitalisations();
        buildChartHospitalisationsParAge();
        buildChartHospitalisationsTauxDeCroissance();
        buildChartNouvellesHospitalisations();
        buildChartNouvellesHospitalisationsTauxDeCroissance();

        buildChartReanimations();
        buildChartReanimationsTauxDeCroissance();
        buildChartNouvellesReanimations();
        buildChartNouvellesReanimationsTauxDeCroissance();

        buildChartDeces();
        buildChartDecesTauxDeCroissance();
        
    }
}

function printableTaux(n) {
    n = (n<0?"":"+") + n;
    n = n.replace('.', ',');
    return n;
    };

function printableNumber(x){
    x = Math.round(x);
    x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "&nbsp;");
    x = x.replace('.', ',');
    return x
};

function updateDataCas(){
    N = data_France.cas.valeur.length;
    let jour_nom = data_France["cas"].jour_nom;
    let jour = data_France[jour_nom][N-1];
    
    N_spf = data_France.jour_spf_opendata.length
    let jour_spf = data_France.jour_spf_opendata[N_spf-1];

    document.getElementById("nb_total_cas_positifs").innerHTML = printableNumber(data_France.cas_total.valeur);
    document.getElementById("nb_quotidien_cas_positifs").innerHTML = printableNumber(data_France.cas.valeur[N-1]);

    for (element of document.getElementsByClassName('date_maj')){
            element.innerHTML = moment(jour, "YYYY-MM-DD").format("DD / MM / YYYY");
        }
    for (element of document.getElementsByClassName('date_maj_spf_opendata')){
        element.innerHTML = jour_spf//moment(jour_spf, "YYYY-MM-DD").format("DD / MM / YYYY");
    }
}

function buildChartCas(){
    updateDataCas();

    var trace_cas = {
        x: data_France.jour_incid,
        y: data_France.cas_brut.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "cas",
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: 'rgba(8, 115, 191, 0.1)'
        }
    };

    var trace_cas_rolling = {
        x: data_France.jour_incid,
        y: data_France.cas.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Cas (moyenne 7 jours)",
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'rgb(8, 115, 191)',
            width: 3
        }
    };

    let N = data_France.jour_incid.length;
    let x_min = data_France.jour_incid[N-300];
    let x_max = data_France.jour_incid[N-1];
    let y_min = 0;
    let y_max = 1.2*Math.max.apply(Math, data_France.cas.valeur);

    var layout = { 
        images: IMAGES,
        font: {size: 15},
        legend: {"orientation": "h"},
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            //range: [x_min, x_max],
        },
        yaxis: {
            tickfont: {size: 8},
            range: [y_min, y_max]
        },
        annotations: [
            {
            x: x_max,
            y: data_France.cas.valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: String(printableNumber(data_France.cas.valeur[N-1])) + " cas<br>" + printableTaux(data_France.croissance_cas_rolling7.valeur[N-4]) + "%",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(8, 115, 191)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(8, 115, 191)',
            ax: -30,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ]
    };

    var data = [trace_cas, trace_cas_rolling];

    Plotly.newPlot('cas', data, layout, config);
}

function buildChartCasSpf(){

    var trace_cas = {
        x: data_France.jour_spf_opendata,
        y: data_France["cas_spf_opendata"].valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "cas",
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: 'rgba(8, 115, 191, 0.3)'
        }
    };

    var trace_cas_rolling = {
        x: data_France.jour_spf_opendata,
        y: data_France.cas_spf_opendata_rolling.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Cas (moyenne 7 jours)",
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        fillcolor: 'rgba(8, 115, 191, 0.5)',
        line: {
            color: 'rgb(8, 115, 191)',
            width: 3
        }
    };

    var trace_cas_rolling_corrige = {
        x: data_France.jour_spf_opendata,
        y: data_France.cas_spf_opendata_rolling_corrige.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Cas (moyenne 7 jours, correction j. fériés)",
        mode: 'lines',
        type: 'scatter',
        line: {
            color: 'red',
            dash: "dot",
            width: 3
        }
    };

    let N = data_France.jour_spf_opendata.length;
    let x_min = data_France.jour_spf_opendata[N-300];
    let x_max = data_France.jour_spf_opendata[N-1];
    let y_min = 0;
    let y_max = 1.2 * Math.max.apply(Math, data_France.cas_spf_opendata_rolling.valeur);

    var layout = { 
        images: IMAGES,
        font: {size: 15},
        legend: {"orientation": "h"},
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            //range: [x_min, x_max],
        },
        yaxis: {
            tickfont: {size: 8},
            range: [y_min, y_max]
        },
        annotations: [
            {
            x: x_max,
            y: data_France.cas_spf_opendata_rolling.valeur[N-1],
            xref: 'x',
            yref: 'y',
            //text: String(printableNumber(data_France.cas_spf_opendata_rolling.valeur[N-1])) + " cas",
            text: String(printableNumber(data_France.cas_spf_opendata_rolling.valeur[N-1])) + " cas<br>" + printableTaux(data_France.croissance_cas_spf_opendata_rolling7.valeur[N-4]) + "%",

            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(8, 115, 191)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(8, 115, 191)',
            ax: -30,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ]
    };

    var data = [trace_cas, trace_cas_rolling];

    Plotly.newPlot('cas_spf', data, layout, config);
}

function buildChartCasTauxDeCroissance(){
    let MAX_VALUES = 100;
    let N = data_France.jour_incid.length;

    var trace1 = {
        x: data_France.jour_incid.slice(9, N-3),
        y: data_France.croissance_cas_rolling7.valeur.slice(9, N-3),
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            dash: "dot",
            width: 3
        }
    };

    var bar_colors = [];
    data_France.croissance_cas.valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France.jour_incid,
        y: data_France.croissance_cas.valeur,
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France.jour_incid[N-MAX_VALUES];
    let x_last = data_France.jour_incid[N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France.croissance_cas.valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France.croissance_cas.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France.jour_incid[N-4],
            y: data_France.croissance_cas_rolling7.valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: String(printableTaux(data_France.croissance_cas_rolling7.valeur[N-4])) + ' %',
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(0, 0, 0)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(0, 0, 0)',
            ax: -20,
            ay: -40,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max],
            ticksuffix: '%',
        }
    };
    var data = [trace1, trace2];

    Plotly.newPlot('cas_taux_croissance', data, layout, config);
}

function buildChartCasSpfTauxDeCroissance(){
    let MAX_VALUES = 100;
    let N = data_France.jour_spf_opendata.length;

    var trace1 = {
        x: data_France.jour_spf_opendata.slice(9, N-3),
        y: data_France.croissance_cas_spf_opendata_rolling7.valeur.slice(9, N-3),
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            dash: 'dot',
            width: 2
        }
    };
    

    var bar_colors = [];
    data_France.croissance_cas_spf_opendata.valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France.jour_spf_opendata,
        y: data_France.croissance_cas_spf_opendata.valeur,
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France.jour_spf_opendata[N-MAX_VALUES];
    let x_last = data_France.jour_spf_opendata[N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France.croissance_cas_spf_opendata.valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France.croissance_cas_spf_opendata.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France.jour_spf_opendata[N-4],
            y: data_France.croissance_cas_spf_opendata_rolling7.valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: String(printableTaux(data_France.croissance_cas_spf_opendata_rolling7.valeur[N-4])) + ' %',
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(0, 0, 0)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(0, 0, 0)',
            ax: -20,
            ay: -40,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max],
            ticksuffix: '%',
        }
    };
    var data = [trace1, trace2];

    Plotly.newPlot('cas_spf_taux_croissance', data, layout, config);
}

function buildChartCasTauxDePositivite(){
    let MAX_VALUES = 100;
    let N = data_France.jour_incid.length;

    var trace1 = {
        x: data_France.jour_incid,
        y: data_France.taux_positivite.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance (moyenne 7 j)",
        fill: 'tozeroy',
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    let x_min = data_France.jour_incid[N-MAX_VALUES];
    let x_max = data_France.jour_incid[N-1];

    let y_min = 0;
    let y_max = 1.2*Math.max.apply(Math, data_France.taux_positivite.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France.taux_positivite.valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: String(data_France.taux_positivite.valeur[N-1]) + ' %',
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(0, 0, 0)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(0, 0, 0)',
            ax: -20,
            ay: -40,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max],
            ticksuffix: '%',
        }
    };
    var data = [trace1];

    Plotly.newPlot('cas_taux_positivite', data, layout, config);
}

function buildChartTests(){
    var trace2 = {
        x: data_France.jour_incid,
        y: data_France.tests.valeur,
        hovertemplate: '%{y:.1f} tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'grey',
            width: 3
        }
    };

    let N = data_France.jour_incid.length;
    let x_min = data_France.jour_incid[N-300];
    let x_max = data_France.jour_incid[N-1];
    let y_min = 0;
    let y_max = 1.2*Math.max.apply(Math, data_France.tests.valeur.slice(-300));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France.tests.valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: String(printableNumber(data_France.tests.valeur[N-1])) + '<br> tests<br>' + printableTaux(data_France.croissance_tests_rolling7.valeur[N-4]) + "%",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(0, 0, 0)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(0, 0, 0)',
            ax: -30,
            ay: -50,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.8)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max]
        },
        yaxis: {
            range: [y_min, y_max]
        }
    };

    var data = [trace2];

    Plotly.newPlot('tests', data, layout, config);
}

function buildChartTestsTauxDeCroissance(){
    let MAX_VALUES = 100;
    let N = data_France.jour_incid.length;

    var trace1 = {
        x: data_France.jour_incid.slice(9, N-3),
        y: data_France.croissance_tests_rolling7.valeur.slice(9, N-3),
        hovertemplate: '%{y:.1f}% tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            dash: 'dot',
            width: 3
        }
    };

    var bar_colors = [];
    data_France.croissance_tests.valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France.jour_incid,
        y: data_France.croissance_tests.valeur,
        hovertemplate: '%{y:.1f} tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France.jour_incid[N-MAX_VALUES];
    let x_last = data_France.jour_incid[N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France.croissance_tests.valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France.croissance_tests.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France.jour_incid[N-4],
            y: data_France.croissance_tests_rolling7.valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: String(printableTaux(data_France.croissance_tests_rolling7.valeur[N-4])) + ' %',
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgb(0, 0, 0)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgb(0, 0, 0)',
            ax: -30,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.6)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max],
            ticksuffix: '%',
        }
    };
    var data = [trace1, trace2];

    Plotly.newPlot('tests_taux_croissance', data, layout, config);
}

</script>
