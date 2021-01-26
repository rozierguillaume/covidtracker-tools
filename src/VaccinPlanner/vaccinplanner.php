
<div class="" style="margin-bottom: 40px;">
  <p> 
    Quel est le rythme de vaccination actuel ? Combien reste-t-il de personne à vacciner avant moi ?
    VaccinPlanner est un outil de CovidTracker vous permettant d'évaluer la date à laquelle vous pourrez vous faire vacciner contre la Covid19 en fonction de votre situation et du rythme actuel de vaccination. Les projections sont mises à jour quotidiennement en fonction de l'évolution de la campagne vaccinale. Le données du rythme et le calendrier de vaccination proviennent du Ministère de la Santé. Suivez aussi l'évolution de la campagne vaccinale sur <a href="https://covidtracker.fr/vaccintracker">VaccinTracker ></a>.
  <p>
</div>

<form id="queue-vaccin" action="#">
    <ul id="section-tabs">
      <li class="current active"><span>1.</span> Profil</li>
      <li><span>2.</span> Contre-indications</li>
      <li><span>3.</span> Résultat</li>
    </ul>
  <div id="fieldsets">
  <fieldset class="current">
  	<p class="inline-form"><label for="age">Âge : </label><input type="number" name="age" id="age" style="width: 100px; margin-right: 10px;"/> ans</p>
  	<p><label for="ehpad" class="checkbox-label"><input type="checkbox" name="ehpad" value="1" id="ehpad">  <span class="checkmark"></span> Je travaille ou réside en EHPAD</label></p>
  	<p><label for="soignant" class="checkbox-label"><input type="checkbox" name="soignant" value="1" id="soignant">  <span class="checkmark"></span> Je suis professionnel en santé, aide à domicile ou pompier</label></p>
  	<p><label for="handicap" class="checkbox-label"><input type="checkbox" name="handicap" value="1" id="handicap">  <span class="checkmark"></span> Je travaille ou réside en maison d’accueil spécialisée/médicalisée</label></p>
	<p><label for="high-risky" class="checkbox-label"><input type="checkbox" name="high-risky" value="1" id="high-risky">  <span class="checkmark"></span> Je suis à très haut risque <span class="tooltip"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/VisualEditor_-_Icon_-_Help.svg/1200px-VisualEditor_-_Icon_-_Help.svg.png" alt="Aide" style="width: 20px;"><span class="tooltiptext">Actuellement sous chimiothérapie, porteur de maladie rénale chronique sévère, transplanté d'organes solides, ayant 2 insuffisances d'organes, maladies rares à risque en cas d'infection, trisomie 21 ou transplanté par allogreffe.</span></span></label></p>
	<p><label for="comobidities" class="checkbox-label"><input type="checkbox" name="comobidities" value="1" id="comobidities">  <span class="checkmark"></span> Je présente d'autres pathologies</label></p>

  </fieldset>
  <fieldset class="next">
  	<p>
      <label for="pregnant" class="checkbox-label"><input type="checkbox" name="pregnant" value="1" id="pregnant">  <span class="checkmark"></span> Je suis enceinte</label>
    </p>
     <p>
      <label for="allergic" class="checkbox-label"><input type="checkbox" name="allergic" value="1" id="allergic">  <span class="checkmark"></span> Je souffre d'allergies graves</label>
    </p>
     <p>
      <label for="covid-recently" class="checkbox-label"><input type="checkbox" name="covid-recently" value="1" id="covid-recently">  <span class="checkmark"></span> J'ai eu la Covid-19 il y a moins de 3 mois</label>
    </p>
     <p>
      <label for="vaccin-recently" class="checkbox-label"><input type="checkbox" name="vaccin-recently" value="1" id="vaccin-recently">  <span class="checkmark"></span> J'ai été vacciné contre la grippe il y a moins de 3 semaines</label>
    </p>
     <p>
      <label for="sick" class="checkbox-label"><input type="checkbox" name="sick" value="1" id="sick">  <span class="checkmark"></span> J'ai de la fièvre ou suis symptomatique</label>
    </p>
     <p>
      <label for="cluster" class="checkbox-label"><input type="checkbox" name="cluster" value="1" id="cluster">  <span class="checkmark"></span> J'ai récemment été en contact avec un cluster</label>
    </p>
  </fieldset>
  <fieldset class="next">
  	<p class="strong-hide">Compte tenu des données renseignées, <strong id="vaccination-impossible"> vous ne pouvez pas vous faire vacciner (<span id="raison"></span>)</strong><strong id="vaccination-impossible-temporaire">vous ne pouvez pas vous faire vacciner pour le moment (<span id="raison-temporaire"></span>)</strong><strong id="vaccination-deja-possible">vous pouvez déjà vous faire vacciner</strong><strong id="vaccination-attente">vous ne pouvez pas encore vous faire vacciner</strong>. </p>

  	<p id="notice-medicale"></p>
  	<p id="dates-vaccin"></p>
  </fieldset>
  <a class="btn" id="next">Continuer ▷</a>
  <p id="maj-queue">Dernière mise à jour le <span id="date_maj_5">--/-- à --h--</span></p>
  <input type="submit" class="btn">
  </div>
