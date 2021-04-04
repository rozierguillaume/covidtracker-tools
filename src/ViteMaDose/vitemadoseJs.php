
<script>
(function () {
// DETECTION IFRAME
if (window!=window.top) {
    document.getElementsByTagName('html')[0].innerHTML = '';
    throw new Error ('iframe');
}
const LOGO = {
    Keldoc: "https://www.keldoc.com/keldoc-logo.nolqip.e7abaad88d1642c9c1f2.png",
    Maiia: "https://www.rmingenierie.net/wp-content/uploads/2019/12/logo-Maiia-vert.png",
    Doctolib: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Logo_Doctolib.svg/1024px-Logo_Doctolib.svg.png",
    Autre: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAH0CAYAAADhUFPUAAAFxklEQVR42uzBAQEAAACAkP6v7ggCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIDZgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYgwMBAAAAACD/10ZQVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVXYsWMbgKAAiqI/orCDaNnFGBKdWmFUMxjCYwU/0ZyT3OaN8ACAnzSpLQAAVNGnNe1pKgAAfH6u5nSmKy3vBgDAJ0Pa0pHGAgBAFd2T9woAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOBmDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVhDw4EAAAAAID8XxtBVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVpDw4JAAAAAAT9f+0LEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwCyuYE1Qq4nl4AAAAASUVORK5CYII=" // image vide
};
main()

async function main() {
  const departements = await fetchDepartements()
  const departementsParNumero = departements.reduce((all, dep) => ({[dep.code_departement]: dep, ...all}), {})
  console.log(departementsParNumero)
  const doseFormEl = document.querySelector("form.doses")
  const departementSelectEl = doseFormEl.querySelector('select')
  for (const departement of departements) {
    const optionEl = document.createElement('OPTION')
    optionEl.value = departement.code_departement
    optionEl.innerText = `${departement.code_departement} - ${departement.nom_departement}`
    departementSelectEl.appendChild(optionEl)
  }
  const renduEl = doseFormEl.querySelector('#rdv')

  departementSelectEl.addEventListener('change', (e) => {
    const départementSélectionné = departementsParNumero[departementSelectEl.value]
    if (départementSélectionné) {
      afficherLesSlotsPourDepartement(renduEl, départementSélectionné)
    }
  })

}

async function afficherLesSlotsPourDepartement(renduEl, départementSélectionné) {
  renduEl.className = "loading"
  renduEl.innerHTML = "<p>Chargement des données…<p>"
  const slots = await fetchSlotsForDepartement(départementSélectionné.code_departement)
  console.log(slots)
  const titre = `<h2>Résultats pour : ${départementSélectionné.nom_departement} (${départementSélectionné.code_departement})</h2>`
  dernierScan = (new Date(slots.last_updated)).toLocaleString('fr-FR', {day: '2-digit',month: '2-digit', hour: '2-digit', minute: '2-digit'});

  const slotsDisponibles = renderSlotsDisponibles({
    centres: slots.centres_disponibles,
    départementSélectionné,
    dernierScan,
  })
  const slotsIndisponibles = renderSlotsIndisponibles({
    centres: slots.centres_indisponibles,
  })

  renduEl.className = 'loaded'
  renduEl.innerHTML = `
    ${titre}
    ${slotsDisponibles}
    ${slotsIndisponibles}
  `
}

function renderSlotsDisponibles ({ dernierScan, centres, départementSélectionné }) {
  const nbCentres = centres.length
  if (nbCentres === 0) {
    return pasDeCentresDisponibles({ dernierScan, départementSélectionné })
  }
  const titre = `
    <h3>✅ Rendez-vous trouvés</h3>
    <p>Nous avons trouvé ${nbCentres} centre(s) ayant des disponibilités sur Doctolib, Maiia ou Keldoc. Dernier scan : ${dernierScan}.</p>
  `
  return `
    ${titre}
    <div class="row">
      ${centres.map(renderCentreDisponible).join('')}
    </div>
  `
}

function pasDeCentresDisponibles ({ dernierScan, départementSélectionné  }) {
  return `
    <h3>❌ Aucun rendez-vous trouvé pour le département ${départementSélectionné.nom_departement} (${départementSélectionné.code_departement})</h3>
    <p>Nous n'avons trouvé aucun centre ayant des disponibilités sur Doctolib, Maiia et Keldoc. Dernier scan : ${dernierScan}.</p>
    <div class="row">
      <card class="shadow-btn col-xs-11 col-md-4" style="margin-bottom: 50px">
        <i>La recherche de Vite Ma Dose ! n'est pas exhaustive. Essayez de chercher manuellement via les plateformes de réservation (Doctolib, Maiia, Keldoc) ou en appelant les centres.</i>
      </card>
    </div>
  `
}

function renderCentreDisponible (centre) {
  const date = new Date(centre.prochain_rdv).toLocaleString('fr-FR', {day: '2-digit', month: 'long', hour: '2-digit', minute: '2-digit'})
  const logoSrc = LOGO[centre.plateforme]
  return `
    <a href="${centre.url}" target="_blank" title="${centre.nom} sur ${centre.plateforme}" rel="noreferrer noopener">
      <card class="shadow-btn-green col-xs-11 col-md-4">
        Prochain : <b>
          <span style='font-size: 120%'>
            ${date}
          </span>
          <br>
        </b>
        ${centre.nom}
        <br>
        <img style="position: absolute; bottom: 5; right: 5;" src="${logoSrc}" width="70px"></img>
      </card>
    </a>
  `
}

function renderSlotsIndisponibles ({ dernierScan, centres }) {
  const nbCentres = centres.length
  const titre = `
    <h3>❌ Autres centres de vaccination</h3>
    <p>Aucun rendez-vous détecté dans ces centres, mais nous vous conseillons néanmoins de parcourir les liens, au cas où (des rendez-vous peuvent avoir été ajoutés depuis le deriner scan).</p>
  `
  return `
    ${titre}
    <div class="row">
      ${centres.map(renderCentreIndisponible).join('')}
    </div>
  `
}

function renderCentreIndisponible (centre) {
  const logoSrc = LOGO[centre.plateforme]
  return `
    <a href="${centre.url}" target="_blank" title="${centre.nom} sur ${centre.plateforme}" rel="noreferrer noopener">
      <card class="shadow-btn-red col-xs-11 col-md-4">
        <b><span style='font-size: 120%'>${centre.url !== '' ? 'Aucun RDV détecté' : 'RDV en ligne non disponible'}</span><br></b>
        ${centre.nom}
        <br>
        <img style="position: absolute; bottom: 5; right: 5;" src="${logoSrc}" width="70px"></img>
      </card>
    </a>
  `
}


async function fetchDepartements () {
  const url = 'https://raw.githubusercontent.com/CovidTrackerFr/vitemadose/main/data/output/departements.json'
  const response = await fetch(url)
  if (!response.ok) {
    throw new Error("HTTP error " + response.status);
  }
  return await response.json()
}

async function fetchSlotsForDepartement(numeroDepartement) {
  const url = `https://raw.githubusercontent.com/CovidTrackerFr/vitemadose/data-auto/data/output/${numeroDepartement}.json`
  const response = await fetch(url, {cache: 'no-cache'})
  if (!response.ok) {
    throw new Error("HTTP error " + response.status);
  }
  return await response.json()
}

})()
</script>
