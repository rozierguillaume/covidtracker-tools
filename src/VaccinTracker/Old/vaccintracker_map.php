<!-- wp:html -->

<p>Quelle proportion des Français a été vaccinée ? Combien faut-il encore vacciner de personnes avant d'atteindre l'immunité collective ? Quels sont les différents types de vaccins proposés ?
Ce tracker permet de suivre la proportion de Français déjà vaccinés contre la Covid19, et le nombre de personnes restant à vacciner pour atteindre l'immunité collective. VaccinTracker est une initiative citoyenne indépendante et non officielle.
</p>

<!--
<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">
<b>11 janvier - Message important sur les données</b><br>
Lors du lancement de VaccinTracker le 27 décembre (jour du début de la campagne vaccinale), initiative indépendante, aucune donnée officielle de vaccination n’était disponible. Nous avons alors commencé à chercher, collecter et sommer les données publiées notamment dans la presse locale. Le Ministère de la Santé a contacté CovidTracker le 30 décembre afin de lui fournir des données officielles, plus exhaustives et à jour. Depuis, nous recevons régulièrement un nouveau chiffre du nombre de vaccinés de sa part, et nous le remercions pour cela. Cependant, cette situation n’est pas conforme avec nos principes d’OpenData. <b>VaccinTracker ne sera désormais mis à jour qu’à partir de données publiques officielles, dès que celles-ci seront disponibles.</b>
</div>
-->

<div id="news"></div>

<div class="alert alert-info clearFix"  style="font-size: 20px; display: none;">
    <button class="btn-shadow pull-right">
        <a href="https://covidtracker.fr/don" target="_blank" rel="noreferrer noopener">🍩 Offrez-moi un donut</a>
    </button> &nbsp;&nbsp;
    Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>

</div>
<!-- /wp:html -->

<!-- wp:html -->
<div class="wrap">
    <div class="one">
        <span id="nb_vaccines" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span>&nbsp;&nbsp;(+<span id="nb_vaccines_24h">--</span> en 24h)<br>
        <b>Personnes vaccinées</b><br>
        Nombre cumulé de personnes ayant reçu au moins une dose de vaccin contre la Covid19 en France. <span id="proportion_doses">--</span>% des doses réceptionnées ont été utilisées.<br><span id="estimation_str"></span>
        <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span id="date_maj_2">--/--</span>.<br>Source : CovidTracker/Ministère de la Santé.</i></div>
    </div>

    <div class="one">
        <span id="nb_doses" style="font-size:200%; margin-top:5px; margin-bottom: 3px;">--</span><br>
        <b>Doses réceptionnées</b><br>
        Cumul des doses réceptionnées depuis le 26 décembre. Deux doses espacées de trois semaines sont nécessaires pour vacciner un patient.<br>
        <div style="font-size: 70%; margin-top: 3px;"><i>Dernière donnée : <span id="date_maj_4">--/--</span>.<br>Source : CovidTracker/Ministère de la Santé.</i></div>
    </div>
</div>

<h2 style="margin-top : 80px;">Proportion de personnes vaccinées</h2>
Chaque carré correspond à 1% des Français. Les carrés verts <svg width="10" height="10"><rect x="0" y="0" width="60" height="60" style="fill:rgb(45, 189, 84);" /></svg> correspondent aux Français ayant reçu au moins une dose de vaccin (deux sont nécessaires). Les carrés rouge vif <svg width="10" height="10"><rect x="0" y="0" width="60" height="60" style="fill:rgb(237, 88, 88);" /></svg> représentent les Français qu'il faut vacciner avant d'atteindre un taux de vaccination de 60%.
Les carrés rouge clair <svg width="10" height="10"><rect x="0" y="0" width="60" height="60" style="fill: rgb(207, 169, 169);" /></svg>  représentent les autres Français non vaccinés. <i>Mise à jour : <span id="date_maj_3">--/--</span></i>