</form>
<br>

Combien de personnes ont été vaccinées ? Suivez la campagne vaccinale sur <a href="https://covidtracker.fr/vaccintracker">VaccinTracker en cliquant ici</a>.
<br>

<br>
Auteur : Aymerik Diebold.<br>
<small><i>En aucun cas ces projections ne doivent être considérées comme des prédictions fiables.</i></small>


<style>

p{
    font-size: 120%;
}

#queue-vaccin {
  width: 600px;
  height: auto;
  padding: 20px;
  background: #fff;
  margin: 80px auto;
  position: relative;
  min-height: 310px;
  font-size: 15px;
}

#queue-vaccin p {
	margin: 0;
	font-size: 100%;
}

#fieldsets {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    overflow: hidden;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    background: #fff;
    border-radius: 7px;
    padding: 10px 10px 10px 10px;
}
.inline-form {
    display: flex;
    align-items: baseline;
}
#queue-vaccin input[type=text],
#queue-vaccin input[type=number],
#queue-vaccin input[type=email],
#queue-vaccin input[type=password],
#queue-vaccin input[type=tel],
#queue-vaccin textarea {
  display: block;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 100%;
  box-sizing: border-box;
  border: 1px solid #ddd;
  padding: 8px;
  margin-bottom: 8px;
  position: relative;
}
#queue-vaccin input[type=text]:focus,
#queue-vaccin input[type=number]:focus,
#queue-vaccin input[type=email]:focus,
#queue-vaccin input[type=password]:focus,
#queue-vaccin input[type=tel]:focus,
#queue-vaccin textarea:focus {
  outline: none;
  border: 1px solid #22918b;
}
#queue-vaccin input[type=radio] {
  margin: 6px;
  display: inline-block;
}
#queue-vaccin fieldset {
  border: none;
  position: absolute;
  left: -640px;
  width: 560px;
  padding: 10px 0;
  transition: all 0.3s linear;
  -webkit-transition: all 0.3s linear;
  -moz-transition: all 0.3s linear;
  -ms-transition: all 0.3s linear;
  opacity: 0;
}
#queue-vaccin fieldset.current {
  left: 20px;
  opacity: 1;
}
#queue-vaccin fieldset.next {
  left: 640px;
}
#queue-vaccin input[type=submit] {
  display: none;
  border: none;
}
#section-tabs {
  font-size: 0.8em;
  height: 50px;
  position: relative;
  margin-top: -50px;
  margin-bottom: 50px;
  padding: 0;
  font-weight: bold;
  list-style: none;
  text-transform: uppercase;
}
#section-tabs li {
  color: #a7a7a7;
  cursor: not-allowed;
  border-left: 1px solid #aaa;
  text-decoration: none;
  padding: 0 6px;
  float: left;
  width: 33%;
  box-sizing: border-box;
  text-align: center;
  font-weight: bold;
  line-height: 30px;
  background: #ddd;
  position: relative;
}
#section-tabs li span {
  color: #bababa;
}
#section-tabs li.active {
  color: #444;
  cursor: pointer;
}
#section-tabs li:after {
  content: "";
  display: block;
  margin-left: 0;
  position: absolute;
  left: 0;
  top: 0;
}
#section-tabs li.current {
  opacity: 1;
