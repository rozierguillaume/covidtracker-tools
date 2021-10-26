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
    <div id="cas" style="width:100%; height: 60vh; max-width: 1000px; min-height: 300px; max-height: 800px;"></div>
    <div id="tests" style="width:100%; height: 60vh; max-width: 1000px; min-height: 300px; max-height: 800px;"></div>

    <br>
    Données : 
    <br>
  
    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
   
</body>

<script>


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
        buildChartTests();
    }
}

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
        font: {size: 15},
        legend: {"orientation": "h"},
        xaxis: {
            tickfont: {size: 10},
            range: [x_min, x_max]
        },
        yaxis: {
            range: [y_min, y_max]
        }
    };

    var config = {responsive: true, displaylogo: false}

    var data = [trace2];

    Plotly.newPlot('cas', data, layout, config);
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
        font: {size: 15},
        legend: {"orientation": "h"},
        xaxis: {
            tickfont: {size: 10},
            range: [x_min, x_max]
        },
        yaxis: {
            range: [y_min, y_max]
        }
    };

    var config = {responsive: true, displaylogo: false}

    var data = [trace2];

    Plotly.newPlot('tests', data, layout, config);
}

</script>