<div class="row">
    <div class="col-md-6" style="padding-top: 20px;">
        <div id="tablea_div" style="width:80vw; height:80vw; max-width: 400px; max-height: 400px;">
            <table style="width:100%; height:100%" id="tableauVaccin"></table>
        </div>
    </div>
    <br>
    <div class="col-md-3" style="padding-top: 20px;">

        <span style="font-size: 200%; color: rgb(45, 189, 84)"><span id="proportionVaccines">--</span>%</span><br> des Français ont reçu au moins une dose de vaccin. <br><br>
        Il reste à vacciner au moins <br><span style="font-size: 200%; color: rgb(237, 88, 88);"><span id="proportionAVaccinerImmu">--</span>%</span><br>des Français avant d'atteindre un taux de vaccination de 60%. <br>
    </div>
</div>
<br>

<div class="alert-data" style="margin-top: 15px;">
    <span style="font-size: 80%;">
        N.B. : un taux de vaccination de 60% ne permet pas nécessairement d'atteindre une immunité collective.<br>

        <b>Source des données</b> : CovidTracker / Ministère de la Santé.</a>
    </span>
</div>


<h2 style="margin-top : 80px;">Évolution</h2>
L'objectif est de vacciner 1 million de personnes en janvier 2021. Pour atteindre cet objectif, il faudrait vacciner <b><span id="objectif_quotidien">--</span> personnes</b> chaque jour entre aujourd'hui et le 31 janvier 2021.
<br>
<br>
Au rythme actuel <small>(moyenne des 7 derniers jours)</small>, l'objectif du million de personnes vaccinées sera atteint le <b><span id="date_projetee_objectif"></span></b>.

<br><br>
Le graphique suivant présente le nombre cumulé de personnes ayant reçu au moins 1 dose de vaccin Covid19.
<br>
<br>

<div>
    <div style="float:left; margin-left: 3px; margin-right:15px;">
        <input type="checkbox" id="objectif" name="objectif" onchange="ajouterObjectifAnnotation()">
        <label for="objectif" style="font-weight: normal;">Afficher objectif</label>
    </div>
    <div>
    <select name="type" id="type" onchange="typeDonneesChart()">
        <option value="cumul">Cumul vaccinés</option>
        <option value="quotidien">Vaccinations quotidiennes</option>
    </select>
    </div>
</div>

<div class="chart-container" style="position: relative; height:50vh; width:100%">
    <canvas id="lineVacChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
</div>

<?php include(__DIR__ . '/carte.php') ?>
<?php include(__DIR__ . '/autorisations.php') ?>


<br>
<h2>Quand l'immunité collective sera-t-elle atteinte ?</h2>
Sur VaccinTracker, le taux de 60% a été choisi comme seuil d'immunité collective. Cependant, on ne peut pas aujourd'hui connaître ce taux précisément.
La vidéo suivante du média Le Monde explique très bien la problématique à notre sens :
<br><br>
<iframe width="560" height="315" src="https://www.youtube.com/embed/bjFtFMilb34" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<br>
<h2 style="margin-top : 80px;">Quand pourrez-vous vous faire vacciner ?</h2>
Le gouvernement souhaite vacciner 1 million de personnes en janvier 2021, 12 à 14 millions d'ici à mi-avril et 15 à 27 millions d'ici à juillet.

<h3 style="margin-top : 20px;">Début janvier</h3>
<ul>
    <li>Personnes âgées séjournant dans un établissement collectif (type EHPAD) ;</li>
    <li>Personnel soignant, pompiers, aides à domicile (plus de 50 ans) ;</li>
    <li>Personnes en situation de handicap vulnérables qui sont hébergées en maison d'accueil spécialisées (MAS) et en foyer d'accueil médicalisé (FAM).</li>
</ul>

<h3 style="margin-top : 50px;">18 janvier</h3>
<ul>
    <li>Personnes âgées de plus de 75 ans en priorité ; puis personnes âgées de plus de 65 ans dans un second temps,</li>
</ul>

<h3 style="margin-top : 50px;">Février ou mars</h3>
<ul>
    <li>Personnes âgées de plus de 65 ans.</li>
</ul>

<h3 style="margin-top : 50px;">Fin mars</h3>
<ul>
    <li>Personnes âgées de plus de 50 ans,</li>
    <li>Personnes travaillant dans un secteur "essentiel" (*),</li>
    <li>Personne vulnérable ou précaire,</li>
    <li>Personne majeure vivant dans un hébergement confiné ou un lieu clos (**).</li>
</ul>

<h3 style="margin-top : 50px;">Été</h3>
<ul>
    <li>Ensemble de la population.</li>
    </ul>
