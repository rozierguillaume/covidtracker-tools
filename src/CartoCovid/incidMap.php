<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://unpkg.com/geobuf@3.0.2/dist/geobuf.js"></script>
<script src="https://unpkg.com/pbf@3.0.5/dist/pbf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js" integrity="sha512-MQlyPV+ol2lp4KodaU/Xmrn+txc1TP15pOBF/2Sfre7MRsA/pB4Vy58bEqe9u7a7DczMLtU5wT8n7OblJepKbg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" integrity="sha512-BBToHPBStgMiw0lD4AtkRIZmdndhB6aQbXpX7omcrXeG2PauGBl2lzq2xUZTxaLxYz5IDHlmneCZ1IJ+P3kYtQ==" crossorigin="anonymous" />
<p>CoviCarte est un outil de CovidTracker permettant de suivre l'activité de l'épidémie en France. Les données proviennent de Santé publique France, et sont mises à jour tous les soirs. La carte est interactive. <i>Cette page est en cours de construction et s'améliorera au fil du temps.</i></p>
<div class="alert alert-info clearFix" style="font-size: 18px; display: none;">
    <div class="row">
        <div class="col-md-8">
            Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/don" target="_blank" rel="noreferrer noopener">🍩
                    Offrez-moi un donut</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<h2 style="margin-top : 80px;" id="centres-vaccination">Taux d'incidence par communauté de communes</h2>
<p>Cette carte présente le taux d'incidence (le nombre de cas de Covid19 détectés par semaine et pour 100 000 habitants de chaque zone). Chaque communauté de commune est définie par un code EPCI.</p>
<div class="shadow" style="height: 90vh; width: 98vw; max-width: 1200px; max-height: 1200px;">
    <center>

    <div class="row">
        <button class="button-nav" onclick="precedentClicked()">&#10094; Précédent</button>
        <select id="selectDates" class="form-select" onchange="selectchanged()">
        </select>
        <button class="button-nav" onclick="suivantClicked()">Suivant &#10095;</button>
    <br>
    <div id="slider-dates" style="margin-bottom: 10px; margin-top: 10px; max-width: 80%;"></div>
    </div>
    
    </center>
    <div id="mapid" style="height: 80vh; width: 94vw; max-width: 1180px; max-height: 1180px;">
    </div>
    <br><br>
    
</div>

<div style="margin-top: 20px;">
    <b>Opacité :</b> <span id="slider-opacite-value"></span>
    <div id="slider-opacite" style="max-width: 200px;"></div>
</div>

<br>
Données : Santé publique France. Mise à jour quotidienne.<br>
Inspiré du travail de <a href="https://twitter.com/gforestier/status/1364264665308680195?s=21">Germain Forestier</a>.<br>
Auteur Guillaume Rozier.
<br>
<br>

<?php include(__DIR__ . '/menuBasPage.php'); ?>

<style>
p{
    font-size: 120%;
}

