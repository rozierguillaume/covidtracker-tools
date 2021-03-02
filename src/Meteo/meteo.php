<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js" integrity="sha512-MQlyPV+ol2lp4KodaU/Xmrn+txc1TP15pOBF/2Sfre7MRsA/pB4Vy58bEqe9u7a7DczMLtU5wT8n7OblJepKbg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" integrity="sha512-BBToHPBStgMiw0lD4AtkRIZmdndhB6aQbXpX7omcrXeG2PauGBl2lzq2xUZTxaLxYz5IDHlmneCZ1IJ+P3kYtQ==" crossorigin="anonymous" />

<p>Une étude réalisée par le MIT au mois de mars 2020 (Bukhari and Jameel, 2020) montre que 90% des infections se seraient produites dans des régions où la température se situe entre 3 et 17 degrés et où l'humidité absolue se situe entre 4 et 9 grammes par mètre cube (35 à 85 % d’humidité relative). La société Predict Services a créé un indicateur, appelé IPTCC (Index Predict de Transmissivité Climatique de la COVID-19), permettant de mesurer cela. Une valeur élevée d'IPTCC (proche de 100%) indiquierait un milieu favorable au virus, pouvant engendrer plus de contaminations.</p>

<h3>Échelle de couleurs IPTCC</h3>
Source : Predict Services
<table id="echelle">
    <tr style="border-bottom:0px;">
        <td class="green">0 - 20</td>
        <td>Conditions climatiques limitant la circulation aérienne du virus</td>
    </tr>
    <tr style="border-bottom:0px;">
        <td class="yellow">20 - 75</td>
        <td>Conditions climatiques devenant favorables à la circulation aérienne du virus</td>
    </tr>
    <tr style="border-bottom:0px;">
        <td class="orange">75 - 90</td>
        <td>Conditions climatiques favorables à la propagation aérienne du virus</td>
    </tr>
    <tr style="border-bottom:0px;">
        <td class="red">90 - 97</td>
        <td>Conditions climatiques très favorables la propagation aérienne du virus</td>
    </tr>
    <tr style="border-bottom:0px;">
        <td class="purple" style='color: white;'>97 - 100</td>
        <td>Conditions climatiques extrêmement favorables à la circulation aérienne du virus</td>
    </tr>
</table>
<br>

<h2>Carte</h2>
Cliquez sur une pastille pour afficher plus de détails.
<div id="mapid" style="height: 80vh; width: 90vw; max-width: 1000px; max-height: 600px;"></div>

<br>
<h2>Toutes les villes</h2>
Données météorologiques : Météo France. Mise à jour : <span id="dateMaj">--/--</span>.
<br>
<span id="content"></span>
<br><br>
<script>