background: #f8f8f8;  z-index: 999;
  border-left: none;
}

.inline-form label {
	width: 25%;
}

#section-tabs li.current:after {
  border: 15px solid transparent;
  border-left: 15px solid #2cbab2;
}
.error {
  color: #bf2424;
  display: block;
}
input.error,
textarea.error {
  border-color: #bf2424;
}
input.error:focus,
textarea.error:focus {
  border-color: #bf2424;
}
label.error {
  margin-bottom: 20px;
}
input.valid {
  color: green;
}
label.valid {
  position: absolute;
  right: 20px;
}
input + .valid,
textarea + .valid {
  display: none;
}
.valid + .valid {
  display: inline;
  position: absolute;
  right: 10px;
  margin-top: -36px;
  color: green;
}
#queue-vaccin .btn {
  border: none;
  padding: 8px;
  background: #2cbab2;
  cursor: pointer;
  transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  color: #fff;
  position: absolute;
  bottom: 20px;
  right: 20px;
}
#queue-vaccin .btn:hover {
  background: #26a19a;
}

.checkbox-label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 15px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.checkbox-label input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 50%;
    transform: translateY(-50%);
          left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

.checkbox-label:hover input ~ .checkmark {
  background-color: #ccc;
}

.checkbox-label input:checked ~ .checkmark {
  background-color: #2196F3;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.checkbox-label input:checked ~ .checkmark:after {
  display: block;
}

.checkbox-label .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}


.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
  opacity: 1;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 250px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.strong-hide strong {
	display: none;
}

#queue-vaccin label {
	font-weight: normal;
}

p#maj-queue {
    font-size: 12px;
    position: absolute;
    bottom: 1px;
    right: 20px;
    font-style: italic;
}

input#pourcentage-volontaire {
    width: 65px !important;
    display: inline-block !important;
}

@media all and (max-width: 625px) {
	#section-tabs li {
    float: none;
    width: 100%;
}

#section-tabs {
    height: 90px;
    margin-bottom: 0;
}

div#fieldsets {
    top: 60px;
    position: initial;
}

#queue-vaccin fieldset.current {
    padding-left: 20px;
    padding-right: 20px;
}

#queue-vaccin .btn {
    margin-top: -20px;
    margin-bottom: 20px;
    margin-right: 20px;
}

form#queue-vaccin {
    width: 100%;
      min-height: 500px;
}

#queue-vaccin fieldset {
    width: 91%;
    box-sizing: border-box;
}
#queue-vaccin fieldset.next {
    left: 0;
    display: none;
}

.tooltip {
	position: initial;
}
.tooltiptext {
	left: 0;
}

#fieldsets {
	min-height: 500px;
}
}
</style>

<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>

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

var nb_vaccines = [];

let differentielVaccinesParJour;

