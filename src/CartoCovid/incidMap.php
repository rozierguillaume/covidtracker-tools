<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js" integrity="sha512-MQlyPV+ol2lp4KodaU/Xmrn+txc1TP15pOBF/2Sfre7MRsA/pB4Vy58bEqe9u7a7DczMLtU5wT8n7OblJepKbg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" integrity="sha512-BBToHPBStgMiw0lD4AtkRIZmdndhB6aQbXpX7omcrXeG2PauGBl2lzq2xUZTxaLxYz5IDHlmneCZ1IJ+P3kYtQ==" crossorigin="anonymous" />
<p>CartoCovid est un outil de CovidTracker permettant de suivre l'activité de l'épidémie en France. <i>Cette page est en cours de construction et s'améliorera au fil du temps.</i></p>
<div class="alert alert-info clearFix" style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍩
                    Offrez-moi un donut</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<h2 style="margin-top : 80px;" id="centres-vaccination">Taux d'incidence par communauté de communes</h2>
<p>Cette carte présente le taux d'incidence (le nombre de cas de Covid19 détectés par semaine et pour 100 000 habitants de chaque zone).</p>
<div class="shadow" style="height: 90vh; width: 90vw; max-width: 1000px; max-height: 1000px;">
    <center>

    <div class="row">
        <button onclick="precedentClicked()"> < Précédent</button>
        <select id="selectDates" onchange="updatemap()">
        </select>
        <button onclick="suivantClicked()">Suivant ></button>

    </div>
    
    <img
        src="https://files.covidtracker.fr/covidtracker_vect.svg"
        alt="un triangle aux trois côtés égaux"
        height="40px"
        width="130px" 
        />
    </center>
    <div id="mapid" style="height: 80vh; width: 90vw; max-width: 980px; max-height: 980px;">
    </div>
</div>

<br>
Données : Santé publique France. Mise à jour quotidienne.<br>
Inspiré du travail de <a href="https://twitter.com/gforestier/status/1364264665308680195?s=21">Germain Forestier</a>.<br>
Auteur Guillaume Rozier.
<br>
<br>

<?php include(__DIR__ . '/menuBasPage.php'); ?>

<style>

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

</style>

