<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<head>
               <script src="https://cdn.plot.ly/plotly-2.4.2.min.js"></script>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js" integrity="sha512-igVQ7hyQVijOUlfg3OmcTZLwYJIBXU63xL9RC12xBHNpmGJAktDnzl9Iw0J4yrSaQtDxTTVlwhY730vphoVqJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/google-palette/1.1.0/palette.js" integrity="sha512-C8lBe+d5Peg8kU+0fyU+JfoDIf0kP1rQBuPwRSBNHqqvqaPu+rkjlY0zPPAqdJOLSFlVI+Wku32S7La7eFhvlA==" crossorigin="anonymous"></script>

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
    <h2>Cas positifs</h2>
    <h3>Nombre de cas positifs</h3>
    <p>Nombre de résultats de tests positifs chaque jour, par date de prélèvement du test sur le patient (dernière donnée : J-3).</p>
    <div id="cas" style="width: 95vw; height: 35vw; max-width: 1000px; max-height: 800px; min-height: 300px; margin-bottom: 100px;"></div>

    <h3>Taux de croissance des cas</h3>
    <p>Taux d'évolution du nombre de cas positifs (dernière donnée : J-3), en pourcent. Une barre rouge signifie une croissance des cas, une barre verte une décroissance.</p>
    <div id="cas_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1000px; max-height: 800px; min-height: 300px; margin-bottom: 100px;"></div>

    <h3>Taux de positivité des tests</h3>
    <p>Proportion des tests qui sont positifs parmi l'ensemble des tests (dernière donnée : J-3).</p>
    <div id="cas_taux_positivite" style="width: 95vw; height: 35vw; max-width: 1000px; max-height: 800px; min-height: 300px; margin-bottom: 100px;"></div>

    <h2>Dépistage</h2>
    <h3>Nombre de tests effectués</h3>
    <p>Nombre total de tests Covid effectués chaque jour (antigéniques et PCR).</p>
    <div id="tests" style="width: 95vw; height: 35vw; max-width: 1000px; min-height: 300px; max-height: 800px;"></div>

    <h3>Taux de croissance des tests effectués</h3>
    <p>Taux d'évolution du nombre de tests réalisés (dernière donnée : J-3), en pourcent. Une barre rouge signifie une croissance des tests, une barre verte une décroissance.</p>
    <div id="tests_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1000px; min-height: 300px; max-height: 800px;"></div>

    <br>
    Données : Santé publique France
    <br>
  
    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
   
</body>

<script>

