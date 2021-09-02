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


    <p>Combien d'écoles sont fermées à cause du Covid ? Combien d'élèves ou de personnels ont été contaminés cette semaine ? </p>
    <br><h2>Résumé</h2>
    <div class="wrap">
        <div class="one">
            <span id="nb_classes_fermees" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(+<span id="nb_classes_fermees_7j">--</span> en 7j)<br>
            <b>Classes fermées</b><br>
            pour Covid, soit <span id="taux_classes_fermees">--</span>% de l'ensemble des classes.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>

        <div class="one">
            <span id="nb_structures_fermees" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(+<span id="nb_structures_fermees_7j">--</span> en 7j)<br>
            <b>Structures scolaires fermées</b><br>
            pour Covid, soit <span id="taux_structures_fermees">--</span>% de l'ensemble des structures scolaires.
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>

        <div class="one">
            <span id="nb_cas_positifs" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(+<span id="nb_cas_positifs_7j">--</span> en 7j)<br>
            <b>Cas positifs</b><br>
            quotidiens en moyenne sur 7j, dont <span id="nb_cas_positifs_eleves">--</span> parmi les personnels et <span id="nb_cas_positifs_personnels">--</span> parmi les élèves.<br>
            <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span class="date_maj">--/--</span>.<br>Source : Ministère Éducation Nationale</i></div>
        </div>
    </div>

    <br><h2>Fermetures</h2>
    
    <div shadow="" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Structures scolaires fermées</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="line-chart-vaccination" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Fermetures par type de structure</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="line-chart-vaccination" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Classes fermées</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="line-chart-vaccination" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <br><h2>Cas positifs</h2>

    <div shadow="" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Cas positifs personnels</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="line-chart-vaccination" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <div shadow="" style="margin-top: 20px; margin-bottom: 30px; ">
        <div class="row nowrap" style="padding: 7px">
            <h3>Cas positifs élèves</h3>
            <p>
            </p>
            <div style="max-width: 1200px; text-align: center; margin-bottom: 10px;">
                <canvas id="line-chart-vaccination" width="500" height="200"></canvas>
            </div>
        </div>
    </div>

    <br>
  
    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
   
</body>

<script>

download_data();

function download_data(){
    var grzURL = 'https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/edutracker/data/covid_menjs_France.json';
    var grzrequest = new XMLHttpRequest();
    grzrequest.open('GET', grzURL);
    grzrequest.responseType = 'json';
    grzrequest.send();
    grzrequest.onload = function() {
        
        this.data_France = grzrequest.response;
        populateResume(grzrequest.response);
    }
}

function populateResume(data_France){
    let N = data_France["date"].length;
    document.getElementById("nb_classes_fermees").innerHTML = numberWithSpaces(data_France.nombre_classes_fermees[N-1]) ;
    document.getElementById("nb_classes_fermees_7j").innerHTML = numberWithSpaces((data_France.nombre_classes_fermees[N-1] - data_France.nombre_classes_fermees[N-2])) ;
    document.getElementById("taux_classes_fermees").innerHTML = data_France.taux_classes_fermees[N-1].toFixed(1) ;

    document.getElementById("nb_structures_fermees").innerHTML = data_France.nombre_structures_fermees[N-1] ;
    document.getElementById("nb_structures_fermees_7j").innerHTML = data_France.nombre_structures_fermees[N-1] -  data_France.nombre_structures_fermees[N-2];
    document.getElementById("taux_structures_fermees").innerHTML = (data_France.nombre_structures_fermees[N-1] / data_France.nombre_total_structures[N-1] * 100 ).toFixed(1)

    let nb_cas_positifs = ((data_France.nombre_cas_eleves_7j[N-1] + data_France.nombre_cas_personnels_7j[N-1]) / 7 ).toFixed()
    document.getElementById("nb_cas_positifs").innerHTML = numberWithSpaces(nb_cas_positifs) ;
    document.getElementById("nb_cas_positifs_7j").innerHTML = numberWithSpaces(nb_cas_positifs - ((data_France.nombre_cas_eleves_7j[N-2] + data_France.nombre_cas_personnels_7j[N-2]) / 7 ).toFixed()) ;

    document.getElementById("nb_cas_positifs_eleves").innerHTML = (data_France.nombre_cas_eleves_7j[N-1] / 7).toFixed()
    document.getElementById("nb_cas_positifs_personnels").innerHTML = (data_France.nombre_cas_personnels_7j[N-1] / 7).toFixed()

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


</script>
