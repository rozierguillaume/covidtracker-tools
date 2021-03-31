

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

    .shadow-btn-green {
        color: black;
        border: 2.5px solid rgba(139, 201, 170, 0.7);
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: rgba(242, 255, 242, 0.3);
        min-height:130px;
        max-height:130px;

        
    }

    .shadow-btn-green:hover {
        border: 2.5px solid rgba(139, 201, 170, 1);
        
    }

    .shadow-btn-red {
        color: black;
        border: 2.5px solid rgba(201, 139, 139, 0.7);
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: rgba(255, 242, 243, 0.3);
        min-height:130px;
        min-height:130px;
    }

    .shadow-btn-red:hover {
        border: 2.5px solid rgba(201, 139, 139, 1);
        
    }

    .shadow-btn-black {
        color: black;
        border: 2px solid rgba(0, 0, 0, 0.3);
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: rgba(237, 237, 237, 0.3);
        min-height:100px;
        max-height: 100px;
    }

    .shadow-btn-black:hover {
        border: 2.5px solid rgba(0, 0, 0, 0.5);
        
    }

.div-doses{
    border: 2px solid rgba(222, 222, 222, 1);
    padding: 30px;
    border-radius: 7px;
    background: rgb(245, 245, 245, 0.8);
}

.p {
    font-size: 170% !important;
}
    
</style>

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
    <select id="dep-select" onchange="depChanged()" style="margin-top: 20px;">
        <option value="">-- Choisissez une option --</option>
    </select>

    <span id="rdv"></span>
</div>

<?php include(__DIR__ . '/vaccin-map.html') ?>

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
                fetchDataDep("no")
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
    html_txt = "<option value='no'>-- Choisissez une option --</option>"
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
    if(dep=='no'){
        html_txt="<h3>Aucun département sélectionné.</h3><p>Merci de sélectionner votre département ci-dessus. Les rendez-vous trouvés s'afficheront ici.</p>"
        document.getElementById("rdv").innerHTML = html_txt
    } else {

        keldoc_logo = "https://www.keldoc.com/keldoc-logo.nolqip.e7abaad88d1642c9c1f2.png"
        maiia_logo = "https://www.rmingenierie.net/wp-content/uploads/2019/12/logo-Maiia-vert.png"
        doctolib_logo = "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Logo_Doctolib.svg/1024px-Logo_Doctolib.svg.png"
        autre_logo = ""

        html_txt = ""
        if("slots" in data_dep){
            html_txt = "<h2 style='margin-top: 30px;'>Résultats pour le département " + dep + "</h2><h3 style='margin-top: 40px;'>✅ Rendez-vous Doctolib trouvés</h3>"

            if ("scan_time" in data_dep){
                dernier_scan = data_dep.scan_time
            } else {
                dernier_scan= "--/--"
            }

            nb_centres = data_dep.slots.length
            if(nb_centres>0){
                html_txt += "<p>Nous avons trouvé " + nb_centres + " centre(s) ayant des disponibilités sur Doctolib. Dernier scan : " + dernier_scan + ".</p>" 
                html_txt += "<div class='row'>"

                data_dep.slots.map((value, idx) => {
                    html_txt += ` 
                        <a target="_blank" title="Doctolib" href="{{lien}}">
                        <card class="shadow-btn-green col-xs-11 col-md-4">
                            <b><span style='font-size: 120%'>{{date}}</span><br></b>
                            {{nom}}<br>
                            <img style="position: absolute; bottom: 5; right: 5;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Logo_Doctolib.svg/1024px-Logo_Doctolib.svg.png" width="70px"></img>
                            
                            
                        </card></a>
                        `.replace("{{nom}}", data_dep.noms[idx])
                        .replace("{{lien}}", data_dep.urls[idx] )
                        .replace("{{date}}", value)
                })
                html_txt+= "</div>"

        } else {
            html_txt = "<h2 style='margin-top: 30px;'>Résultats pour le département " + dep + "</h2><h3 style='margin-top: 40px;'>❌ Aucun rendez-vous trouvé pour le département (" + dep + ")</h3>"
            html_txt += "<p>Nous n'avons trouvé aucun centre ayant des disponibilités sur Doctolib. Dernier scan : " + dernier_scan + ".</p>" 
            html_txt += `  
                <div class='row'>
                <card class="shadow-btn col-xs-11 col-md-4" style="margin-bottom: 50px;">
                            <i>
                            La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
                    </card></div>
                    `
        }

        } else {
            html_txt = "<h3 style='margin-top: 40px;'>Aucun rendez-vous Doctolib n'a été trouvé</h3>"
            html_txt += ` 
                    <div class='row'> 
                    <card class="shadow-btn col-md-11" style="margin-bottom: 50px;">
                        <i>
                        La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
                    </card></div>
                    `
            
        }
        document.getElementById("rdv").innerHTML = html_txt

        if ("urls_pas_de_rdv" in data_dep) {
            html_txt = "<h3 style='margin-top: 40px;'>❌ Autres centres sur Doctolib</h3><p>Aucun rendez-vous détecté dans ces centres, mais nous vous conseillons néanmoins de parcourir les liens, au cas où.</p>"
            html_txt += "<div class='row'>"

            data_dep.urls_pas_de_rdv.map((value, idx) => {
                    html_txt += ` 
                        <a target="_blank" title="Doctolib" href="{{lien}}">
                        <card class="shadow-btn-red col-xs-11 col-md-4">
                            <b><span style='font-size: 120%'>Aucun RDV détecté</span><br></b>
                            {{nom}}<br>
                            <img style="position: absolute; bottom: 5; right: 5;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Logo_Doctolib.svg/1024px-Logo_Doctolib.svg.png" width="70px"></img>
                            
                        </card></a>
                        `.replace("{{nom}}", data_dep.noms_pas_de_rdv[idx])
                        .replace("{{lien}}", value )
                })
            
            document.getElementById("rdv").innerHTML += html_txt

        }

        if ("urls_autres" in data_dep) {
            html_txt = "<h3 style='margin-top: 40px;'>🤷🏻‍♂️ Autres centres sur d'autres plateformes</h3><p>Nous ne pouvons actuellement pas détecter les RDV disponibles sur ces plateformes.</p>"
            html_txt += "<div class='row'>"

            data_dep.urls_autres.map((value, idx) => {
                logo_url = autre_logo

                if(value.includes('maiia')){
                    logo_url = maiia_logo
                } else if(value.includes('keldoc')){
                    logo_url=keldoc_logo
                } else if(value.includes('doctolib')){
                    logo_url=doctolib_logo
                } else{
                    logo_url = autre_logo
                }

                html_txt += ` 
                    <a target="_blank" title="Doctolib" href="{{lien}}">
                    <card class="shadow-btn-black col-xs-11 col-md-4">
                        <b></b>
                        {{nom}}<br>
                        <img style="position: absolute; bottom: 5; right: 5;" src="{{logo_url}}" width="70px"></img>
                        
                        
                    </card></a>
                    `.replace("{{nom}}", data_dep.noms_autres[idx])
                    .replace("{{lien}}", value )
                    .replace("{{logo_url}}", logo_url)
                })
            
            document.getElementById("rdv").innerHTML += html_txt

        }
    }
}

</script>