div[shadow] {
         border: 0px solid black;
         padding: 10px 20px;
         border-radius: 7px;
         text-align: center;
         box-shadow: 6px 4px 25px #d6d6d6;
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

    div[class_perso] {
            display: flex;
            min-height: 12vh;
            flex-wrap: wrap;


            /* needed to stack children once to big */
        }

    div[class_perso] div {
        flex: 1;
        min-width: 200px;
        min-height: 7vh;
        /* 2 children + margin and borders makes a break point at around 620px */
        /*background: lightblue;*/

    }

    @media screen and (max-width: 621px) {
        div[class_persos] {
            min-height: 30vh;
            /* has a meaning with a grid system */
        }

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
    
    var epci_url = 'epci2020_notnull_latlong_compr.pbf';
    fetch(epci_url, {cache: 'no-cache'})
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }

        return response.arrayBuffer();
    })
    .then(arraybuffer => {
            this.geojson = geobuf.decode(new Pbf(arraybuffer));
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
                buildSlider();
                console.log("addtomap")
                addtomap()
                buildSliderDates();
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
        if(position>=1){
            changeSelectValue(position-1)
            data = all_data[all_data.dates[position-1]]
            updatemap()
        }
        updateslider();
    }

    function suivantClicked(){
        let position = getIndexCurrentDate()
        N = all_data.dates.length
        if(position<=N-2){
            changeSelectValue(position+1)
            data = all_data[all_data.dates[position+1]]
            updatemap()
        }
        updateslider();
    }

    function getColor(epci) {
        d = data[epci]
    return d == '[1000;Max]' ? 'black' :
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

    return d == '[1000;Max]' ? 'black' :
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

    function getValeurMoyenneIncidence(inc){
    return inc == '[1000;Max]' ? 1000 :
           inc == '[500;1000[' ? 750 :
           inc == '[250;500['  ? 375 :
           inc == '[150;250['  ? 200 :
           inc == '[50;150['  ? 100 : //FC4E2A
           inc == '[20;50['   ? 35 : //FD8D3C
           inc == '[10;20['   ? 15 : //FEB24C
           inc == '[0;10['   ? 5 : //FED976
                            0 ;
    }
    
 


    function style(feature) {
        let opacity_slider=document.getElementById('slider-opacite').noUiSlider.get();
    return {
        fillColor: getColor(feature.properties.CODE_EPCI),
        weight: 0,
        opacity: 0.2,
        color: 'white',
        dashArray: '3',
        fillOpacity: opacity_slider,
        
    };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 7,
            color: 'white',
            dashArray: '',
            fillOpacity: 0.8
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
        //updateslider()
    }

    function updateslider(){
        let position = getIndexCurrentDate()
        document.getElementById('slider-dates').noUiSlider.set(position)

    }

    function selectchanged(){
        updateslider();
        updatemap();
    }

    function addtomap(){
        layerGroup.addTo(mymap);
        geojson_map = L.geoJson(geojson["features"], {
            style: style,
            smoothFactor:0,
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
        if(props){
            this._div.innerHTML += `<div class="chart-container" style="position: relative; height:200px; width:300px;">
                <canvas id="barChart" style="margin-top:20px;"></canvas>
            </div>`

            buildBarChart(props)
        }
    };

    info.addTo(mymap);


    //
    //
    // Legend   
    var legend = L.control({position: 'bottomleft'});

    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = ['[0;10[', '[10;20[' , '[20;50[', '[50;150[', '[150;250[', '[250;500[', '[500;1000[', '[1000;Max]'],
            labels = [];
        
        // loop through our density intervals and generate a label with a colored square for each interval
        div.innerHTML += "<b>Taux d'incidence</b><br>"
        for (var i = 0; i < grades.length; i++) {
            
            div.innerHTML +=
                '<i style="background:' + getColorFromWindow(grades[i]) + '"></i> ' +
                grades[i] +'<br>';
        }
        div.innerHTML += `<br><img
        src="https://files.covidtracker.fr/covidtracker_vect.svg"
        alt="un triangle aux trois côtés égaux"
        height="40px"
        width="150px" 
        style="margin-top:5px"
        />`
 
        return div;
    };

    legend.addTo(mymap);


    var barChart;
    
    function buildBarChart(props){
        var ctx = document.getElementById('barChart').getContext('2d');
        var data_temp=[];
        var colours=[];
        
        all_data.dates.map((date, idx) => {
            data_temp.push(getValeurMoyenneIncidence(all_data[date][props.CODE_EPCI]))
            colours.push(getColorFromWindow(all_data[date][props.CODE_EPCI]))
        })

        this.barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: all_data.dates,
                datasets: [
                    {   
                        label: ' ',
                        data: data_temp,
                        backgroundColor: colours,
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
                        position: 'left',
                        gridLines: {
                            display: true
                        },
                        ticks:{
                            min:0,
                            max:1000
                        }
                    }],
                    xAxes: [{
                        offset: true,
                        stacked: true,
                        type: 'time',
                        distribution: 'linear',
                        gridLines: {
                            display: false
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


    // SLIDER
    

    function buildSlider(){
        var rangeSlider = document.getElementById('slider-opacite');
        noUiSlider.create(rangeSlider, {
            start: [0.8],
            step: 0.1,
            range: {
                'min': [0],
                'max': [1]
            }
        });

        var rangeSliderValueElement = document.getElementById('slider-opacite-value');

        rangeSlider.noUiSlider.on('update', function (values, handle) {
            rangeSliderValueElement.innerHTML = values[handle];
            //updatemap();
        });

    }

    function sliderHasUpdated(){
        let idx = parseInt(document.getElementById('slider-dates').noUiSlider.get())
        changeSelectValue(idx)
        data = all_data[all_data.dates[idx]]
        updatemap()
    }

    function buildSliderDates(){
        var rangeSlider = document.getElementById('slider-dates');
        noUiSlider.create(rangeSlider, {
            start: [all_data.dates.length-1],
            step: 1,
            range: {
                'min': [0],
                'max': [all_data.dates.length-1]
            }
        });

        rangeSlider.noUiSlider.on('update', function (values, handle) {
            sliderHasUpdated();
            //updatemap();
        });
        document.getElementById('slider-opacite').noUiSlider.on("update", function () {updatemap();});
    }
    
</script>

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

    .button-nav {
        border: 1px solid;
        margin: 0px 20px 0px 20px;
        padding: 2px 5px 2px 5px;
        font-size : 14px;
        transition-duration: 0.4s;
        background-color: #ffffff;
        border-radius: 10px;

    }

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