<br>
(*) Les secteurs considérés comme "essentiels" sont les domaines de la sécurité, de l'éducation et de l'alimentaire, indispensables "au fonctionnement du pays en période épidémique", selon le ministère de la Santé.
(**) Le ministère de la Santé ne donne pas plus de précisions concernant "les hébergements confinés ou les lieux clos". Interrogée par franceinfo sur cette question, la DGS donne uniquement pour exemple les "foyers de travailleurs migrants".
<br>
<h2 style="margin-top : 80px;">Vaccination dans le monde</h2>
Ce graphique présente le nombre de doses administrées pour 100 personnes de chaque habitant. Pour la plupart des vaccins, 2 doses sont nécessaires. L'immunité collective serait atteinte à partir d'environ 120 doses pour 100 habitants.
<iframe src="https://ourworldindata.org/grapher/covid-vaccination-doses-per-capita?tab=chart&stackMode=absolute&time=latest&region=World" loading="lazy" style="width: 100%; height: 600px; border: 0px none;"></iframe>
<br>
<br>
Ce graphique présente le nombre de doses administrées dans chaque pays.
<iframe src="https://ourworldindata.org/grapher/cumulative-covid-vaccinations?tab=chart&stackMode=absolute&time=latest&region=World" loading="lazy" style="width: 100%; height: 600px; border: 0px none;"></iframe>
<br>
<br>
Auteur : <a href="https://twitter.com/guillaumerozier">Guillaume Rozier</a>. Contributeurs : .


<style>

.tableau-div{
    width: 50vh;
    height: 50vh;
}

@media screen and (max-width: 700px){
    .tableau-div{
    width: 100vh;
    height: 100vh;
    }
}

