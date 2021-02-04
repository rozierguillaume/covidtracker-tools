
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
    var nb_vaccines = [];

    var vaccines_2doses = {};

    let differentielVaccinesParJour;
    var dejaVaccinesNb;
    var dejaVaccines = 0;
    var restantaVaccinerImmunite;
    var restantaVaccinerAutres = 100
    var objectifQuotidien;
    var dateProjeteeObjectif;

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
                //console.log(json)
                data["dates"].map((value, idx) =>{
                    nb_vaccines.push({
                        date: value,
                        heure: "",
                        total: 0,
                        n_dose1: data["n_dose1_cumsum"][idx],
                        source: "Ministère de la santé"
                    });
                })

                nb_vaccines = nb_vaccines.filter((v,i,a)=>a.findIndex(t=>(t.date == v.date))===i); // suppression doublons
                nb_vaccines = nb_vaccines.sortBy('date'); // tri par date
                dejaVaccinesNb = nb_vaccines[nb_vaccines.length-1].n_dose1
                dejaVaccines = dejaVaccinesNb*100/67000000;
                restantaVaccinerImmunite = 60 - dejaVaccines
                this.dateProjeteeObjectif = calculerDateProjeteeObjectif();
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
                majValeurs();
                maj2Doses();
                buildLineChart();
            })
            .catch(function () {
                    this.dataError = true;
                    console.log("errorX")
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
        let N = vaccines_2doses.n_dose2.length
        let vaccines_2doses_24h = vaccines_2doses.n_dose2[N-1] - vaccines_2doses.n_dose2[N-2]

        document.getElementById("nb_vaccines_2_doses").innerHTML = numberWithSpaces(vaccines_2doses.n_dose2[N-1]);
        document.getElementById("nb_vaccines_24h_2_doses").innerHTML = numberWithSpaces(vaccines_2doses_24h);
        
        date=vaccines_2doses.jour[N-1]
        document.getElementById("date_maj_2").innerHTML = date.slice(8) + "/" + date.slice(5, 7);
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
        const objectif = OBJECTIF_FIN_AOUT
        const indexDerniereMaj = nb_vaccines.length - 1;
        const indexDebutFenetre = Math.max(0, indexDerniereMaj - 7)
        const derniereMaj = Date.parse(nb_vaccines[indexDerniereMaj].date)
        const resteAVacciner = objectif*2 - Number(nb_vaccines[indexDerniereMaj].n_dose1)
        const differentielVaccinesFenetre = Number(nb_vaccines[indexDerniereMaj].n_dose1) - Number(nb_vaccines[indexDebutFenetre].n_dose1)
        differentielVaccinesParJour = differentielVaccinesFenetre / (indexDerniereMaj - indexDebutFenetre)
        const oneDay = (1000 * 60 * 60 * 24)
        const nbJoursAvantObjectif = Math.round(resteAVacciner / differentielVaccinesParJour)
        return new Date(derniereMaj + (oneDay * nbJoursAvantObjectif))
    }

    function buildLineChart(){

        var ctx = document.getElementById('lineVacChart').getContext('2d');
        let data_values = nb_vaccines.map(val => ({x: val.date, y:parseInt(val.n_dose1)}));
        let data_object_stock = cumul_stock_array.map((value, idx)=> ({x: dates_stock[idx], y: parseInt(value)}))
        let data_values_2doses = vaccines_2doses.n_dose2.map((value, idx)=> ({x: vaccines_2doses.jour[idx], y: parseInt(value)}))

        this.lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: nb_vaccines.map(val => val.date),
                datasets: [
                    {
                        label: 'Cumul vaccinés (2 doses) ',
                        data: data_values_2doses,
                        borderWidth: 3,
                        backgroundColor: '#1796e6',
                        borderColor: '#127aba',
                        pointRadius: 2,
                        steppedLine: true,
                    },
                    {
                        label: 'Cumul vaccinés (1 ou 2 doses) ',
                        data: data_values,
                        borderWidth: 3,
                        backgroundColor: '#a1cbe6',
                        borderColor: '#3691c9',
                        pointRadius: 2,
                        cubicInterpolationMode: 'monotone',
                    },
                    {
                        label: 'Doses réceptionnées (cumul) ',
                        data: data_object_stock,
                        borderWidth: 3,
                        borderColor: 'grey',
                        pointRadius: 2,
                        steppedLine: true,
                    },
                    
                ]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value.toString();
                        }
                    }
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
                        stacked: false,
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
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
        var ctx = document.getElementById('lineVacChart').getContext('2d');
        let labels = nb_vaccines.map(val => val.date)
        let data_values = data.map((value, idx) => ({x: labels[idx], y: value}))
        let rollingMeanValues = rollingMean(data).map((value, idx)=> ({x: labels[idx+3], y: Math.round(value)}))
        let data_values_2doses = vaccines_2doses.n_dose2.map((value, idx)=> ({x: vaccines_2doses.jour[idx], y: parseInt(value)}))

        this.lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Nombre quotidien de vaccinés (1 dose) ',
                        data: data_values,
                        borderWidth: 1,
                        backgroundColor: 'rgba(0, 168, 235, 0.5)',
                        borderColor: 'rgba(0, 168, 235, 0)',
                        cubicInterpolationMode: 'monotone'
                    },
                    {
                        label: 'Nombre quotidien de vaccinés (2 doses) ',
                        data: data_values_2doses,
                        borderWidth: 1,
                        backgroundColor: '#1796e6',
                        borderColor: '#1796e6',
                        cubicInterpolationMode: 'monotone'
                    },
                    {
                        label: 'Moyenne quotidienne ',
                        data: rollingMeanValues,
                        type: 'line',
                        borderColor: 'rgba(0, 168, 235, 1)',
                        backgroundColor: 'rgba(0, 168, 235, 0)',
                    }
                ]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].y.toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value;
                        }
                    }
                },
                maintainAspectRatio: false,
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            min: 0
                        },

                    }],
                    xAxes: [{
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
    function typeDonneesChart(){
        type_donnees = document.getElementById("type").value
        this.lineChart.destroy()
        document.getElementById("objectif").checked=false;
        if (type_donnees=="quotidien"){

            nb_vaccines_quot = [nb_vaccines[0].total]
            for(i=0; i<nb_vaccines.length-1; i++){
                nb_vaccines_quot.push(nb_vaccines[i+1].n_dose1-nb_vaccines[i].n_dose1)
            }
            buildBarChart(nb_vaccines_quot);
        } else {
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
        if (this.lineChart.options.annotation.annotations.length==0){
            this.lineChart.options.annotation.annotations.push(
                {
                    drawTime: "afterDatasetsDraw",
                    id: "hline",
                    type: "line",
                    mode: "horizontal",
                    scaleID: "y-axis-0",
                    value: obj,
                    borderColor: "green",
                    borderWidth: 3,
                    label: {
                        backgroundColor: "green",
                        content: "Objectif",
                        enabled: true
                    },
                    onClick: function(e) {
                        console.log("Annotation", e.type, this);
                    }
                });
        } else {
            this.lineChart.options.annotation.annotations = [];
        }
        this.lineChart.update()
    }

    tableVaccin(table, 0);
    function tableVaccin(tableElt, level){
        tableElt.innerHTML = "";
        let first = true;
        for(let i=0; i<10; i++){
            let row = tableElt.insertRow();

            for(let j=0; j<10; j++){
                let newrow = row.insertCell(j)

                let caseNb = i*10+j+1
                if((caseNb <= dejaVaccines && level == 0) || (caseNb <= (dejaVaccines - Math.floor(dejaVaccines))*100) && level == 1){
                    newrow.classList.add("green");
                } else {
                    if(first) {
                        if(level == 1) {
                            newrow.classList.add("blink_me");
                            newrow.classList.add(dejaVaccines >= 60 ? "grey" : "red");
                            first = false;
                        } else {
                            const subtable = document.createElement("table");
                            subtable.id = "subtableVaccin";
                            newrow.appendChild(subtable);
                            first = false;
                            tableVaccin(subtable, level+1);
                        }
                    } else if((caseNb <= 60 && level == 0) || ((dejaVaccines) < 60 && level == 1)) {
                        newrow.classList.add("red");
                    } else {
                        newrow.classList.add("grey");
                    }
                }
            }
        }
    }

    function majValeurs(){

        if (nb_vaccines[nb_vaccines.length-1].source == "Estimation"){
            document.getElementById("estimation_str").innerHTML = "⚠️ Données non consolidées";
        }

        document.getElementById("nb_doses_injectees").innerHTML = numberWithSpaces(dejaVaccinesNb);
        document.getElementById("nb_doses_injectees_24h").innerHTML = numberWithSpaces(dejaVaccinesNb - nb_vaccines[nb_vaccines.length-2].n_dose1);
        document.getElementById("nb_doses").innerHTML = numberWithSpaces(cumul_stock);
        document.getElementById("proportionVaccinesMax").innerHTML = (Math.round(dejaVaccines*10000000)/10000000).toFixed(2);
        //document.getElementById("proportionVaccinesMin").innerHTML = (Math.round(dejaVaccines/2*10000000)/10000000).toFixed(2);
        //document.getElementById("proportion_doses").innerHTML = (dejaVaccinesNb/cumul_stock*100).toFixed(1);

        document.getElementById("proportionAVaccinerImmu").innerHTML = (Math.round(restantaVaccinerImmunite*10000000)/10000000).toFixed(2);
        document.getElementById("objectif_quotidien").innerHTML = numberWithSpaces(objectifQuotidien);
        document.getElementById("date_projetee_objectif").innerHTML = formaterDate(dateProjeteeObjectif);
        date = nb_vaccines[nb_vaccines.length-1].date
        date = date.slice(8) + "/" + date.slice(5, 7)
        //heure = nb_vaccines[nb_vaccines.length-1].heure

        date_stock = dates_stock[dates_stock.length-1]
        date_stock = date_stock.slice(8) + "/" + date_stock.slice(5, 7)

        document.getElementById("date_maj_1").innerHTML = date;
        //document.getElementById("date_maj_2").innerHTML = date + " à " + heure;
        document.getElementById("date_maj_3").innerHTML = date;
        document.getElementById("date_maj_4").innerHTML = date_stock;
        tableVaccin(table, 0);

    }

    Array.prototype.sortBy = function(p) {
        return this.slice(0).sort(function(a,b) {
            return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
        });
    }

</script>