var greenIcon = L.icon({
        iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/2/2d/Basic_green_dot.png',
        //shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
        html: "hey",
        iconSize:     [30, 30], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
    });

    var yellowIcon = L.icon({
        iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Location_dot_yellow.svg/1024px-Location_dot_yellow.svg.png',
        //shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize:     [30, 30], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
    });

    var orangeIcon = L.icon({
        iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Location_dot_orange.svg/1200px-Location_dot_orange.svg.png',
        //shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize:     [30, 30], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
    });

    var redIcon = L.icon({
        iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Basic_red_dot.png',
        //shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize:     [30, 30], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
    });

    var purpleIcon = L.icon({
        iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Location_dot_purple.svg/1200px-Location_dot_purple.svg.png',
        //shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize:     [30, 30], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
    });

    let dict_icons = {"orange": orangeIcon, "green": greenIcon, "red": redIcon, "purple": purpleIcon, "yellow": yellowIcon}


    var data = {};
    fetchData();
    function fetchData(){
        fetch('https://raw.githubusercontent.com/rozierguillaume/utils/master/meteo/data/output/iptcc.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                    this.data = json;
                    console.log(json)
                    initMap();
                    populateContent();
                    document.getElementById("dateMaj").innerHTML = data["Paris"]["forecast"][0].slice(0,10);
                })
            .catch(function () {
                this.dataError = true;
                console.log("error-x")
            }
            )
    }
    function process(){
        console.log(test)
        //console.log(data["Paris"])
    }

    var mymap;
    function initMap(){
    
        this.mymap = L.map('mapid').setView([46.505, 3], 6);
        
        var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

    }

    function populateContent(){
        content = `
        <div class="col-sm-5">
        <h3>{{ville}}</h3>
        <table id="Table{{ville}}">
        <tr>
        <td>Date</td>
        <td>Température</td>
        <td>Humidité relative</td>
        <td><b>IPTCC</b></td>
        </tr>
        </table>
        </div>`

        data.villes.map((ville, idx) => {
            document.getElementById("content").innerHTML += content.replace("{{ville}}", ville).replace("{{ville}}", ville);
            populateTable("Table"+ville, ville);
            populateMap(ville);
        })
        
    }

    function formateDate(date){
        return date.slice(8,10) + " / " + date.slice(5,7);
    }

    function populateMap(ville){
        var iptcc = data[ville]["iptcc"][0];
        var color_iptcc = getColorIptcc(iptcc);

        color = getColorIptcc(data[ville]["iptcc"][0])
        var marker = L.marker([data[ville]["coordonnees"][0], data[ville]["coordonnees"][1]], {icon: dict_icons[color], opacity: 0.9}).addTo(mymap);
        
        if (color_iptcc=="purple" || color_iptcc=="red"){
            marker.bindTooltip(data[ville]["iptcc"][0].toFixed(0).toString(), {permanent: true, direction: "center", className: "my-label-white", offset: [5, 5] });
        } else {
            marker.bindTooltip(data[ville]["iptcc"][0].toFixed(0).toString(), {permanent: true, direction: "center", className: "my-label", offset: [5, 5] });

        }
        //var marker = L.marker.text("hey")
        var string_popup= "<h3>" + ville + "</h3>"  + "<span style='font-size:150%;'>IPTCC : " + iptcc + " %</span><br>" + getDescriptionIptcc(iptcc) + "<br><br>Température moyenne : " + data[ville]["temperature"][0] + " °C<br>Humidité relative : " + data[ville]["humidite_relative"][0] + " %<br><small>Mise à jour : " + formateDate(data[ville]["forecast"][0]) + "</small><br>"
        string_popup += `<div class="chart-container" style="position: relative; height:20vh; width:100%">
                            <canvas id="barChart{{ville}}" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
                        </div>`.replace("{{ville}}", ville)
        marker.bindPopup(string_popup) //.addTo(this.mymap);
        marker.on('click', function(e) {
            this.openPopup();
            drawChart(ville);});
            
    }

    function drawChart(ville){
        let data_values = data[ville]["iptcc"].map((iptcc, idx) => ({x: data[ville]["forecast"][idx].slice(0,10), y: iptcc}))
        var ctx = document.getElementById('barChart'+ville).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data[ville]["forecast"],
                    datasets: [{
                        label: 'IPTCC',
                        data: data_values,
                        backgroundColor: data[ville]["iptcc"].map((value, idx) => [getColorIptcc(value)]),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks:{
                                source: 'auto'
                            },
                            type: 'time',
                            offset: true,
                            distribution: 'linear',
                            gridLines: {
                                display: false
                            }
                    }]
                    }
                }
            });
    }

    function populateTable(tableID, ville) {
        var refTable = document.getElementById(tableID);
        data[ville]["forecast"].map((heure, idx_heure) => {
            var nouvelleLigne = refTable.insertRow();

            if(idx_heure==0){
                nouvelleLigne.classList.add("lightgrey");
            }

            var nouvelleCellule = nouvelleLigne.insertCell();
            var date = data[ville]["forecast"][idx_heure];
            var nouveauTexte = document.createTextNode(formateDate(date))
            nouvelleCellule.appendChild(nouveauTexte);

            var nouvelleCellule = nouvelleLigne.insertCell() //
            var temperature = data[ville]["temperature"][idx_heure] + " °C";
            var nouveauTexte = document.createTextNode(temperature)
            nouvelleCellule.appendChild(nouveauTexte);

            var nouvelleCellule = nouvelleLigne.insertCell() //
            var humidite = data[ville]["humidite_relative"][idx_heure] + " %";
            var nouveauTexte = document.createTextNode(humidite)
            nouvelleCellule.appendChild(nouveauTexte);

            var nouvelleCellule = nouvelleLigne.insertCell() //
            var iptcc = data[ville]["iptcc"][idx_heure];
            //nouvelleCellule.classList.add(getColorIptcc(parseInt(iptcc)));

            var color_iptcc = "green"
            var blabla = `<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="{{color}}"/>
                            <text x="17" y="60"
                                font-family="Verdana"
                                font-size="30">
                                --
                            </text>
                        </svg>`.replace("{{color}}", getColorIptcc(parseInt(iptcc))).replace("--", iptcc.toFixed(1))

            var nouveauTexte = document.createTextNode(iptcc)
            nouvelleCellule.appendChild(nouveauTexte);
            nouvelleCellule.innerHTML = blabla
            
    })
    }

    function getColorIptcc(iptcc){
        if(iptcc<20){
            return "green"
        } else if (iptcc<75){
            return "yellow"
        } else if (iptcc < 90){
            return "orange"
        } else if (iptcc < 97){
            return "red"
        } else {
            return "purple"
        }
    }

    function getDescriptionIptcc(iptcc){
        if(iptcc<20){
            return "Conditions climatiques limitant la circulation aérienne du virus"
        } else if (iptcc<75){
            return "Conditions climatiques devenant favorables à la circulation aérienne du virus"
        } else if (iptcc < 90){
            return "Conditions climatiques favorables à la propagation aérienne du virus"
        } else if (iptcc < 97){
            return "Conditions climatiques très favorables la propagation aérienne du virus"
        } else {
            return "Conditions climatiques extrêmement favorables à la circulation aérienne du virus"
        }
    }

   



</script>

<style>
    
table, th, td {

  border-collapse: collapse;
}

tr {
    border-bottom: 1px solid #ccc;
}

th, td {
  padding: 10px;
}

.lightgrey {
        background-color: #e3eeff;
    }

.green {
        background-color: green;
    }
.yellow {
    background-color: yellow;
}
.orange {
    background-color: orange;
}
.red {
    background-color: red;
}
.purple {
    background-color: purple;
}
.my-label{
  background: transparent;
  color: black;
  font-size: 10px;
  border: 6px solid transparent;
  box-shadow: 0px 0px 0px;
}

.my-label-white{
  background: transparent;
  color: white;
  font-size: 10px;
  border: 6px solid transparent;
  box-shadow: 0px 0px 0px;
}


}
</style>