.wrap {
        display: flex;
        margin-top: 0px;
        flex-wrap: wrap;
  }
  .wrap>* {
        flex: 1 1 200px;
    }

    .one {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        margin-right: 15px;
        max-width: 400px;
        text-align: left;
        /*box-shadow: 6px 4px 25px #c3d19d;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100%;
        background: #ffffff;
  }

    .two {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        max-width: 400px;
        text-align: left;
        /*  box-shadow: 6px 4px 25px #ffa29c;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        background: #ffffff;
        width: 100%;

  }

p{
    font-size: 120%;
}

.shadow-btn {
        border: 0px solid black;
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: #ffffff;
    }

.shadow-btn-green {
    border: 0px solid black;
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(0, 128, 0, 0.317);
    max-width: 350px;
    background: #ffffff;
}

.shadow-btn-orange {
    border: 0px solid black;
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(128, 115, 0, 0.317);
    max-width: 350px;
    background: #ffffff;
}

.shadow-btn-red {
    border: 0px solid black;
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(128, 0, 0, 0.317);
    max-width: 350px;
    background: #ffffff;
}

.shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 450px;
        background: #ffffff;
        margin-top: 10px;
    }

    .btn-shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 450px;
        background: #ffffff;
        margin-top: 3px;
    }

table, tr, td {
  border: 1px solid white;
}

body {
    font-size: 16px;
}

td {
    width: 1%;
    height: 1%;
}

.green {
    background-color: rgb(45, 189, 84);
}

.red {
    background-color: rgb(237, 88, 88);
}

.grey {
    background-color: rgb(207, 169, 169);
}


.blink_me {
  animation: blinker 3s ease infinite;
  animation-delay: 2s;
}

@keyframes blinker {
  50% {
    background-color: rgb(45, 189, 84);
  }
}


#subtableVaccin, #subtableVaccin tr, #subtableVaccin td {
    border: none;
}

#subtableVaccin {
    width: 100%;
    height: 100%;
}

#subtableVaccin tr {
    height: 10%;
}

</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js" integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>

<script type="text/javascript">

function numberWithSpaces(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "&nbsp;");
}
function formaterDate (date) {
  if (!(date instanceof Date)) return String(date);
  return date.toLocaleDateString("fr-FR", {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}


// ref: http://stackoverflow.com/a/1293163/2343
    // This will parse a delimited string into an array of
    // arrays. The default delimiter is the comma, but this
    // can be overriden in the second argument.
    function CSVToArray( strData, strDelimiter ){
        // Check to see if the delimiter is defined. If not,
        // then default to comma.
        strDelimiter = (strDelimiter || ",");

        // Create a regular expression to parse the CSV values.
        var objPattern = new RegExp(
            (
                // Delimiters.
                "(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +

                // Quoted fields.
                "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +

                // Standard fields.
                "([^\"\\" + strDelimiter + "\\r\\n]*))"
            ),
            "gi"
            );


        // Create an array to hold our data. Give the array
        // a default empty first row.
        var arrData = [[]];

        // Create an array to hold our individual pattern
        // matching groups.
        var arrMatches = null;


        // Keep looping over the regular expression matches
        // until we can no longer find a match.
        while (arrMatches = objPattern.exec( strData )){

            // Get the delimiter that was found.
            var strMatchedDelimiter = arrMatches[ 1 ];

            // Check to see if the given delimiter has a length
            // (is not the start of string) and if it matches
            // field delimiter. If id does not, then we know
            // that this delimiter is a row delimiter.
            if (
                strMatchedDelimiter.length &&
                strMatchedDelimiter !== strDelimiter
                ){

                // Since we have reached a new row of data,
                // add an empty row to our data array.
                arrData.push( [] );

            }

            var strMatchedValue;

            // Now that we have our delimiter out of the way,
            // let's check to see which kind of value we
            // captured (quoted or unquoted).
            if (arrMatches[ 2 ]){

                // We found a quoted value. When we capture
                // this value, unescape any double quotes.
                strMatchedValue = arrMatches[ 2 ].replace(
                    new RegExp( "\"\"", "g" ),
                    "\""
                    );

            } else {

                // We found a non-quoted value.
                strMatchedValue = arrMatches[ 3 ];

            }


            // Now that we have our value string, let's add
            // it to the data array.
            arrData[ arrData.length - 1 ].push( strMatchedValue );
        }

        // Return the parsed data.
        return( arrData );
    }

const OBJECTIF_FIN_JANVIER = 1000000 // 1_000_000
var data;
var nb_vaccines = [];


var dejaVaccinesNb;
var dejaVaccines;
var restantaVaccinerImmunite;
var restantaVaccinerAutres = 100
var objectifQuotidien;
var dateProjeteeObjectif;

var dosesRecues = 560000;

var data_stock;
var dates_stock=[];
var stock=[];
var cumul_stock=0;

var data_news = [];
var titre_news = [];
var contenu_news = [];
var updated = false;
const table = document.getElementById("tableauVaccin");


fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data_stock.csv', {cache: 'no-cache'})
       .then(response => {
           if (!response.ok) {
               throw new Error("HTTP error " + response.status);
           }
           return response.text();
       })
       .then(csv => {
          this.data_stock = csv;

          array_data_stock = CSVToArray(csv, ",");
          array_data_stock.slice(1, array_data_stock.length-1).map((value, idx) => {
            this.dates_stock.push(value[0])
            this.stock.push(parseInt(value[1]));
            this.cumul_stock += parseInt(value[1]);
          })

          fetchOtherData();

        })
       .catch(function () {
           this.dataError = true;
           console.log("error1")
       }
      )

fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/news.csv', {cache: 'no-cache'})
       .then(response => {
           if (!response.ok) {
               throw new Error("HTTP error " + response.status);
           }
           return response.text();
       })
       .then(csv => {
          this.data_news = csv;

          array_data_news = CSVToArray(csv, ",");
          array_data_news.slice(1, array_data_news.length-1).map((value, idx) => {
            this.titre_news.push(value[0])
            this.contenu_news.push(value[1]);
          })

          afficherNews();
          //console.log(contenu_news)

        })
       .catch(function () {
           this.dataError = true;
           console.log("error2")
       }
      )

function fetchOtherData(){
    // Get data from Guillaume csv
    fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data.csv', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.text();
        })
        .then(csv => {
            this.data = csv;
            array_data = CSVToArray(csv, ",");
            array_data.slice(1, array_data.length-1).map((value, idx) => {
                nb_vaccines.push({
                  date: value[0],
                  heure: value[2],
                  total: value[1],
                  source: value[3]
                });
            });

            if(updated) { // si on a les données des 2 sources (csv covidtracker + gouv)
              nb_vaccines = nb_vaccines.filter((v,i,a)=>a.findIndex(t=>(t.date == v.date))===i); // suppression doublons
              nb_vaccines = nb_vaccines.sortBy('date'); // tri par date
              dejaVaccinesNb = nb_vaccines[nb_vaccines.length-1].total
              dejaVaccines = dejaVaccinesNb*100/67000000;
              restantaVaccinerImmunite = 60 - dejaVaccines
              this.dateProjeteeObjectif = calculerDateProjeteeObjectif();
              this.objectifQuotidien = calculerObjectif();
              majValeurs();
              buildLineChart();
            } else {
              updated = true;
            }
        })
        .catch(function () {
            this.dataError = true;
            console.log("error3")
        }
      )

    // Get data from health ministry csv
    fetch('https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d', {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.text();
        })
        .then(csv => {
            this.data = csv;
            array_data = CSVToArray(csv, ";");
            array_data.slice(1, array_data.length-1).map((value, idx) => {
                nb_vaccines.push({
                  date: value[0],
                  heure: "19h30",
                  total: value[1],
                  source: "Ministère de la santé"
                });
            });

            if(updated) { // si on a les données des 2 sources (csv covidtracker + gouv)
              nb_vaccines = nb_vaccines.filter((v,i,a)=>a.findIndex(t=>(t.date == v.date))===i); // suppression doublons
              nb_vaccines = nb_vaccines.sortBy('date'); // tri par date
              dejaVaccinesNb = nb_vaccines[nb_vaccines.length-1].total
              dejaVaccines = dejaVaccinesNb*100/67000000;
              restantaVaccinerImmunite = 60 - dejaVaccines
              this.dateProjeteeObjectif = calculerDateProjeteeObjectif();
              this.objectifQuotidien = calculerObjectif();
              majValeurs();
              buildLineChart();
            } else {
              updated = true;
            }
        })
        .catch(function () {
            this.dataError = true;
            console.log("error4")
        }
      )

}
var lineChart;

function calculerObjectif(){

    let one_day = (1000 * 60 * 60 * 24)
    let jours_restant = (Date.parse("2021-01-31") - Date.parse(nb_vaccines[nb_vaccines.length-1].date) )/ one_day
    let objectif = OBJECTIF_FIN_JANVIER;
    let resteAVacciner = objectif - nb_vaccines[nb_vaccines.length-1].total
    console.log(jours_restant)
    if ((resteAVacciner>=0) && (jours_restant>=0)){
        return Math.round(resteAVacciner/jours_restant)
    } else {
        return -1
    }
}

function afficherNews(){
    var html_str = ""

    titre_news.forEach((value, idx)=>{
        html_str += `<i>` + value + `</i><br>`+ contenu_news[idx]

        if(idx<titre_news.length-1){
            html_str += `<br><br>`
        }
    })
    //document.getElementById("news").innerHTML = `<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">` + html_str + `</div>`;

}


function calculerDateProjeteeObjectif () {
  const objectif = OBJECTIF_FIN_JANVIER
  const indexDerniereMaj = nb_vaccines.length - 1;
  const indexDebutFenetre = Math.max(0, indexDerniereMaj - 7)
  const derniereMaj = Date.parse(nb_vaccines[indexDerniereMaj].date)
  const resteAVacciner = objectif - Number(nb_vaccines[indexDerniereMaj].total)
  const differentielVaccinesFenetre = Number(nb_vaccines[indexDerniereMaj].total) - Number(nb_vaccines[indexDebutFenetre].total)
  const differentielVaccinesParJour = differentielVaccinesFenetre / (indexDerniereMaj - indexDebutFenetre)
  const oneDay = (1000 * 60 * 60 * 24)
  const nbJoursAvantObjectif = Math.round(resteAVacciner / differentielVaccinesParJour)
  return new Date(derniereMaj + (oneDay * nbJoursAvantObjectif))
}

function buildLineChart(){

    var ctx = document.getElementById('lineVacChart').getContext('2d');

    this.lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: nb_vaccines.map(val => val.date),
            datasets: [{
                label: 'Nombre cumulé de vaccinés ',
                data: nb_vaccines.map(val => val.total),
                borderWidth: 3,
                backgroundColor: 'rgba(0, 168, 235, 0.5)',
                borderColor: 'rgba(0, 168, 235, 1)',
                cubicInterpolationMode: 'monotone'
            },
            ]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                deferred: {
                    xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                    yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                    delay: 500      // delay of 500 ms after the canvas is considered inside the viewport
                }
                },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                     },
                    ticks: {
                        min: 0
                    },

                }],
                xAxes: [{
                    gridLines: {
                        display: false
                     },
                     ticks: {
                        maxRotation: 0,
                        minRotation: 0,
                        maxTicksLimit: 6,
                        callback: function(value, index, values) {
                        return value.slice(8) + "/" + value.slice(5, 7);
                     }
                     }

                }]
            },
            annotation: {
            events: ["click"],
            annotations: [

            ]
        }
        }
    });
}

function buildBarChart(data){

    var ctx = document.getElementById('lineVacChart').getContext('2d');

    this.lineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nb_vaccines.map(val => val.date),
            datasets: [{
                label: 'Nombre quotidien de vaccinés ',
                data: data,
                borderWidth: 3,
                backgroundColor: 'rgba(0, 168, 235, 0.5)',
                borderColor: 'rgba(0, 168, 235, 1)',
                cubicInterpolationMode: 'monotone'
            },
            ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                     },
                    ticks: {
                        min: 0
                    },

                }],
                xAxes: [{
                    gridLines: {
                        display: false
                     },
                     ticks: {
                        maxRotation: 0,
                        minRotation: 0,
                        maxTicksLimit: 6,
                        callback: function(value, index, values) {
                        return value.slice(8) + "/" + value.slice(5, 7);
                     }
                     }

                }]
            },
            annotation: {
            events: ["click"],
            annotations: [

            ]
        }
        }
    });
}
function typeDonneesChart(){
    type_donnees = document.getElementById("type").value
    this.lineChart.destroy()
    document.getElementById("objectif").checked=false;
    if (type_donnees=="quotidien"){

        nb_vaccines_quot = [nb_vaccines[0].total]
        for(i=0; i<nb_vaccines.length-1; i++){
            nb_vaccines_quot.push(nb_vaccines[i+1].total-nb_vaccines[i].total)
        }
        buildBarChart(nb_vaccines_quot);
    } else {
        buildLineChart();
    }
    //this.lineChart.update();
}
function ajouterObjectifAnnotation(){
    type_donnees = document.getElementById("type").value
    if (type_donnees=="quotidien"){
        obj = objectifQuotidien;
    }
    else {
        obj = OBJECTIF_FIN_JANVIER;
    }
    if (this.lineChart.options.annotation.annotations.length==0){
    this.lineChart.options.annotation.annotations.push(
                    {
                    drawTime: "afterDatasetsDraw",
                    id: "hline",
                    type: "line",
                    mode: "horizontal",
                    scaleID: "y-axis-0",
                    value: obj,
                    borderColor: "green",
                    borderWidth: 3,
                    label: {
                        backgroundColor: "green",
                        content: "Objectif",
                        enabled: true
                    },
                    onClick: function(e) {
                        console.log("Annotation", e.type, this);
                    }
                    });
    } else {
        this.lineChart.options.annotation.annotations = [];
    }
        this.lineChart.update()
}

tableVaccin(table, 0);
function tableVaccin(tableElt, level){
    tableElt.innerHTML = "";
    let first = true;
    for(let i=0; i<10; i++){
        let row = tableElt.insertRow();

        for(let j=0; j<10; j++){
            let newrow = row.insertCell(j)

            let caseNb = i*10+j+1
            if((caseNb <= dejaVaccines && level == 0) || (caseNb <= (dejaVaccines - Math.floor(dejaVaccines))*100) && level == 1){
                newrow.classList.add("green");
            } else {
                if(first) {
                    if(level == 1) {
                        newrow.classList.add("blink_me");
                        newrow.classList.add(dejaVaccines >= 60 ? "grey" : "red");
                        first = false;
                    } else {
                        const subtable = document.createElement("table");
                        subtable.id = "subtableVaccin";
                        newrow.appendChild(subtable);
                        first = false;
                        tableVaccin(subtable, level+1);
                    }
                } else if((caseNb <= 60 && level == 0) || ((dejaVaccines ?? 0) < 60 && level == 1)) {
                    newrow.classList.add("red");
                } else {
                    newrow.classList.add("grey");
                }
            }
        }
    }
}

function majValeurs(){

    if (nb_vaccines[nb_vaccines.length-1].source == "Estimation"){
        document.getElementById("estimation_str").innerHTML = "⚠️ Données non consolidées";
    }

    document.getElementById("nb_vaccines").innerHTML = numberWithSpaces(dejaVaccinesNb);
    document.getElementById("nb_vaccines_24h").innerHTML = numberWithSpaces(dejaVaccinesNb - nb_vaccines[nb_vaccines.length-2].total);
    document.getElementById("nb_doses").innerHTML = numberWithSpaces(cumul_stock);
    document.getElementById("proportionVaccines").innerHTML = (Math.round(dejaVaccines*10000000)/10000000).toFixed(2);
    document.getElementById("proportion_doses").innerHTML = (dejaVaccinesNb/cumul_stock*100).toFixed(1);

    document.getElementById("proportionAVaccinerImmu").innerHTML = (Math.round(restantaVaccinerImmunite*10000000)/10000000).toFixed(2);
    document.getElementById("objectif_quotidien").innerHTML = numberWithSpaces(objectifQuotidien);
    document.getElementById("date_projetee_objectif").innerHTML = formaterDate(dateProjeteeObjectif);
    date = nb_vaccines[nb_vaccines.length-1].date
    date = date.slice(8) + "/" + date.slice(5, 7)
    heure = nb_vaccines[nb_vaccines.length-1].heure

    date_stock = dates_stock[dates_stock.length-1]
    date_stock = date_stock.slice(8) + "/" + date_stock.slice(5, 7)

    //document.getElementById("date_maj_1").innerHTML = date + " à " + heure;
    document.getElementById("date_maj_2").innerHTML = date + " à " + heure;
    document.getElementById("date_maj_3").innerHTML = date + " à " + heure;
    document.getElementById("date_maj_4").innerHTML = date_stock;
    tableVaccin(table, 0);

}

Array.prototype.sortBy = function(p) {
  return this.slice(0).sort(function(a,b) {
    return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
  });
}

</script>

<!-- /wp:html -->
<!-- wp:html -->
<?php include(__DIR__ . '/vaccintrackerStyles.php'); ?>

<br>
<h2 style="margin-top: 40px;">Menu</h2>
  <div shadow="" style="margin-bottom: 5px;">
  <div class_perso="">
    <div>
      <center><h3>Dashboards</h3><br></center>
  <p>Ces tableaux de bord permettent de suivre et mieux comprendre l'évolution de l'épidémie.</p><br>
  <center>
  <a href="https://covidtracker.fr/covidtracker-france/" style="color:black"><button>🇫🇷 <b>France</b></button></a>
  <a href="https://covidtracker.fr/dashboard-regions/" style="color:black"><button>📍 Régions</button></a>
  <a href="https://covidtracker.fr/dashboard-departements/" style="color:black"><button>🏡 <b>Départements</b></button></a><br>
  <a href="https://covidtracker.fr/covidtracker-world/" style="color:black"><button>🌍 World</button></a>
      </center>
    </div>

    <div>
      <center>
        <h3>Outils</h3><br></center>
  <p>Ces outils permettent de comparer les deux vagues, de calculer le risque de présence d'un cas de covid19, et d'estimer la durée du confinement en cours.</p>
  <center> <a href="https://covidtracker.fr/vaccintracker/" style="color:black"><button>💉 <b>VaccinTracker</b></button></a>
  <a href="https://covidtracker.fr/deconfitracker/" style="color:black"><button>🔥 DéconfiTracker</button></a><a href="https://covidtracker.fr/covidep/" style="color:black"><button>🆕 CoviDep</button></a>
  <a href="https://covidtracker.fr/calculateur-risque-covid/" style="color:black"><button>🔢 CoviRisque</button></a>
  <a href="https://covidtracker.fr/archives/" style="color:black"><br><i>Outils archivés</i></a>
      </center>
    </div>
  </div>
  </div>
<br>
<br>
<!-- /wp:html -->

<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="https://covidtracker.fr/don" target="_blank" rel="noreferrer noopener">☕️ Offrez-moi un café</a></div>

<!-- wp:spacer -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
