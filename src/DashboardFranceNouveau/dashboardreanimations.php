
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
    <div id="reanimations" class="btn-group btn-group-toggle" role="group" >
        <a href="#depistage" class="btn btn-secondary">Dépistage</a>
        <a href="#hospitalisations" class="btn btn-secondary">Hospitalisations</a>
        <a href="#reanimations" class="btn btn-secondary active">Soins critiques</a>
        <a href="#deces" class="btn btn-secondary">Décès</a>
    </div>

    <h2>Soins critiques (dont réanimation)</h2>

    <h3>Nombre de personnes en soins critiques</h3>
    <p>Nombre de personnes en soins critiques dont réanimation avec Covid19.</p>
    <div id="lits_reanimations" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"><span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span></div>

    <h3>Taux de croissance du nombre de soins critiques</h3>
    <p>Taux d'évolution du nombre de personnes en soins critiques dont réanimation avec Covid19.</p>
    <div id="reanimations_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"><span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span></div>
    
    <h2>Admissions en soins critiques</h2>
    <div class="wrap">
        <div class="one">
            <span id="nb_total_admissions" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span><br>
            <b>Admissions (total)</b><br>
            Nombre total d'admissions Covid19 en soins critiques depuis le printemps 2020.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span> • Source : Santé publique France</i></div>
        </div>

        <div class="one">
            <span id="nb_quotidien_admissions" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span><br>
            <b>Admissions (quotidien)</b><br>
            Nombre quotidien d'admissions Covid19 en soins critiques, en moyenne sur les 7 derniers jours.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span> • Source : Santé publique France</i></div>
        </div>
    </div> 
    <br>

    <h3>Nouvelles admissions en soins critiques</h3>
    <p>Nombre d'admissions quotidiennes en soins critiques dont réanimation avec Covid19.</p>
    <div id="nouvelles_reanimations" style="width: 95vw; height: 35vw; max-width: 1100px; max-height: 800px; min-height: 300px;"><span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span></div>

    <h3>Taux de croissance des nouvelles admissions</h3>
    <p>Taux d'évolution du nombre d'admissions quotidiennes en soins critiques dont réanimation avec Covid19.</p>
    <div id="nouvelles_reanimations_taux_croissance" style="width: 95vw; height: 35vw; max-width: 1100px; min-height: 300px; max-height: 800px;"><span>CovidTracker.fr • Données : Santé publique France • Dernière donnée : <span class="date_maj">--/--</span></span></div>

    <br>
    <br>
    <br>
   
</body>

<script>

function updateDataAdmissionsReanimations(){
    N = data_France.incid_reanimations.valeur.length;
    let jour_nom = data_France["incid_reanimations"].jour_nom;
    let jour = data_France[jour_nom][N-1];

    document.getElementById("nb_total_admissions").innerHTML = printableNumber(data_France.incid_reanimations_total.valeur);
    document.getElementById("nb_quotidien_admissions").innerHTML = printableNumber(data_France.incid_reanimations.valeur[N-1]);

    for (element of document.getElementsByClassName('date_maj')){
            element.innerHTML = moment(jour, "YYYY-MM-DD").format("DD / MM / YYYY");
        }
}

function buildChartReanimations(){
    let data_nom = "reanimations";
    let jour_nom = data_France[data_nom].jour_nom;

    var trace2 = {
        x: data_France[jour_nom],
        y: data_France[data_nom].valeur,
        hovertemplate: '%{y:.1f} reanimations<br>%{x}<extra></extra>',
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'rgba(201, 4, 4, 1)',
            width: 3
        }
    };

    let N = data_France[jour_nom].length;
    let x_min = data_France[jour_nom][N-300];
    let x_max = data_France[jour_nom][N-1];
    let y_min = 0;
    let y_max = Math.max.apply(Math, data_France[data_nom].valeur);

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France[data_nom].valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: "<b>" + printableNumber(data_France[data_nom].valeur[N-1]) + "<br>soins crit.</b><br>(+ " + printableNumber(data_France[data_nom].valeur[N-1] - data_France[data_nom].valeur[N-8]) + " / sem.)",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgba(201, 4, 4, 1)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgba(201, 4, 4, 1)',
            ax: -50,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            //range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max]
        }
    };

    var data = [trace2];

    Plotly.newPlot('lits_reanimations', data, layout, config);
}

