
<script>
// URLs des sources
var data_url = 'https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/vaximpact/output_age/{0}/data_by_week.json';
var stats_url = 'https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/vaximpact/output_age/{0}/stats_by_week.json';


// Quelques couleurs custom.
var LIGHT_BLUE = "#4fafd9"
var LIGHT_GREEN = "#3ab55f"

// Icons
var BODY_ICON = `<svg id="body" height="40" viewBox="0 0 74 74" width="31" xmlns="http://www.w3.org/1800/svg" fill="{0}">
    <path d="m45.74 19.75h-17.48a6 6 0 0 0 -6 6v19.57a2.15 2.15 0 0 0 4.29 0v-11.32a1.11 1.11 0 0 1 2.22 0v34.44a3.56 3.56 0 0 0 7.12 0v-17.66a1.11 1.11 0 0 1 2.22 0v17.66a3.56 3.56 0 0 0 7.12 0v-34.44a1.11 1.11 0 0 1 2.22 0v11.32a2.15 2.15 0 0 0 4.29 0v-19.58a6 6 0 0 0 -6-5.99z"/><circle cx="37" cy="8.87" r="6.87"/>
    {1}
    </svg>
`
var BED_ICON = `<svg version="1.1" id="bed" xmlns="http://www.w3.org/1800/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="35px" height="25px" viewBox="0 0 910 910" style="enable-background:new 0 0 910 910;" xml:space="preserve" fill="{0}">
    <g>
        <path d="M789.1,449.9H879V369c0-16.8-13.7-30.5-30.5-30.5H342.1c1.601,3.3,3.101,6.6,4.601,10c10.2,24.2,15.399,49.9,15.399,76.4
        c0,8.399-0.5,16.8-1.6,25H789.1z"/>
        <path d="M165.9,263.7c-3.4,0-6.7,0.1-10,0.3v185.8H267h58.1c1.301-8.2,1.9-16.5,1.9-25c0-31.8-9.2-61.399-25.1-86.3
        C273.4,293.5,223.1,263.7,165.9,263.7z"/>
        <path d="M30,731.5h60.9c16.6,0,30-13.4,30-30v-95.7h668.2v95.7c0,16.6,13.4,30,30,30H880c16.6,0,30-13.4,30-30V514.9
        c0-16.601-13.4-30-30-30h-90.9H118.9V270.1v-61.6c0-16.6-13.4-30-30-30H30c-16.6,0-30,13.4-30,30v111.7v38.5V491v38.5v172
        C0,718,13.4,731.5,30,731.5z"/>
        {1}
    </g>
    </svg>
`
var VIRUS_ICON = `<svg id="virus" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0px" y="0px" viewBox="0 0 48 48" style="enable-background:new 0 0 48 48;" xml:space="preserve" fill="{0}">
    <path class="st0" d="M46.5,19c-0.8,0-1.5,0.7-1.5,1.5c0,0,0,0,0,0V22h-4.1c-0.4-3.1-1.6-6.1-3.5-8.5l2.9-2.9l1.2,1
	c0.6,0.6,1.5,0.6,2.1,0c0.6-0.6,0.6-1.5,0-2.1c0,0,0,0,0,0l-5-5c-0.6-0.6-1.5-0.6-2.1,0c-0.6,0.6-0.6,1.5,0,2.1l0,0l1,1.2l-2.9,2.9
	c-2.5-1.9-5.4-3.2-8.5-3.5V3h1.5C28.3,3,29,2.3,29,1.5S28.3,0,27.5,0l0,0h-7C19.7,0,19,0.7,19,1.5S19.7,3,20.5,3H22v4.1
	c-3.1,0.4-6.1,1.6-8.5,3.5l-2.9-2.9l1-1.2c0.6-0.6,0.6-1.5,0-2.1s-1.5-0.6-2.1,0l0,0l-4.9,5C4,10,4,11,4.6,11.6
	c0.6,0.6,1.5,0.6,2.1,0l1.1-1l2.9,2.9c-1.9,2.5-3.2,5.4-3.5,8.5H3v-1.5C3,19.7,2.3,19,1.5,19S0,19.7,0,20.5v7C0,28.3,0.7,29,1.5,29
	S3,28.3,3,27.5l0,0V26h4.1c0.4,3.1,1.6,6.1,3.5,8.5l-2.9,2.9l-1.2-1c-0.6-0.6-1.5-0.6-2.1,0c-0.6,0.6-0.6,1.5,0,2.1l5,5
	c0.6,0.6,1.5,0.6,2.1,0c0.6-0.6,0.6-1.5,0-2.1l0,0l-1-1.2l2.9-2.9c2.5,1.9,5.4,3.2,8.5,3.5V45h-1.5c-0.8,0-1.5,0.7-1.5,1.5
	s0.7,1.5,1.5,1.5h7c0.8,0,1.5-0.7,1.5-1.5S28.3,45,27.5,45l0,0H26v-4.1c3.1-0.4,6.1-1.6,8.5-3.5l2.9,2.9l-1,1.2
	c-0.6,0.6-0.6,1.5,0,2.1s1.5,0.6,2.1,0l5-5c0.6-0.6,0.6-1.5,0-2.1c-0.6-0.6-1.5-0.6-2.1,0l-1.2,1l-2.9-2.9c1.9-2.5,3.2-5.4,3.5-8.5
	H45v1.5c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5l0,0v-7C48,19.7,47.3,19,46.5,19C46.5,19,46.5,19,46.5,19z M18.5,20
	c-1.9,0-3.5-1.6-3.5-3.5s1.6-3.5,3.5-3.5s3.5,1.6,3.5,3.5C22,18.4,20.4,20,18.5,20C18.5,20,18.5,20,18.5,20z M30,33
	c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2s2,0.9,2,2C32,32.1,31.1,33,30,33z"/>
    {1}
    </svg>
`

// Liste des régions.
var REGIONS = 
{       
    "FR": "France",
    "ARA": "Auvergne-Rhône-Alpes",
    "BFC": "Bourgogne-Franche-Comté",
    "BRE": "Bretagne",
    "COR": "Corse",
    "CVL": "Centre-Val de Loire",
    "GES": "Grand Est",
    "GUA": "Guadeloupe",
    "GUY": "Guyane",
    "HDF": "Hauts-de-France",
    "IDF": "Ile-de-France",
    "LRE": "La Réunion",
    "MAR": "La Martinique",
    "MAY": "Mayotte",
    "NAQ": "Nouvelle Aquitaine",
    "NOR": "Normandie",
    "OCC": "Occitanie",
    "PAC": "Provence-Alpes-Côte d'Azur",
    "PDL": "Pays de la Loire"
};
</script>