<script>


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

    var data;
    var all_data;
    var longitudes = [];
    var latitudes = [];
    var noms = [];
    var reservation = [];
    var rdv_tel = [];
    var adresses = [];
    var modalites = [];
    var date_ouverture = [];
    var maj = [];

    var geojson_map;

    const div = document.querySelector('div');
    const url="https://www.data.gouv.fr/fr/datasets/r/5cb21a85-b0b0-4a65-a249-806a040ec372"

    let request = fetch(url)
    .then(response => response.arrayBuffer())
    .then(buffer => {
        let decoder = new TextDecoder();
        let csv = decoder.decode(buffer);
        data_array = CSVToArray(csv, ";");
          
        data_array.slice(1, data_array.length-1).map((value, idx) => {
          longitudes.push(value[10])
          latitudes.push(value[11])
          noms.push(value[1])
          reservation.push(value[34])
          date_ouverture.push(value[33])
          rdv_tel.push(value[35])
          modalites.push(value[35])
          adresses.push(value[5] + " " + value[6] + ", " + value[7] + " " + value[9])
          maj.push(value[22].slice(0, 16))
        })

          //ajouter_pins();
    })
    .catch(function () {
           this.dataError = true;
           console.log("error1")
       });
    
    var geojson;

    fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/epci2020_notnull_latlong_compr.json', {cache: 'no-cache'})
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        console.log(response)
        return response.json();
    })
    .then(json => {
            this.geojson = json;
            console.log(geojson)
            secondFetch();
        })
    .catch(function () {
        console.log("error-x-a")
    })

    function secondFetch(){
        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/sg-epci.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                console.log("alldata")
                this.all_data = json;
                console.log(all_data.dates.length)
                let N = all_data["dates"].length
                this.data = all_data[all_data["dates"][N-1]]
                console.log("populate")
                populateSelect()
                console.log("addtomap")
                addtomap()
                console.log("all done")
            })
        .catch(function () {
            console.log("error-x-b")
        })
    }
    
    function getIndexCurrentDate(){
        date_selected = document.getElementById("selectDates").value
        idx_return = 0
        
        all_data.dates.map((date, idx) => {
            if (date==date_selected){
                idx_return = idx    
            }
        })
        return idx_return
        
    }

    function changeSelectValue(position){
        document.getElementById("selectDates").value = all_data.dates[position]
    }

    function precedentClicked(){
        let position = getIndexCurrentDate()
        console.log(position)
        if(position>=1){
            changeSelectValue(position-1)
            data = all_data[all_data.dates[position-1]]
            updatemap()
        }
    }

    function suivantClicked(){
        let position = getIndexCurrentDate()
        N = all_data.dates.length
        if(position<=N-2){
            changeSelectValue(position+1)
            data = all_data[all_data.dates[position+1]]
            updatemap()
        }
    }

    function getColor(epci) {
        d = data[epci]
    return d == '[1000;Max]' ? '#800026' :
           d == '[500;1000[' ? '#800026' :
           d == '[250;500['  ? '#BD0026' :
           d == '[150;250['  ? '#E31A1C' :
           d == '[50;150['  ? '#FD8D3C' : //FC4E2A
           d == '[20;50['   ? '#e1f589' : //FD8D3C
           d == '[10;20['   ? '#abf589' : //FEB24C
           d == '[0;10['   ? '#59ff78' : //FED976
           d == "0" ? "blue" :
 
                            '#blue';
    }

    function getColorFromWindow(d) {

    return d == '[1000;Max]' ? '#800026' :
           d == '[500;1000[' ? '#800026' :
           d == '[250;500['  ? '#BD0026' :
           d == '[150;250['  ? '#E31A1C' :
           d == '[50;150['  ? '#FD8D3C' : //FC4E2A
           d == '[20;50['   ? '#e1f589' : //FD8D3C
           d == '[10;20['   ? '#abf589' : //FEB24C
           d == '[0;10['   ? '#59ff78' : //FED976
           d == "0" ? "blue" :
 
                            '#FFEDA0';
    }

    function getNomIncidence(inc){
    return inc == '[1000;Max]' ? 'plus de 1000' :
           inc == '[500;1000[' ? 'entre 500 et 1000' :
           inc == '[250;500['  ? 'entre 250 et 500' :
           inc == '[150;250['  ? 'entre 150 et 250' :
           inc == '[50;150['  ? 'entre 50 et 150' : //FC4E2A
           inc == '[20;50['   ? 'entre 20 et 50' : //FD8D3C
           inc == '[10;20['   ? 'entre 10 et 20' : //FEB24C
           inc == '[0;10['   ? 'moins de 10' : //FED976
                            'inconnu';
    }
    
 


    function style(feature) {
    return {
        fillColor: getColor(feature.properties.CODE_EPCI),
        weight: 1,
        opacity: 0.2,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
        info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
        geojson_map.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        mymap.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    var mymap = L.map('mapid').setView([46.505, 3], 6);
    //var markers = L.markerClusterGroup({ disableClusteringAtZoom: 9 });

    var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    var layerGroup = new L.LayerGroup();

    function updatemap(){
        let date = document.getElementById("selectDates").value;
        data = all_data[date]
        removelayer()
        addtomap()
    }

    function addtomap(){
        layerGroup.addTo(mymap);
        geojson_map = L.geoJson(geojson["features"], {
            style: style,
            onEachFeature: onEachFeature}).addTo(mymap);
        layerGroup.addLayer(geojson_map);
    }

    function removelayer(){
        layerGroup.removeLayer(geojson_map);
    }

    function populateSelect(){
        html_code = ""
        var maxdate = ""
        all_data.dates.map((date, idx) => {
            html_code += "<option value='" + date + "'>" + date + "</option>"
            maxdate = date
        })
        
        document.getElementById("selectDates").innerHTML = html_code

        document.getElementById("selectDates").value = maxdate;
        
    }

    //
    //
    //
    // POPUP
    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        date = document.getElementById("selectDates").value
        this._div.innerHTML = '' +  (props ?
            '<b>' + props.NOM_EPCI + '</b><br>' + "Taux d'incidence :<br><span style='font-size: 120%;'>" + getNomIncidence(data[props.CODE_EPCI]) + '</span><br>cas par semaine pour 100k hab <br><small>' + date + '</small>'
            : 'Survoler');
    };

    info.addTo(mymap);


    //
    //
    // Legend   
    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = ['[0;10[', '[10;20[' , '[20;50[', '[50;150[', '[150;250[', '[250;500[', '[500;1000[', '[1000;Max]'],
            labels = [];
        
        // loop through our density intervals and generate a label with a colored square for each interval
        console.log("lol")
        div.innerHTML += "<b>Taux d'incidence</b><br>"
        for (var i = 0; i < grades.length; i++) {
            
            div.innerHTML +=
                '<i style="background:' + getColorFromWindow(grades[i]) + '"></i> ' +
                grades[i] +'<br>';
        }
        div.innerHTML += "<br>CovidTracker.fr"
        return div;
    };

    legend.addTo(mymap);
    
</script>

<style>
    #mapid { height: 180px; }

    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255,255,255,0.8);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 5px;
    }
    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .legend {
    line-height: 18px;
    color: #555;
}
    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>