let BUTTONS_TO_REMOVE = ['toImage', 'zoomIn2d', 'zoomOut2d'];
let config = {responsive: true, displaylogo: false, locale: 'fr', showAxisDragHandles: true, modeBarButtonsToRemove: BUTTONS_TO_REMOVE};
let IMAGES = [
            {
            x: 0.5,
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

download_data();
function download_data(){
    var URL = 'https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/dataexplorer_compr.json';
    var request = new XMLHttpRequest();
    request.open('GET', URL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
        data_France = request.response;
        buildChartCas();
        buildChartCasTauxDeCroissance();
        buildChartCasTauxDePositivite();
        buildChartTests();
        buildChartTestsTauxDeCroissance();
        
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

function buildChartCas(){
    var trace2 = {
        x: data_France.france.jour_incid,
        y: data_France.france.cas.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'rgb(8, 115, 191)',
            width: 3
        }
    };

    let N = data_France.france.jour_incid.length;
    let x_min = data_France.france.jour_incid[N-300];
    let x_max = data_France.france.jour_incid[N-1];
    let y_min = 0;
    let y_max = Math.max.apply(Math, data_France.france.cas.valeur.slice(-300));

    var layout = { 
        images: IMAGES,
        font: {size: 15},
        legend: {"orientation": "h"},
        margin: {
            l: 30,
            r: 20,
            b: 20,
            t: 0,
            pad: 0
        },
        xaxis: {
            tickfont: {size: 10},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max]
        },
        annotations: [
            {
            x: x_max,
            y: data_France.france.cas.valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: String(printableNumber(data_France.france.cas.valeur[N-1])) + " cas<br>" + printableTaux(data_France.france.croissance_cas_rolling7.valeur[N-4]) + "%",
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
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ]
    };

    var data = [trace2];

    Plotly.newPlot('cas', data, layout, config);
}

function buildChartCasTauxDeCroissance(){
    let MAX_VALUES = 100;
    let N = data_France.france.jour_incid.length;

    var trace1 = {
        x: data_France.france.jour_incid.slice(9, N-3),
        y: data_France.france.croissance_cas_rolling7.valeur.slice(9, N-3),
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    var bar_colors = [];
    data_France.france.croissance_cas.valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France.france.jour_incid,
        y: data_France.france.croissance_cas.valeur,
        hovertemplate: '%{y:.1f}% cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France.france.jour_incid[N-MAX_VALUES];
    let x_last = data_France.france.jour_incid[N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France.france.croissance_cas.valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France.france.croissance_cas.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France.france.jour_incid[N-4],
            y: data_France.france.croissance_cas_rolling7.valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: String(printableTaux(data_France.france.croissance_cas_rolling7.valeur[N-4])) + ' %',
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
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ],
        margin: {
            l: 40,
            r: 10,
            b: 20,
            t: 0,
            pad: 0
        },
        xaxis: {
            tickfont: {size: 10},
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

function buildChartCasTauxDePositivite(){
    let MAX_VALUES = 100;
    let N = data_France.france.jour_incid.length;

    var trace1 = {
        x: data_France.france.jour_incid,
        y: data_France.france.taux_positivite.valeur,
        hovertemplate: '%{y:.1f} cas en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance (moyenne 7 j)",
        fill: 'tozeroy',
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    let x_min = data_France.france.jour_incid[N-MAX_VALUES];
    let x_max = data_France.france.jour_incid[N-1];

    let y_min = 0;
    let y_max = Math.max.apply(Math, data_France.france.taux_positivite.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France.france.taux_positivite.valeur[-1],
            xref: 'x',
            yref: 'y',
            text: String(data_France.france.taux_positivite.valeur[N-1]) + ' %',
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
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ],
        margin: {
            l: 40,
            r: 10,
            b: 20,
            t: 0,
            pad: 0
        },
        xaxis: {
            tickfont: {size: 10},
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
        x: data_France.france.jour_incid,
        y: data_France.france.tests.valeur,
        hovertemplate: '%{y:.1f} tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'grey',
            width: 3
        }
    };

    let N = data_France.france.jour_incid.length;
    let x_min = data_France.france.jour_incid[N-300];
    let x_max = data_France.france.jour_incid[N-1];
    let y_min = 0;
    let y_max = Math.max.apply(Math, data_France.france.tests.valeur.slice(-300));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France.france.tests.valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: String(printableNumber(data_France.france.tests.valeur[N-1])) + '<br> tests',
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
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ],
        margin: {
            l: 35,
            r: 0,
            b: 20,
            t: 0,
            pad: 0
        },
        xaxis: {
            tickfont: {size: 10},
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
    let N = data_France.france.jour_incid.length;

    var trace1 = {
        x: data_France.france.jour_incid.slice(9, N-3),
        y: data_France.france.croissance_tests_rolling7.valeur.slice(9, N-3),
        hovertemplate: '%{y:.1f}% tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    var bar_colors = [];
    data_France.france.croissance_tests.valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France.france.jour_incid,
        y: data_France.france.croissance_tests.valeur,
        hovertemplate: '%{y:.1f} tests en moyenne sur 7j.<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France.france.jour_incid[N-MAX_VALUES];
    let x_last = data_France.france.jour_incid[N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France.france.croissance_tests.valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France.france.croissance_tests.valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France.france.jour_incid[N-4],
            y: data_France.france.croissance_tests_rolling7.valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: String(printableTaux(data_France.france.croissance_tests_rolling7.valeur[N-4])) + ' %',
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
        margin: {
            l: 40,
            r: 10,
            b: 20,
            t: 0,
            pad: 0
        },
        xaxis: {
            tickfont: {size: 10},
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
