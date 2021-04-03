
<script>
// DETECTION IFRAME
if (window!=window.top) { 
    document.getElementsByTagName('html')[0].innerHTML = '';
    throw new Error ('iframe');
}

var data;
const LOGO = {
    Keldoc: "https://www.keldoc.com/keldoc-logo.nolqip.e7abaad88d1642c9c1f2.png",
    Maiia: "https://www.rmingenierie.net/wp-content/uploads/2019/12/logo-Maiia-vert.png",
    Doctolib: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Logo_Doctolib.svg/1024px-Logo_Doctolib.svg.png",
    Autre: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAH0CAYAAADhUFPUAAAFxklEQVR42uzBAQEAAACAkP6v7ggCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIDZgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYsWMbgKAAiqI/orCDaNnFGBKdWmFUMxjCYwU/0ZyT3OaN8ACAnzSpLQAAVNGnNe1pKgAAfH6u5nSmKy3vBgDAJ0Pa0pHGAgBAFd2T9woAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOBmDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVpDw4JAAAAAAT9f+0LEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwCyuYE1Qq4nl4AAAAASUVORK5CYII=" // image vide
};

fetchData();
function fetchData(){
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
            console.log("error : no data-slots")
        }
      )
}

var data_dep;
function fetchDataDep(dep){
        fetch(`https://raw.githubusercontent.com/CovidTrackerFr/vitemadose/data-auto/data/output/${dep}.json`, {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
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
            console.log("error : no data-dep")
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
    fetchDataDep(dep)
    
}

function showRdvForDep(dep){
    if(dep=='no'){
        html_txt="<h3>Aucun département sélectionné.</h3><p>Merci de sélectionner votre département ci-dessus. Les rendez-vous trouvés s'afficheront ici.</p>"
        document.getElementById("rdv").innerHTML = html_txt
    } else {


            html_txt = "<h2 style='margin-top: 30px;'>Résultats pour le département " + dep + "</h2>"

            if ("last_updated" in data_dep){
                dernier_scan = (new Date(data_dep.last_updated)).toLocaleString('fr-FR', {day: '2-digit',month: '2-digit', hour: '2-digit', minute: '2-digit'});
            } else {
                dernier_scan= "--/--"
            }

            nb_centres = data_dep.centres_disponibles.length
            if(nb_centres>0){
                html_txt += "<h3 style='margin-top: 40px;'>✅ Rendez-vous trouvés</h3><p>Nous avons trouvé " + nb_centres + " centre(s) ayant des disponibilités sur Doctolib, Maiia ou Keldoc. Dernier scan : " + dernier_scan + ".</p>" 
                html_txt += "<div class='row'>"

                data_dep.centres_disponibles.map((centre) => {
                    html_txt += showCentre(centre);
                });

                html_txt+= "</div>"

        } else {
            html_txt = "<h3 style='margin-top: 40px;'>❌ Aucun rendez-vous trouvé pour le département (" + dep + ")</h3>"
            html_txt += "<p>Nous n'avons trouvé aucun centre ayant des disponibilités sur Doctolib, Maiia et Keldoc. Dernier scan : " + dernier_scan + ".</p>" 
            html_txt += `  
                <div class='row'>
                <card class="shadow-btn col-xs-11 col-md-4" style="margin-bottom: 50px;">
                            <i>
                            La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
                    </card></div>
                    `
        }
        document.getElementById("rdv").innerHTML = html_txt

        if ("centres_indisponibles" in data_dep) {
            html_txt = "<h3 style='margin-top: 40px;'>❌ Autres centres de vaccination</h3><p>Aucun rendez-vous détecté dans ces centres, mais nous vous conseillons néanmoins de parcourir les liens, au cas où (des rendez-vous peuvent avoir été ajoutés depuis le deriner scan).</p>"
            html_txt += "<div class='row'>"

            data_dep.centres_indisponibles.map((centre) => {
                    html_txt += showCentre(centre);
                })
            
            document.getElementById("rdv").innerHTML += html_txt

        }
    }
}

function showCentre(centre) {
    let html = ` 
        <a target="_blank" title="${centre.plateforme}" href="${centre.url}">
            <card class="shadow-btn-${"prochain_rdv" in centre && centre.prochain_rdv !== null ? 'green' : 'red'} col-xs-11 col-md-4">`;

    if("prochain_rdv" in centre && centre.prochain_rdv !== null) {
        html += `
            Prochain : <b><span style='font-size: 120%'>${(new Date(centre.prochain_rdv)).toLocaleString('fr-FR', {day: '2-digit',month: '2-digit', hour: '2-digit', minute: '2-digit'})}</span><br></b>`;
    } else {
        html += `<b><span style='font-size: 120%'>${centre.url !== '' ? 'Aucun RDV détecté' : 'RDV en ligne non disponible'}</span><br></b>`;
    }
    html += `${centre.nom}<br>
            <img style="position: absolute; bottom: 5; right: 5;" src="${LOGO[centre.plateforme]}" width="70px"></img>
        </card></a>
    `;

    return html;
}

</script>