function buildChartReanimationsTauxDeCroissance(){
    let MAX_VALUES = 100;
    let data_nom = "croissance_reanimations";
    let jour_nom = data_France[data_nom].jour_nom;
    let N = data_France[jour_nom].length;

    var trace1 = {
        x: data_France[jour_nom].slice(9, N-3),
        y: data_France[data_nom+"_rolling7"].valeur.slice(9, N-3),
        hovertemplate: 'Évolution reanimations : %{y:.1f} %<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    var bar_colors = [];
    data_France[data_nom].valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France[jour_nom],
        y: data_France[data_nom].valeur,
        hovertemplate: 'Évolution reanimations : %{y:.1f} %<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France[jour_nom][N-MAX_VALUES];
    let x_last = data_France[jour_nom][N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France[data_nom].valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France[data_nom].valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France[jour_nom][N-1],
            y: data_France[data_nom].valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: printableTaux(data_France[data_nom].valeur[N-1]) + " %",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgba(0, 0, 0, 1)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgba(0, 0, 0, 1)',
            ax: -10,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.5)',
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
    var data = [trace2];

    Plotly.newPlot('reanimations_taux_croissance', data, layout, config);
}

function buildChartNouvellesReanimations(){
    updateDataAdmissionsHopital();

    let data_nom = "incid_reanimations";
    let jour_nom = data_France[data_nom].jour_nom;

    var trace2 = {
        x: data_France[jour_nom],
        y: data_France[data_nom].valeur,
        hovertemplate: '%{y:.1f} nouvelles admissions<br>%{x}<extra></extra>',
        mode: 'lines',
        type: 'scatter',
        fill: 'tozeroy',
        line: {
            color: 'rgba(201, 4, 4, 1)',
            width: 3
        }
    };

    let N = data_France[jour_nom].length;
    let x_min = data_France[jour_nom][N-300];
    let x_max = data_France[jour_nom][N-1];
    let y_min = 0;
    let y_max = Math.max.apply(Math, data_France[data_nom].valeur.slice(-300));

    var layout = { 
        images: IMAGES,
        font: {size: 15},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: x_max,
            y: data_France[data_nom].valeur[N-1],
            xref: 'x',
            yref: 'y',
            text: "<b>" + printableNumber(data_France[data_nom].valeur[N-1]) + "<br>admissions</b><br> (" + printableTaux(data_France["croissance_" + data_nom + "_rolling7"].valeur[N-4]) + "% / sem.)",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgba(201, 4, 4, 1)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgba(201, 4, 4, 1)',
            ax: -50,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.5)',
            opacity: 0.8
            }
        ],
        margin: MARGIN,
        xaxis: {
            tickfont: {size: 12},
            range: [x_min, x_max],
        },
        yaxis: {
            range: [y_min, y_max]
        }
    };

    var data = [trace2];

    Plotly.newPlot('nouvelles_reanimations', data, layout, config);
}

function buildChartNouvellesReanimationsTauxDeCroissance(){
    let MAX_VALUES = 100;
    let data_nom = "croissance_incid_reanimations";
    let jour_nom = data_France[data_nom].jour_nom;
    let N = data_France[jour_nom].length;

    var trace1 = {
        x: data_France[jour_nom].slice(9, N-3),
        y: data_France[data_nom+"_rolling7"].valeur.slice(9, N-3),
        hovertemplate: 'Évolution nouvelles admissions (moyenne) : %{y:.1f} %<br>%{x}<extra></extra>',
        name: "Taux de croissance de la moyenne 7j",
        type: 'line',
        line: {
            color: 'black',
            width: 3
        }
    };

    var bar_colors = [];
    data_France[data_nom].valeur.map((value, idx) => {
        if(value>0){
            bar_colors.push("#ff4d4d");
        } else {
            bar_colors.push("#70db70");
        }
    })

    var trace2 = {
        x: data_France[jour_nom],
        y: data_France[data_nom].valeur,
        hovertemplate: 'Évolution nouvelles admissions : %{y:.1f} %<br>%{x}<extra></extra>',
        name: 'Taux de croissance',
        type: 'bar',
        fill: 'tozeroy',
        marker: {
            color: bar_colors
        }
    };

    let x_min = data_France[jour_nom][N-MAX_VALUES];
    let x_last = data_France[jour_nom][N-1];
    let x_max = moment(x_last, "YYYY-MM-DD").add('days', 1).format("YYYY-MM-DD");

    let y_min = Math.min.apply(Math, data_France[data_nom].valeur.slice(-MAX_VALUES));
    let y_max = Math.max.apply(Math, data_France[data_nom].valeur.slice(-MAX_VALUES));

    var layout = { 
        images: IMAGES,
        font: {size: 12},
        legend: {"orientation": "h"},
        annotations: [
            {
            x: data_France[jour_nom][N-4],
            y: data_France[data_nom+"_rolling7"].valeur[N-4],
            xref: 'x',
            yref: 'y',
            text: printableTaux(data_France[data_nom+"_rolling7"].valeur[N-4]) + " %",
            showarrow: true,
            font: {
                family: 'Helvetica Neue',
                size: 13,
                color: 'rgba(0, 0, 0, 1)'
            },
            align: 'center',
            arrowhead: 2,
            arrowsize: 1,
            arrowwidth: 1.5,
            arrowcolor: 'rgba(0, 0, 0, 1)',
            ax: -10,
            ay: -30,
            borderwidth: 1,
            borderpad: 2,
            bgcolor: 'rgba(256, 256, 256, 0.5)',
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

    Plotly.newPlot('nouvelles_reanimations_taux_croissance', data, layout, config);
}


</script>
