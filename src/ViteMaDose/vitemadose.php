


<p>
    Vite Ma Dose ! est un outil de CovidTracker permettant de détecter les rendez-vous disponibles dans votre département afin de vous faire vacciner (sous réserve d'éligibilité). Pour l'instant, seule la plateforme Doctolib est supportée. <i>Vite Ma Dose ! n'est pas un outil officiel, n'est pas exhaustif et ne remplace pas une recherche manuelle.</i>
</p>
<br><br>

<div class="alert alert-info clearFix" style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            CovidTracker est gratuit, indépendant et sans publicités.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍪
                    Offrez-moi un cookie</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<div class="div-doses">
    Merci de sélectionner votre département ci-dessous. Les rendez-vous trouvés s'afficheront plus bas.
    <br><br>
    <select name="dep" id="dep-select" onchange="depChanged()">
        <option value="">-- Choisissez une option --</option>
    </select>

    <span id="rdv"></span>
</div>

<?php include('./vaccin-map.html') ?>

<div class="alert alert-info clearFix"  style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            <small>À VOIR AUSSI...</small><br>
            Combien de personnes ont été vaccinées ? Suivez la campagne vaccinale sur VaccinTracker.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/vaccintracker" target="_blank" rel="noreferrer noopener">Accéder à 💉 <b>VaccinTracker</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>
<br>

<br>
Auteur : Guillaume Rozier

<style>
button {
    border: 1px solid;
    margin: 10px;
    padding: 15px;
    font-size : 16px;
    transition-duration: 0.4s;
    background-color: #ffffff;
    border-radius: 15px;

}

.shadow-btn {
        color: black;
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
        min-height:170px;
    }

.div-doses{
    border: 2px solid rgba(222, 222, 222, 1);
    padding: 30px;
    border-radius: 7px;
    background: rgb(245, 245, 245, 0.8);
}

.p {
    font-size: 150% !important;
}
    
</style>

<script>

fetchData();
var data;
function fetchData(){
    // Get data from Guillaume csv
        fetch('https://raw.githubusercontent.com/rozierguillaume/vitemadose/main/data/output/slots_dep.json', {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.data = json;
                populateSelect();
                fetchDataDep("01")
        })
        .catch(function () {
            this.dataError = true;
            console.log("error")
        }
      )
}

var data_dep;
function fetchDataDep(dep){
        fetch('https://raw.githubusercontent.com/rozierguillaume/vitemadose/main/data/output/temp/{dep}.json'.replace('{dep}', dep), {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                console.log(json)
                this.data_dep = json;
                showRdvForDep(dep);
        })
        .catch(function () {
            data_dep = {"no_data": ""}
            showRdvForDep(dep);
            console.log("error")
        }
      )
}


function populateSelect(){
    html_txt = ""
    data.departements.map((value, idx) => {
        
        html_txt += "<option value='" + value + "'>" + value + " " + data.departements_noms[idx] + "</option>" //
    })
    document.getElementById("dep-select").innerHTML = html_txt

}

function depChanged(){
    let dep = document.getElementById("dep-select").value
    fetchDataDep(dep);
    
}

function showRdvForDep(dep){
    
    if("slots" in data_dep){
        html_txt = "<h3 style='margin-top: 40px;'>Rendez-vous trouvés pour ce département (" + dep + ") :</h3>"

        if ("scan_time" in data_dep){
            dernier_scan = data_dep.scan_time
        } else {
            dernier_scan= "--/--"
        }

        nb_centres = data_dep.slots.length
        if(nb_centres>0){
            html_txt += "Nous avons trouvé " + nb_centres + " centres ayant des disponibilités sur Doctolib. Dernier scan : " + dernier_scan + ".<br><br>" 
            html_txt += "<div class='row'>"

            data_dep.slots.map((value, idx) => {
                html_txt += ` 
                    <a target="_blank" title="Doctolib" href="{{lien}}">
                    <card class="shadow-btn col-xs-11 col-md-4">
                        <b><span style='font-size: 120%'>{{date}}</span><br></b>
                        {{nom}}<br>
                        <i>Réservation Doctolib</i>
                        
                    </card></a>
                    `.replace("{{nom}}", data_dep.noms[idx])
                    .replace("{{lien}}", data_dep.urls[idx] )
                    .replace("{{date}}", value)
            })

    } else {
        html_txt = "<h3 style='margin-top: 40px;'>Aucun rendez-vous trouvé pour le département (" + dep + ")</h3>"
        html_txt += "Nous n'avons trouvé aucun centre ayant des disponibilités sur Doctolib. Dernier scan : " + dernier_scan + ".<br><br>" 
        html_txt += `  
            <div class='row'>
            <card class="shadow-btn col-xs-11 col-md-4" style="margin-bottom: 50px;">
                        <i>
                        La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
                </card>
                `
    }

    } else {
        html_txt = "<h3 style='margin-top: 40px;'>Aucun rendez-vous trouvé pour le département (" + dep + ")</h3>"
        html_txt += ` 
                <div class='row'> 
                <card class="shadow-btn col-md-11" style="margin-bottom: 50px;">
                    <i>
                    La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
                </card>
                `
        
    }
    document.getElementById("rdv").innerHTML = html_txt
}

</script>
