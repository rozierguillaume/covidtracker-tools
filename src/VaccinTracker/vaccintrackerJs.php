<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#choixCarteDepartement').click(function(){
            $('#blocCarteDepartement').removeClass('hidden');
            $('#blocCarteRegion').addClass('hidden');

            $('#choixCarteDepartement').addClass('active');
            $('#choixCarteRegion').removeClass('active');
        });

        $('#choixCarteRegion').click(function(){
            $('#blocCarteRegion').removeClass('hidden');
            $('#blocCarteDepartement').addClass('hidden');

            $('#choixCarteRegion').addClass('active');
            $('#choixCarteDepartement').removeClass('active');
        });
    });

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
    const OBJECTIF_FIN_AOUT = 52000000 // 1_000_000
    var data;
    var data_france;
    var nb_vaccines = [];

    var vaccines_2doses = {};

    let differentielVaccinesParJour;
    var dejaVaccinesNb;
    var dejaVaccines = 0;
    var restantaVaccinerImmunite;
    var restantaVaccinerAutres = 100
    var objectifQuotidien;
    var dateProjeteeObjectif;
    var dejaVaccines2Doses;
    var dejaVaccines2DosesNb;
    var livraisons;

    var somme_doses_rolling={};

    var dosesRecues = 560000;

    var data_stock;
    var dates_stock=[];
    var stock=[];
    var cumul_stock=0;
    var cumul_stock_array=[];

    var data_news = [];
    var titre_news = [];
    var contenu_news = [];
    var updated = false;
    const table = document.getElementById("tableauVaccin");

    // Stocks
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
                this.cumul_stock_array.push(cumul_stock);
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
        // Get data from health ministry csv
        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-fra.json', {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.data = json;
                this.data_france = json;
                //console.log(json)
                data["dates"].map((value, idx) =>{
                    nb_vaccines.push({
                        date: value,
                        heure: "",
                        total: 0,
                        n_dose1: data["n_cum_dose1"][idx],
                        source: "Ministère de la santé"
                    });
                })

                nb_vaccines = nb_vaccines.filter((v,i,a)=>a.findIndex(t=>(t.date == v.date))===i); // suppression doublons
                nb_vaccines = nb_vaccines.sortBy('date'); // tri par date
                dejaVaccinesNb = nb_vaccines[nb_vaccines.length-1].n_dose1
                dejaVaccines = dejaVaccinesNb*100/67000000;
                restantaVaccinerImmunite = 60 - dejaVaccines
                this.objectifQuotidien = calculerObjectif();
                fetch2ndDosesData();


            })
            .catch(function () {
                    this.dataError = true;
                    console.log("error4")
                }
            )

        }

    function fetch2ndDosesData(){
        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-fra-2doses.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.vaccines_2doses = json;
                this.dateProjeteeObjectif = calculerDateProjeteeObjectif();
                majValeurs();
                maj2Doses();
                fetchStock();

            })
            .catch(function () {
                    this.dataError = true;
                    console.log("errorX")
                }
            )
    }

    fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/somme-doses-rolling.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.somme_doses_rolling = json;
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("errorY")
                }
            )
    function fetchStock(){
        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/flux-tot-nat.json', {cache: 'no-cache'})
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.livraisons = json;
                majValeursStock();
                buildLineChart();
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("errorStock")
                }
            )

    }
    var lineChart;
    function calculerObjectif(){

        let one_day = (1000 * 60 * 60 * 24)
        let jours_restant = (Date.parse("2021-08-31") - Date.parse(nb_vaccines[nb_vaccines.length-1].date) )/ one_day
        let objectif = OBJECTIF_FIN_AOUT;
        let resteAVacciner = objectif - nb_vaccines[nb_vaccines.length-1].n_dose1
        //console.log(jours_restant)
        if ((resteAVacciner>=0) && (jours_restant>=0)){
            return Math.round(resteAVacciner*2/jours_restant)
        } else {
            return -1
        }
    }

    function maj2Doses(){
        //log(vaccines_2doses)

        let N = vaccines_2doses.n_dose2_cumsum.length
        //let vaccines_2doses_24h = vaccines_2doses.n_dose2_cumsum[N-1] - vaccines_2doses.n_dose2_cumsum[N-2]
        let vaccines_2doses_24h = data_france.n_complet[data_france.n_complet.length-1]

        dejaVaccines2DosesNb = vaccines_2doses.n_dose2_cumsum[N-1];
        dejaVaccines2Doses = dejaVaccines2DosesNb*100/67000000;

        document.getElementById("nb_vaccines_2_doses").innerHTML = numberWithSpaces(dejaVaccines2DosesNb);
        document.getElementById("nb_vaccines_24h_2_doses").innerHTML = numberWithSpaces(vaccines_2doses_24h);

        date=vaccines_2doses.jour[N-1]
        document.getElementById("date_maj_2").innerHTML = date.slice(8) + "/" + date.slice(5, 7);
        document.getElementById("proportionVaccines2doses").innerHTML = (Math.round(dejaVaccines2Doses*10000000)/10000000).toFixed(2);
        tableVaccin(table);
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
        const duréeLissageEnJours = 15
        const objectif = OBJECTIF_FIN_AOUT
        const vdose1 = ( nb_vaccines[nb_vaccines.length -1].n_dose1 - nb_vaccines[nb_vaccines.length -(1+duréeLissageEnJours)].n_dose1 ) / duréeLissageEnJours
        const cumsum = vaccines_2doses.n_dose2_cumsum
        const vdose2 = ( cumsum[cumsum.length -1] - cumsum[cumsum.length -(1+duréeLissageEnJours)] ) / duréeLissageEnJours
        const resteAVaccinerDose1 = objectif - nb_vaccines[nb_vaccines.length -1].n_dose1
        const joursDose1Complete = Math.ceil(resteAVaccinerDose1 / vdose1)
        const nDose2quandD1Complete = Math.floor(joursDose1Complete * vdose2)
        const resteAVaccinerDose2 = objectif - nDose2quandD1Complete
        const joursDose2Complete = Math.ceil(resteAVaccinerDose2 / (vdose2+vdose1))
        const date = new Date(nb_vaccines[nb_vaccines.length -1].date)
        date.setDate(date.getDate() + joursDose2Complete + joursDose1Complete)
        return  date
    }
    var boxchecked=true

    function boxCheckedLineChart(){
        this.lineChart.destroy()
        boxchecked = !boxchecked
        document.getElementById("afficherLivraisons").checked=boxchecked
        buildLineChart(boxchecked)
    }

    var boxcheckedProjections=true
    function boxCheckedProjectionsLineChart(){
        this.lineChart.destroy()
        boxcheckedProjections = !boxcheckedProjections
        document.getElementById("afficherProjections").checked=boxcheckedProjections
        buildLineChart(boxchecked, boxcheckedProjections)
    }

    function valeursProjection(liste, taille){
        lastval = liste[liste.length-1]

        croissance = (lastval - liste[liste.length-14])/14

        var projections = [];
        //console.log(croissance)
        for (i=1; i<=taille; i++){
            projections.push(Math.round(lastval + i*croissance))
        }
        //console.log(projections)
        return projections
    }

    function datesProjection(date_min, taille){
        var dates_projections = []

        for (i=1; i<=taille; i++){
            dates_projections.push(moment(date_min).add(i, 'd').format('YYYY-MM-DD'))
        }
        //console.log(dates_projections)
        return dates_projections
    }

    function buildLineChart(checked=true, projectionsChecked=true){
        projectionsChecked = boxcheckedProjections
        //document.getElementById("afficherLivraisonsDiv").innerHTML = `<input type="checkbox" id="afficherLivraisons" onchange="boxCheckedLineChart()" checked> Afficher les livraisons`
        var ctx = document.getElementById('lineVacChart').getContext('2d');
        let data_values = data_france.n_cum_dose1.map((val, idx) => ({x: data_france.dates[idx], y:parseInt(val)}));
        let data_values_2nd = data_france.n_cum_complet.map((val, idx) => ({x: data_france.dates[idx], y:parseInt(val)}));

        let data_object_stock = livraisons.nb_doses_tot_cumsum.map((value, idx)=> ({x: moment(livraisons.jour[idx]).add(-3, 'd').format("YYYY-MM-DD"), y: parseInt(value)}))

        let data_values_2doses = vaccines_2doses.n_dose2_cumsum.map((value, idx)=> ({x: vaccines_2doses.jour[idx], y: parseInt(value)}))
        let labels=nb_vaccines.map(val => val.date)

        debut_2nd_doses = labels.map((value, idx) => ({x: value, y:0}))
        let N_tot = labels.length;
        let N2 = data_values_2doses.length;

        var datasets = [
                    {
                        yAxisID:"injections",
                        label: 'Secondes doses injectées ',
                        data: data_values_2nd, //debut_2nd_doses.slice(0,N_tot-N2).concat(data_values_2doses),
                        borderWidth: 0.1,
                        backgroundColor: '#1796e6',
                        borderColor: '#127aba',
                        pointRadius: 0,
                        pointHitRadius: 1,
                    },
                    {
                        yAxisID:"injections",
                        label: 'Premières doses injectées ',
                        data: data_values,
                        borderWidth: 0.1,
                        backgroundColor: '#a1cbe6',
                        borderColor: '#3691c9',
                        pointRadius: 0,
                        cubicInterpolationMode: 'monotone',
                        pointHitRadius: 1,
                    }

                ]
        if(projectionsChecked==true){
            projections_dose2 = valeursProjection(data_france.n_cum_complet, 50)
            projections_dates = datesProjection(data_france.dates[data_france.dates.length-1], 50)

            datasets.push({
                            yAxisID:"injections_proj",
                            label: 'Projection deuxièmes doses ',
                            data: projections_dose2.map((value, idx) => ({x:projections_dates[idx], y: value})),
                            borderWidth: 2,
                            //backgroundColor: '#a1cbe6',
                            fill:false,
                            borderColor: '#127aba',
                            pointRadius: 0,
                            cubicInterpolationMode: 'linear',
                            pointHitRadius: 1,
                            borderDash: [3,2]
                        })



            projections_dose1 = valeursProjection(data_france.n_cum_dose1, 50)
            projections_dates = datesProjection(data_france.dates[data_france.dates.length-1], 50)

            datasets.push({
                            yAxisID:"injections_proj",
                            label: 'Projection premières doses ',
                            data: projections_dose1.map((value, idx) => ({x:projections_dates[idx], y: value})),
                            borderWidth: 2,
                            //backgroundColor: '#a1cbe6',
                            fill:false,
                            borderColor: '#3691c9',
                            pointRadius: 0,
                            cubicInterpolationMode: 'linear',
                            pointHitRadius: 1,
                            borderDash: [3,2]
                        })
        }


        if (document.getElementById("afficherLivraisons").checked==true){
            datasets.push({
                            yAxisID:"stock",
                            label: 'Doses réceptionnées ou officiellement attendues ',
                            data: data_object_stock,
                            borderWidth: 3,
                            borderColor: 'grey',
                            pointRadius: 0,
                            steppedLine: true,
                            pointHitRadius: 3,
                        })
            var max_value = livraisons.nb_doses_tot_cumsum[livraisons.nb_doses_tot_cumsum.length-1]

        } else if(document.getElementById("afficherProjections").checked==false){
            var max_value = vaccines_2doses.n_dose2_cumsum[vaccines_2doses.n_dose2_cumsum.length-1] + nb_vaccines[nb_vaccines.length-1].n_dose1
        } else {
            var max_value = projections_dose1[projections_dose1.length-1] + projections_dose2[projections_dose2.length-1]
        }

        this.lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                aspectRatio: 0.6,
                tooltips: {
                    mode: 'x',
                    intersect: false
                },
                hover: {
                    intersect: false,
                    mode: 'x'
                },

                maintainAspectRatio: false,
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                scales: {
                    yAxes: [{
                        id:"injections",
                        stacked: true,
                        gridLines: {
                            display: false
                        },
                        ticks : {
                            max: max_value,
                            min: 0,
                            callback: function (value) {
                                        return value/1000000 +" M";
                                    }
                        }
                    },
                    {
                        id:"injections_proj",
                        display: false,
                        stacked: true,
                        gridLines: {
                            display: false
                        },
                        ticks : {
                            max: max_value,
                            min: 0,
                        }
                    },{
                        id:"stock",
                        display: false,
                        stacked: false,
                        gridLines: {
                            display: false
                        },
                        ticks : {
                            max: max_value,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        //stacked: true,
                        ticks:{
                            source: 'auto'
                        },
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

    function rollingMean(data){
        var moveMean = [];
        let N = data.length;

        for (var i = 3; i < N-3; i++)
        {
            var mean = (parseInt(data[i-3]) + data[i-2] + data[i-1] + data[i] + data[i+1] + data[i+2] + data[i+3])/7;
            moveMean.push(mean);
        }
        return moveMean;
    }

    function buildBarChart(data){
        document.getElementById("afficherLivraisonsDiv").innerHTML = ``
        var ctx = document.getElementById('lineVacChart').getContext('2d');
        let labels = nb_vaccines.map(val => val.date)
        let data_values = data.map((value, idx) => ({x: labels[idx], y: parseInt(value)}))

        //let rollingMeanValues = rollingMean(data).map((value, idx)=> ({x: labels[idx+3], y: Math.round(value)}))
        let rollingMeanValues = somme_doses_rolling.n_dose_rolling.map((value, idx) => ({x:somme_doses_rolling.jour[idx], y:value}))
        let data_values_2doses = vaccines_2doses.n_dose2.map((value, idx)=> ({x: vaccines_2doses.jour[idx], y: parseInt(value)}))

        debut_2nd_doses = labels.map((value, idx) => ({x: value, y:0}))

        let data_values_2nd = data_france.n_complet.map((value, idx) => ({x: data_france.dates[idx], y: value}))

        let N_tot = labels.length;
        let N2 = data_values_2doses.length;

        this.lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Moyenne quotidienne (total doses injectées) ',
                        data: rollingMeanValues,
                        type: 'line',
                        borderColor: 'black',
                        pointBackgroundColor: 'rgba(0, 0, 0, 1',
                        backgroundColor: 'rgba(0, 168, 235, 0)',
                        pointRadius: 1,
                        pointHitRadius: 3
                    },
                    {
                        label: 'Nombre de premières doses ',
                        data: data_values,
                        backgroundColor: 'rgba(0, 168, 235, 0.5)',
                    },
                    {
                        label: 'Nombre de deuxièmes doses ',
                        data: data_values_2nd, //debut_2nd_doses.slice(0,N_tot-N2).concat(data_values_2doses),
                        backgroundColor: '#1796e6',
                    },

                ]
            },
            options: {
                aspectRatio: 1.5,
                //maintainAspectRatio: false,
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        id: 'injections',
                        stacked: true,
                        position: 'left',
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            callback: function (value) {
                                        return value/1000 +" k";
                                    }
                        }
                    }],
                    xAxes: [{
                        //offset: true,
                        stacked: true,
                        type: 'time',
                        distribution: 'linear',
                        gridLines: {
                            display: false
                        },
                        time: {
                            min: moment("2021-01-01"),
                            max: moment()
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
        //document.getElementById("objectif").checked=false;

        if (type_donnees=="quotidien"){
            document.getElementById("afficherLivraisonsDiv").innerHTML = ``
            document.getElementById("afficherProjectionsDiv").innerHTML = ``

            nb_vaccines_quot = [nb_vaccines[0].total]
            for(i=0; i<nb_vaccines.length-1; i++){
                nb_vaccines_quot.push(nb_vaccines[i+1].n_dose1-nb_vaccines[i].n_dose1)
            }
            buildBarChart(nb_vaccines_quot);
        } else {
            document.getElementById("afficherLivraisonsDiv").innerHTML = `<div id="afficherLivraisonsDiv"><input type="checkbox" id="afficherLivraisons" onchange="boxCheckedLineChart()" checked> Afficher les livraisons</div>`
            document.getElementById("afficherProjectionsDiv").innerHTML = `<div id="afficherProjectionsDiv"><input type="checkbox" id="afficherProjections" onchange="boxCheckedProjectionsLineChart()" checked> Afficher les projections de vaccinations (1)</div>`
            buildLineChart();
        }
    }
    function ajouterObjectifAnnotation(){
        type_donnees = document.getElementById("type").value
        if (type_donnees=="quotidien"){
            obj = objectifQuotidien;
        }
        else {
            obj = OBJECTIF_FIN_AOUT;
        }
        //console.log(this.lineChart.options.annotation)

        if (this.lineChart.options.annotation.annotations.length==0){

            this.lineChart.options.annotation.annotations.push(
                {
                    drawTime: "afterDatasetsDraw",
                    id: "hline",
                    type: "line",
                    mode: "horizontal",
                    scaleID: "injections",
                    value: obj,
                    borderColor: "green",
                    borderWidth: 3,
                    label: {
                        backgroundColor: "green",
                        content: "Objectif",
                        enabled: true
                    },
                    onClick: function(e) {
                        //console.log("Annotation", e.type, this);
                    }
                });
        } else {
            this.lineChart.options.annotation.annotations = [];
        }
        //console.log("hey")
        this.lineChart.update()
    }

    function tableVaccin(tableElt){
        tableElt.innerHTML = "";
        let first = true;
        for(let i=0; i<10; i++){
            let row = tableElt.insertRow();

            for(let j=0; j<10; j++){
                let newrow = row.insertCell(j)

                let subtable = document.createElement("table");
                subtable.classList = "subtableVaccin";
                newrow.appendChild(subtable);

                for (let k=0; k<10; k++) {
                    let subrow = subtable.insertRow();
                    for(let l=0 ; l < 10 ; l++) {
                        let caseNb = i*10+j+0.1*k+0.01*l+0.01
                        let newsubrow = subrow.insertCell(l);
                        if(caseNb <= dejaVaccines2Doses){
                            newsubrow.classList.add('darkgreen');
                        } else if(caseNb <= dejaVaccines2Doses+0.01) {
                            newsubrow.classList.add('animation-seconde-dose');
                        } else if(caseNb <= dejaVaccines){
                            newsubrow.classList.add('green');
                        } else if(caseNb <= dejaVaccines+0.01) {
                            newsubrow.classList.add('animation-premiere-dose');
                        } else if(caseNb <= 60) {
                            newsubrow.classList.add("red");
                        } else {
                            newsubrow.classList.add("grey");
                        }
                    }
                }
            }
        }
    }

    function obtenirCumulStockActuel(){

        var idx_max = 0;
        let today = moment();

        livraisons.jour.map((value, idx)=>{

            if(moment(value).add(-3, 'd') <= today){
                idx_max = idx
            }
        })

        return {"jour": moment(livraisons.jour[idx_max]).add(-3, 'd').format('YYYY-MM-DD'), "valeur": livraisons.nb_doses_tot_cumsum[idx_max]};
    }

    function majValeursStock(){
        results = obtenirCumulStockActuel();
        document.getElementById("nb_doses").innerHTML = numberWithSpaces(results["valeur"]);
        document.getElementById("date_maj_4").innerHTML = formateDate(results["jour"]);

    }

    function formateDate(date){
        return date.slice(8) + "/" + date.slice(5, 7)
    }

    function majValeurs(){
        //let N = vaccines_2doses.n_dose2_cumsum.length
        //let deuxiemeDoses = vaccines_2doses.n_dose2_cumsum[N-1];

        if (nb_vaccines[nb_vaccines.length-1].source == "Estimation"){
            document.getElementById("estimation_str").innerHTML = "⚠️ Données non consolidées";
        }

        document.getElementById("nb_doses_injectees").innerHTML = numberWithSpaces(dejaVaccinesNb);
        document.getElementById("nb_doses_injectees_24h").innerHTML = numberWithSpaces(dejaVaccinesNb - nb_vaccines[nb_vaccines.length-2].n_dose1);

        document.getElementById("proportionVaccinesMax").innerHTML = (Math.round(dejaVaccines*10000000)/10000000).toFixed(2);
        //console.log(dejaVaccines2Doses);
        //document.getElementById("proportionVaccinesMin").innerHTML = (Math.round(dejaVaccines/2*10000000)/10000000).toFixed(2);
        //document.getElementById("proportion_doses").innerHTML = (dejaVaccinesNb/cumul_stock*100).toFixed(1);

        document.getElementById("proportionAVaccinerImmu").innerHTML = (Math.round(restantaVaccinerImmunite*10000000)/10000000).toFixed(2);
        document.getElementById("objectif_quotidien").innerHTML = numberWithSpaces(objectifQuotidien);
        document.getElementById("date_projetee_objectif").innerHTML = formaterDate(dateProjeteeObjectif);
        date = nb_vaccines[nb_vaccines.length-1].date
        date = date.slice(8) + "/" + date.slice(5, 7)
        //heure = nb_vaccines[nb_vaccines.length-1].heure

        date_stock = dates_stock[dates_stock.length-1]
        date_stock = formateDate(date_stock);

        document.getElementById("date_maj_1").innerHTML = date;
        //document.getElementById("date_maj_2").innerHTML = date + " à " + heure;
        document.getElementById("date_maj_3").innerHTML = date;


    }

    Array.prototype.sortBy = function(p) {
        return this.slice(0).sort(function(a,b) {
            return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
        });
    }

</script>