var updated = false;
fetchOtherData();

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
            array_data.slice(1, array_data.length).map((value, idx) => {
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
              date = nb_vaccines[nb_vaccines.length-1].date
              date = date.slice(8) + "/" + date.slice(5, 7)
              heure = nb_vaccines[nb_vaccines.length-1].heure
              document.getElementById("date_maj_5").innerHTML = date + " à " + heure;
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




function calculerDateProjeteeObjectif () {
  const indexDerniereMaj = nb_vaccines.length - 1;
  const indexDebutFenetre = Math.max(0, indexDerniereMaj - 7)
  const differentielVaccinesFenetre = Number(nb_vaccines[indexDerniereMaj].total) - Number(nb_vaccines[indexDebutFenetre].total)
  differentielVaccinesParJour = differentielVaccinesFenetre / (indexDerniereMaj - indexDebutFenetre)
}




Array.prototype.sortBy = function(p) {
  return this.slice(0).sort(function(a,b) {
    return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
  });
}


	const VACCINATION_AGE_MIN = 75; // Vaccination déjà possible à partir de...
	const VACCINATION_AGE_MIN_SOIGNANT = 50; // Âge min vaccionation soignant
	const VACCIONATION_EHPAD = true;
	const VACCINATION_HAUT_RISQUE = true; // Les personnes à haut risque peuvent se faire vacciner ?
	const VACCINATION_COMORBIDITES = false; // Les personnes à comorbidités peuvent se faire vacciner ?
	const VACCINATIONS_PAR_PHASES = [
		8400000, // nb personnes vaccinables phase 1
		3875029+3681057, // nb personnes vaccinables phase 2 (65-75 ans)
		4125774+4390050+4423849+1882400-1290000, // nb personnes vaccinables phase 3 (50-65 ans + personnels soignants non vaccinés)
		6251974, // nb personnes vaccinables phase 4 (comorbidités non vaccinées)
		15869827 // reste des majeurs
	];

	let vaccinationDejaPossible = false; // le patient peut se faire vacciner dès maintenant
	let vaccinationProscritePermanent = false; // le patient ne pourra pas se faire vacciner (contre indication permanente)
	let vaccinationProscriteTemporaire = false; // le patient a une contre indication temporaire à la vaccination
	let dateEstimationDebut = Date.now();
	let dateEstimationFin = Date.now();
	let nbPersonnesVaccineesMin = 0; // nombre de personnes à vacciner avant la personne utilisant le simulateur
	let nbPersonnesVaccineesMax = 0; // nombre de personnes à vacciner avec la personne utilisant le simulateur (avant + tranche comprise)
	let phaseConcernee = 0; // phase concernée par la personne
  let pourcentageVolontaire = 100; // pourcentage des français voulant se faire vacciner

	let age = 0;
	let ehpad = false;
	let professionnelSante = false;
	let maisonMedicalisee = false;
	let hautRisque = false;
	let pathologies = false;
	let enceinte = false;
	let allergique = false;
	let covid = false;
	let grippe = false;
	let fievre = false;
	let cluster = false;


  const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };


$("#next").on("click", function(e){
  nextSection();
});
 
$("form").on("submit", function(e){
    e.preventDefault();
  });
 
function goToSection(i){
  $("fieldset:gt("+i+")").removeClass("current").addClass("next");
  $("fieldset:lt("+i+")").removeClass("current");
  $("#section-tabs li").eq(i).addClass("current").siblings().removeClass("current");
  setTimeout(function(){
    $("fieldset").eq(i).removeClass("next").addClass("current active");
      if ($("fieldset.current").index() == 2){
        $("#next").text("Recommencer");
      } else {
        $("#next").text("Continuer ▷");
      }
  }, 80);
 
}
 
function nextSection(){
  var i = $("fieldset.current").index();
  if (i == 1) {
  	majDonneesSaisies();
  }
  if (i < 2){
    $("#section-tabs li").eq(i+1).addClass("active");
    goToSection(i+1);
  } else {
    $("#section-tabs li").eq(0).addClass("active");
    RAZ();
  	goToSection(0);
  }
}
 
$("#section-tabs li").on("click", function(e){
  var i = $(this).index();
  if ($(this).hasClass("active")){
    goToSection(i);
  } else {
    // erreur section indisponible
  }
});
 


 function majDonneesSaisies()
 {
 	$('#vaccination-impossible').hide();
 	$('#vaccination-impossible-temporaire').hide();
 	$('#vaccination-attente').hide();
 	$('#vaccination-deja-possible').hide();
 	$('#dates-vaccin').html("");
 	$('#notice-medicale').text("");

	age = Number($('#age').val());
	ehpad = $('#ehpad').is(":checked");
	professionnelSante = $('#soignant').is(":checked");
	maisonMedicalisee = $('#handicap').is(":checked");
	hautRisque = $('#high-risky').is(":checked");
	pathologies = $('#comobidities').is(":checked");;
	enceinte = $('#pregnant').is(":checked");
	allergique = $('#allergic').is(":checked");
	covid = $('#covid-recently').is(":checked");
	grippe = $('#vaccin-recently').is(":checked");
	fievre = $('#sick').is(":checked");
	cluster = $('#cluster').is(":checked");
	
	vaccinationProscritePermanent =  age < 18 || allergique || enceinte;
	vaccinationProscriteTemporaire = !vaccinationProscritePermanent && (covid || fievre || cluster || grippe);
	vaccinationDejaPossible = !vaccinationProscritePermanent && !vaccinationProscriteTemporaire && (
		age >= VACCINATION_AGE_MIN
		|| (professionnelSante && age >= VACCINATION_AGE_MIN_SOIGNANT)
		|| ehpad
		|| maisonMedicalisee
		|| hautRisque
	);

	phaseConcernee = (
		(ehpad || age >= 75 || (professionnelSante && age >= 50) || maisonMedicalisee || hautRisque) ? 0 : (
			age >= 65 ? 1 : (
				age >= 50 || professionnelSante ? 2 : (
					pathologies ? 3 : 4
				)
			)
		)

	);
	nbPersonnesVaccineesMin = nombreVaccinationsAvant(phaseConcernee-1)*pourcentageVolontaire/100;
	nbPersonnesVaccineesMax = nombreVaccinationsAvant(phaseConcernee)*pourcentageVolontaire/100;
	let nbJoursAttenteMin = Number(nbPersonnesVaccineesMin*2/differentielVaccinesParJour);
	let nbJoursAttenteMax = Number(nbPersonnesVaccineesMax*2/differentielVaccinesParJour);
	dateEstimationDebut = (new Date()).addDays(nbJoursAttenteMin);
	dateEstimationFin = (new Date()).addDays(nbJoursAttenteMax);

	const dateMinString = dateEstimationDebut.toLocaleDateString('fr-FR', optionsDate);
	const dateMaxString = dateEstimationFin.toLocaleDateString('fr-FR', optionsDate);

	if(vaccinationProscritePermanent) {
		$('#vaccination-impossible').show();
		$('#raison').text(age < 18 ? "mineur" : (allergique ? "allergie" : "enceinte"));
		$('#notice-medicale').html("<br>Cet outil ne constitue pas un avis médical. Consultez votre médecin pour plus d'informations");
	}
	else if(vaccinationProscriteTemporaire) {
		$('#vaccination-impossible-temporaire').show();
		$('#raison-temporaire').text(fievre ? "présence de symptômes" : (covid ? "infection récente au covid" : (grippe ? "vaccination contre la grippe récente" : "risque de contamination récente à la covid")));
		$('#notice-medicale').html("<br>Cet outil ne constitue pas un avis médical. Consultez votre médecin pour plus d'informations");
		$('#dates-vaccin').html(`<br>Entre <span id="nb-prio-1">${numberWithSpaces(parseInt(nbPersonnesVaccineesMin))}</span> et <span id="nb-prio-2">${numberWithSpaces(parseInt(nbPersonnesVaccineesMax))}</span> personnes doivent encore se faire vacciner avant vous.<br><br>Au rythme actuel de vaccination <em>(${numberWithSpaces(parseInt(differentielVaccinesParJour))} doses administrées par jour en moyenne)</em> et selon votre profil, vous devriez pouvoir être vacciné entre le <strong id="dateMin">${dateMinString}</strong> et le <strong id="dateMax">${dateMaxString}</strong> <em>(sous réserve de ne plus avoir de contre-indication)</em>.<br>Projection réaliséee en considérant que <input type="number" id="pourcentage-volontaire" value="${pourcentageVolontaire}" onChange="majVolontaires()" onInput="majVolontaires()" />% de la pop. souhaite être vaccinée`);
	}
	else if(vaccinationDejaPossible) {
		$('#vaccination-deja-possible').show();
	}
	else {
		$('#vaccination-attente').show();
    $('#dates-vaccin').html(`<br>Entre <span id="nb-prio-1">${numberWithSpaces(parseInt(nbPersonnesVaccineesMin))}</span> et <span id="nb-prio-2">${numberWithSpaces(parseInt(nbPersonnesVaccineesMax))}</span> personnes doivent encore se faire vacciner avant vous.<br><br>Au rythme actuel de vaccination <em>(${numberWithSpaces(parseInt(differentielVaccinesParJour))} doses administrées par jour en moyenne)</em> et selon votre profil, vous devriez pouvoir être vacciné entre le <strong id="dateMin">${dateMinString}</strong> et le <strong id="dateMax">${dateMaxString}</strong>.<br>Projection réaliséee en considérant que <input type="number" id="pourcentage-volontaire" value="${pourcentageVolontaire}" onChange="majVolontaires()" onInput="majVolontaires()" />% de la pop. souhaite être vaccinée`);
	}
 }

 function RAZ()
 {
 	$('#vaccination-impossible').hide();
 	$('#vaccination-impossible-temporaire').hide();
 	$('#vaccination-attente').hide();
 	$('#vaccination-deja-possible').hide();
 	$('#dates-vaccin').html("");
 	$('#notice-medicale').text("");

	$('#age').val("");
	$('#ehpad').prop("checked", false);
	$('#soignant').prop("checked", false);
	$('#handicap').prop("checked", false);
	$('#high-risky').prop("checked", false);
	$('#comobidities').prop("checked", false);
	$('#pregnant').prop("checked", false);
	$('#allergic').prop("checked", false);
	$('#covid-recently').prop("checked", false);
	$('#vaccin-recently').prop("checked", false);
	$('#sick').prop("checked", false);
	$('#cluster').prop("checked", false);

	$("#section-tabs li").eq(1).removeClass("active");
	$("#section-tabs li").eq(2).removeClass("active");
 }
 

function nombreVaccinationsAvant(numeroPhase) {
	let total = 0;
	for(let i = 0 ; i <= numeroPhase ; i++)
	{
		total += VACCINATIONS_PAR_PHASES[i];
	}
	return Math.max(total-dejaVaccinesNb, 0);
}

function majVolontaires() {
  pourcentageVolontaire = Math.max(0, Math.min(100, Number(document.getElementById("pourcentage-volontaire").value)));
    nbPersonnesVaccineesMin = nombreVaccinationsAvant(phaseConcernee-1)*pourcentageVolontaire/100;
  nbPersonnesVaccineesMax = nombreVaccinationsAvant(phaseConcernee)*pourcentageVolontaire/100;
  let nbJoursAttenteMin = Number(nbPersonnesVaccineesMin*2/differentielVaccinesParJour);
  let nbJoursAttenteMax = Number(nbPersonnesVaccineesMax*2/differentielVaccinesParJour);
  dateEstimationDebut = (new Date()).addDays(nbJoursAttenteMin);
  dateEstimationFin = (new Date()).addDays(nbJoursAttenteMax);
  document.getElementById('dateMin').textContent = dateEstimationDebut.toLocaleDateString('fr-FR', optionsDate);
  document.getElementById('dateMax').textContent = dateEstimationFin.toLocaleDateString('fr-FR', optionsDate);
  document.getElementById('nb-prio-1').innerHTML = numberWithSpaces(parseInt(nbPersonnesVaccineesMin));
  document.getElementById('nb-prio-2').innerHTML = numberWithSpaces(parseInt(nbPersonnesVaccineesMax));

}

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

</script>