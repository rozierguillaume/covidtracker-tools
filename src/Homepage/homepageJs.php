<script>
    var data;
    var data_opencovid;
    var data_sidep;
    var projection_cas = [];
    var data_indicateurs;
    var data_vaccination;
    var data_variants;

    //window.alert("Santé publique France a publié des données incomplètes et erronées ce soir. Nous les avons contactés. CovidTracker sera de nouveau à jour dès leur correction.");

    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/objectif_deconfinement.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            data = json;

            //buildBarChart();
            updateDataDiv();
            updateHospitDiv('rea');
            updateAdmHospitDiv('adm_rea');
            updateDcDiv("dc");

            buildLineChart("cas");
            buildLineChartAdmHosp("adm_rea");
            dataSelectedCas("cas")
            buildBarChart('rea');
            buildDcLineChart();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/variants.json')
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(json => {
        data_variants = json;
        buildChartVariants(data_variants);
        updateDivOmicron(data_variants);

    })
    .catch(function () {
            this.dataError = true;
        }
    )

    fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-fra.json')
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(json => {
        data_vaccination = json;
        buildChartVaccination(data_vaccination);
        updateDivVaccination(data_vaccination);

    })
    .catch(function () {
            this.dataError = true;
        }
    )


    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/vue-ensemble.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            data_opencovid = json;

            updateDataDivOpenCovid();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/cas_sidep.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            data_sidep = json;

            updateDataDivSidep();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/stats.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            this.data_indicateurs = json;
            //console.log(data_indicateurs)
            updateDataDivIndicateurs();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    function updateDataDivOpenCovid(){
        var cas_open_covid = numberWithSpaces(data_opencovid["cas"])
        if(cas_open_covid<=0){
            cas_open_covid = "--"
        }
        document.getElementById("cas_opencovid").innerHTML = cas_open_covid;
        document.getElementById("date_opencovid").innerHTML = data_opencovid["update"];
    }

    function updateDivVaccination(data){
        let N = data["n_dose3_moyenne7j"].length;
        value_today = data["n_dose3_moyenne7j"][N-1];
        value_j7 = data["n_dose3_moyenne7j"][N-8];
        variation = Math.round((value_today-value_j7)/value_j7*100);

        document.getElementById("nb_injections_jour").innerHTML = numberWithSpaces(value_today);

        if (variation>0){
            document.getElementById("nb_injections_variation").innerHTML = "en hausse (+ " + variation + " %)";
            document.getElementById("nb_injections_variation").className = "taux_croissance_baisse"; //c'est normal, c'est inversé
        } else {
            document.getElementById("nb_injections_variation").innerHTML = "en baisse (" + variation + " %)";
            document.getElementById("nb_injections_variation").className = "taux_croissance_hausse";
        }

        proportion_vaccines = Math.round(data["n_cum_dose1"][N-1]/67400)/10;
        document.getElementById("vaccination_proportion_population").innerHTML = proportion_vaccines;
        

    }

    function updateDataDivSidep(){
        document.getElementById("cas_sidep").innerHTML = numberWithSpaces(data_sidep["cas"]);
        document.getElementById("date_sidep").innerHTML = data_sidep["update"];
    }

    function updateDataDivIndicateurs(){
        document.getElementById("taux_incidence").innerHTML = data_indicateurs["taux_incidence"]["valeur"];
        document.getElementById("date_taux_incidence").innerHTML = data_indicateurs["tests_last7"]["date"] + " (J-3)";
        document.getElementById("taux_incidence_str").innerHTML = data_indicateurs["taux_incidence"]["str"];

        document.getElementById("reffectif").innerHTML = data_indicateurs["reffectif"]["valeur"];
        document.getElementById("date_reffectif").innerHTML = data_indicateurs["rea"]["date"];
        document.getElementById("reffectif_str").innerHTML = data_indicateurs["reffectif"]["str"];

        document.getElementById("sat_rea").innerHTML = data_indicateurs["taux_saturation_rea"]["valeur"] + "%";
        document.getElementById("date_sat_rea").innerHTML = data_indicateurs["rea"]["date"];
        document.getElementById("sat_rea_str").innerHTML = data_indicateurs["taux_saturation_rea"]["str"];

        document.getElementById("taux_positivite").innerHTML = data_indicateurs["taux_positivite"]["valeur"] + "%";
        document.getElementById("date_taux_positivite").innerHTML = data_indicateurs["tests_last7"]["date"] + " (J-3)";
        document.getElementById("taux_positivite_str").innerHTML = data_indicateurs["taux_positivite"]["str"];

    }

    function numberWithSpaces(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "&nbsp;");
    }

    function dataSelected(selected_data){
        barChart.destroy();
        updateHospitDiv(selected_data)
        buildBarChart(selected_data)

        document.getElementById("rea-ligne").classList.remove("selected")
        document.getElementById("hosp-ligne").classList.remove("selected")

        document.getElementById(selected_data + "-ligne").classList.add("selected")
        
    }

    function dataSelectedAdmHosp(selected_data){
        lineChartAdmHosp.destroy();
        updateAdmHospitDiv(selected_data)
        buildLineChartAdmHosp(selected_data)

        document.getElementById("adm_rea_ligne").classList.remove("selected")
        document.getElementById("adm_hosp_ligne").classList.remove("selected")

        document.getElementById(selected_data + "_ligne").classList.add("selected")
        
    }

    function dataSelectedCas(selected_data){
        lineChart.destroy();
        casDiv(selected_data);
        //updateHospitDiv(selected_data)
        buildLineChart(selected_data)

        document.getElementById("cas-btn").classList.remove("selected")
        document.getElementById("cas_spf-btn").classList.remove("selected")

        document.getElementById(selected_data + "-btn").classList.add("selected")
        
    }

    function updateHospitDiv(dataSelected){
        if(dataSelected=="rea"){
            dataSelectedString="en soins critiques"
            dataSelectedStringTitle="Soins critiques"
        } else if(dataSelected=="hosp"){
            dataSelectedString="hospitalisées"
            dataSelectedStringTitle="Hospitalisations"
        } 
        document.getElementById("typePersonnes").innerHTML = dataSelectedString;
        document.getElementById("titreHospitDiv").innerHTML = dataSelectedStringTitle;

        val_actu = data[dataSelected]["values"][data[dataSelected]["values"].length-1]
        val_j7 = data[dataSelected]["values"][data[dataSelected]["values"].length-8]

        update_date = data["rea"]["dates"][data["rea"]["dates"].length-1]
        update_date = update_date.slice(8) + "/" + update_date.slice(5, 7);

        document.getElementById("reanimations").innerHTML = numberWithSpaces(val_actu.toFixed());

        if (val_j7 > val_actu){
            document.getElementById("croissance_rea").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((val_actu-val_j7)/val_j7*100))+ "&nbsp;%)";
            document.getElementById("croissance_rea").className = "taux_croissance_baisse"
        } else {
            document.getElementById("croissance_rea").innerHTML = "en hausse (+&nbsp;" + Math.round((val_actu-val_j7)/val_j7*100)+ "&nbsp;%)";
            document.getElementById("croissance_rea").className = "taux_croissance_hausse"
        }

    }

    function updateAdmHospitDiv(dataSelected){
        if(dataSelected=="adm_rea"){
            dataSelectedString="admissions en soins critiques"
            dataSelectedStringTitle="Adm. soins critiques"
        } else if(dataSelected=="adm_hosp"){
            dataSelectedString="admissions à l'hôpital"
            dataSelectedStringTitle="Admissions hôpital"
        } 
        document.getElementById("typePersonnesAdm").innerHTML = dataSelectedString;
        document.getElementById("titreAdmissionsHospitDiv").innerHTML = dataSelectedStringTitle;

        val_actu = data[dataSelected]["values"][data[dataSelected]["values"].length-1]
        val_j7 = data[dataSelected]["values"][data[dataSelected]["values"].length-8]

        update_date = data["rea"]["dates"][data["adm_rea"]["dates"].length-1]
        update_date = update_date.slice(8) + "/" + update_date.slice(5, 7);

        document.getElementById("adm-hospit-value").innerHTML = numberWithSpaces(val_actu.toFixed());

        if (val_j7 > val_actu){
            document.getElementById("croissance-adm-hospit").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((val_actu-val_j7)/val_j7*100))+ "&nbsp;%)";
            document.getElementById("croissance-adm-hospit").className = "taux_croissance_baisse"
        } else {
            document.getElementById("croissance-adm-hospit").innerHTML = "en hausse (+&nbsp;" + Math.round((val_actu-val_j7)/val_j7*100)+ "&nbsp;%)";
            document.getElementById("croissance-adm-hospit").className = "taux_croissance_hausse"
        }

    }

    function updateDcDiv(dataSelected="dc"){

        val_actu = data[dataSelected]["values"][data[dataSelected]["values"].length-1]
        val_j7 = data[dataSelected]["values"][data[dataSelected]["values"].length-8]

        update_date = data["rea"]["dates"][data["dc"]["dates"].length-1]
        update_date = update_date.slice(8) + "/" + update_date.slice(5, 7);

        document.getElementById("dc_value").innerHTML = numberWithSpaces(val_actu.toFixed());

        if (val_j7 > val_actu){
            document.getElementById("croissance_dc").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((val_actu-val_j7)/val_j7*100))+ "&nbsp;%)";
            document.getElementById("croissance_dc").className = "taux_croissance_baisse"
        } else {
            document.getElementById("croissance_dc").innerHTML = "en hausse (+&nbsp;" + Math.round((val_actu-val_j7)/val_j7*100)+ "&nbsp;%)";
            document.getElementById("croissance_dc").className = "taux_croissance_hausse"
        }

    }

    function casDiv(selected_data){
        phrase = {
            "cas": ["On prélève en moyenne", ""],
            "cas_spf": ["En moyenne", "sont remontés "]
        }
        type_jour = {
            "cas": "(par date de prélèvement, J-3)",
            "cas_spf": "(par date de remontée, J-0)"
        }
        document.getElementById("cas_p1").innerHTML = phrase[selected_data][0];
        document.getElementById("cas_p2").innerHTML = phrase[selected_data][1];

        cas_actu = data[selected_data]["values"][data[selected_data]["values"].length-1]
        document.getElementById("cas_moyen_quotidien").innerHTML = numberWithSpaces(cas_actu.toFixed());

        document.getElementById("type_jour").innerHTML = type_jour[selected_data];

        cas_j7 = data[selected_data]["values"][data[selected_data]["values"].length-8]

        if (cas_j7 > cas_actu){
            document.getElementById("croissance_cas").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((cas_actu-cas_j7)/cas_j7*100))+ "&nbsp;%)";
            document.getElementById("croissance_cas").className = "taux_croissance_baisse"
        } else {
            document.getElementById("croissance_cas").innerHTML = "en hausse (+&nbsp;" + Math.round((cas_actu-cas_j7)/cas_j7*100)+ "&nbsp;%)";
            document.getElementById("croissance_cas").className = "taux_croissance_hausse"
        }
    }

    function updateDataDiv(){
        casDiv("cas");

        cas_actu = data["cas"]["values"][data["cas"]["values"].length-1]

        update_date = data["rea"]["dates"][data["rea"]["dates"].length-1]

        update_date_cas = data["cas"]["dates"][data["cas"]["dates"].length-1]
        update_date_cas = update_date_cas.slice(8) + "/" + update_date_cas.slice(5, 7);

        const oneDay = (1000 * 60 * 60 * 24) ;
        maj_int = (moment() - Date.parse("2021-"+update_date.slice(5,7)+"-"+update_date.slice(8,10)))/oneDay
        
        if(maj_int<1){
            maj_str = "aujourd'hui"
        } else if (maj_int < 2){
            maj_str = "hier"
        } else {
            maj_str=update_date}
        
        document.getElementById("date_update_coup_doeil").innerHTML = maj_str;
        document.getElementById("date_update_coup_doeil2").innerHTML = maj_str;

    }

    var lineChart;
    function buildLineChart(selected_data){

        var ctx = document.getElementById('lineCasChart').getContext('2d');

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data[selected_data]["dates"],
                datasets: [{
                    label: 'Cas positifs',
                    data: data[selected_data]["values"],
                    borderWidth: 3,
                    pointRadius: 0,
                    backgroundColor: 'rgba(0, 168, 235, 0.5)',
                    borderColor: 'rgba(0, 168, 235, 1)'
                },
                    {
                        label: 'Projection cas positifs',
                        data: projection_cas
                    }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 100      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            min: 0,
                            userCallback: function(value, index, values) {
                                return value/1000+"k"
                            }
                        },

                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
                        }

                    }]
                },
                annotation: {
                    events: ["click"],
                    annotations: [
                        {
                            drawTime: "afterDatasetsDraw",
                            id: "hline",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 5000,
                            borderColor: "green",
                            borderWidth: 2,
                            label: {
                                backgroundColor: "green",
                                content: "Objectif",
                                enabled: true
                            },
                            borderDash: [6, 2],
                            onClick: function(e) {
                                //console.log("Annotation", e.type, this);
                            }
                        }
                    ]
                }
            }
        });
    }

    var lineChartAdmHosp;
    function buildLineChartAdmHosp(selected_data){ 

        selected_color_background = 'rgba(201, 4, 4, 0.5)';
        selected_color_border = 'rgba(201, 4, 4, 1)'; 
        if (selected_data=="adm_hosp"){
            selected_color_background = 'rgba(209, 102, 21,0.3)';
            selected_color_border = 'rgba(209, 102, 21,1)';
        }

        var ctx = document.getElementById('admHospitChart').getContext('2d');

        lineChartAdmHosp = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data[selected_data]["dates"],
                datasets: [{
                    label: 'Cas positifs',
                    data: data[selected_data]["values"],
                    borderWidth: 3,
                    pointRadius: 0,
                    backgroundColor: selected_color_background,
                    borderColor: selected_color_border
                },
                    {
                        label: 'Projection cas positifs',
                        data: projection_cas
                    }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 100      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            min: 0,
                            userCallback: function(value, index, values) {
                                return value/1000+"k"
                            }
                        },

                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
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

    function updateDivOmicron(data_variants){
        let n = data_variants["taux_c1"].length
        document.getElementById("taux_non_c1").innerHTML = (100-data_variants["taux_c1"][n-1]).toFixed(1)
    }

    var omicronChart;
    function buildChartVariants(data_variants){
        var ctx = document.getElementById('omicronChart').getContext('2d');

        omicronChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data_variants["jours"],
                datasets: [
                    {
                    label: 'Suspectés Omicron (absence L452R)',
                    data: data_variants["cas_non_c1"],
                    pointRadius: 0,
                    backgroundColor: 'rgba(240, 31, 31)',
                    borderColor: 'rgba(240, 31, 31, 0)',
                },
                    {
                    label: 'Suspectés Delta (présence L452R)',
                    data: data_variants["cas_c1"],
                    pointRadius: 0,
                    backgroundColor: 'rgba(153, 153, 153, 1)',
                    borderColor: 'rgba(153, 153, 153, 0)',
                },
                {
                    label: 'Total cas',
                    data: data_variants["cas"].map((value, idx) => (0)),
                    borderWidth: 3,
                    pointRadius: 0,
                    borderColor: 'rgba(0, 0, 0, 1)'
                },
                ]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   
                        yOffset: '50%', 
                        delay: 100 
                    }
                },
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            min: 0,
                            userCallback: function(value, index, values) {
                                return value/1000+"k"
                            }
                        },

                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
                        }

                    }]
                },
            }
        });
    }

    var lineChartAdmHosp;
    function buildLineChartAdmHosp(selected_data){ 

        selected_color_background = 'rgba(201, 4, 4, 0.5)';
        selected_color_border = 'rgba(201, 4, 4, 1)'; 
        if (selected_data=="adm_hosp"){
            selected_color_background = 'rgba(209, 102, 21,0.3)';
            selected_color_border = 'rgba(209, 102, 21,1)';
        }

        var ctx = document.getElementById('admHospitChart').getContext('2d');

        lineChartAdmHosp = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data[selected_data]["dates"],
                datasets: [{
                    label: 'Cas positifs',
                    data: data[selected_data]["values"],
                    borderWidth: 3,
                    pointRadius: 0,
                    backgroundColor: selected_color_background,
                    borderColor: selected_color_border
                },
                    {
                        label: 'Projection cas positifs',
                        data: projection_cas
                    }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 100      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            min: 0,
                            userCallback: function(value, index, values) {
                                return value/1000+"k"
                            }
                        },

                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
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

    var lineChartDc;
    function buildDcLineChart(){
        
        var ctx = document.getElementById('barChartDc').getContext('2d');

        lineChartDc = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data["dc"]["dates"],
                datasets: [{
                    label: 'Décès hospitaliers ',
                    data: data["dc"]["values"],
                    borderWidth: 3,
                    pointRadius: 0,
                    backgroundColor: 'rgba(0,0,0,0.4)',
                    borderColor: 'rgba(0,0,0,1)'
                }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 500      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            min: 0
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
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

    function calculerProjection(){
        let one_day = (1000 * 60 * 60 * 24)

        let jours_restants_cas = (Date.parse("2020-12-12") - Date.parse(data["cas"]["dates"][data["cas"]["dates"].length-1])) / one_day
        let jours_restants_rea = (Date.parse("2020-12-15") - Date.parse(data["rea"]["dates"][data["rea"]["dates"].length-1])) / one_day

        data_cas = data["cas"]["values"]

        var croissance_cas = 0
        for(idx=1; idx<=7; idx++) {
            croissance_cas += (data_cas[data_cas.length-idx-1] - data_cas[data_cas.length-idx])/data_cas[data_cas.length-idx-1]
        };

        croissance_cas /= 7
        var projection_cas = []
        var labels_cas = []

        for (var idx = 1; idx <= data_cas.length; idx++) {
            projection_cas.push(NaN)
        }

        for (var idx = 1; idx <= jours_restants_cas; idx++) {

            var d = moment(data["cas"]["dates"][data["cas"]["dates"].length-1]).add(idx, 'd')
            labels_cas.push( d.format('YYYY-MM-DD') )

            projection_cas.push(Math.round(data_cas[data_cas.length-1] * (1-croissance_cas)**idx))
        }

        // REA
        data_rea = data["rea"]["values"]

        var croissance_rea = 0

        for(idx=1; idx<=7; idx++) {
            croissance_rea += (data_rea[data_rea.length-idx-1] - data_rea[data_rea.length-idx])/data_rea[data_rea.length-idx-1]
        };

        croissance_rea /= 7

        projection_rea = Math.round(data_rea[data_rea.length-1] * (1-croissance_rea)**jours_restants_rea);

        var projection_rea = []
        for (var idx = 1; idx <= data_rea.length; idx++) {
            projection_rea.push(NaN)
        }

        var labels_rea = []
        for (var idx = 1; idx <= jours_restants_rea; idx++) {
            var d = moment(data["rea"]["dates"][data["rea"]["dates"].length-1]).add(idx, 'd')
            labels_rea.push( d.format('YYYY-MM-DD') )

            projection_rea.push(Math.round(data_rea[data_rea.length-1] * (1-croissance_rea)**idx))
        }

    }
    function buildBarChart(dataSelected){
        if(dataSelected=='rea'){
            buildReaBarChart()
        } else if(dataSelected=='hosp'){
            buildHospBarChart()
        }
    }

    var lineChartVaccnation;
    function buildChartVaccination(data){
        lineChartVaccnation = new Chart(document.getElementById("line-chart-vaccination"), {
            type: 'line',
            data: {
            labels: data["dates"].slice(-100, -1),
            datasets: [
                {
                label: "",
                backgroundColor: "rgba(185, 235, 203, 0.6)",
                borderColor: "#9bc9ac",
                data: data["n_dose3_moyenne7j"].slice(-100, -1),
                pointRadius: 0
                }
            ]
            },
            options: {
            legend: { display: false },
            scales: {
                xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxRotation: 0,
                                minRotation: 0,
                                maxTicksLimit: 6,
                                callback: function(value, index, values) {
                                    return value.slice(8) + "/" + value.slice(5, 7);
                                }
                            }

                        }],
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            return value/1000 + " k";
                        }
                    }

                }]
            },
            title: {
                display: false,
                text: ''
            }
            }
        });
    }

    var barChart;
    function buildReaBarChart(){

        var ctx = document.getElementById('barChart').getContext('2d');

        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data["rea"]["dates"],
                datasets: [{
                    label: 'Personnes en soins critiques',
                    data: data["rea"]["values"],
                    borderWidth: 0.5,
                    backgroundColor: 'rgba(201, 4, 4, 0.5)',
                    borderColor: 'rgba(201, 4, 4, 1)'
                }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 500      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        categoryPercentage: 1.0,
                        barPercentage: 1.0,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
                        }

                    }]
                },
                annotation: {
                    events: ["click"],
                    annotations: [
                        {
                            drawTime: "afterDatasetsDraw",
                            id: "hline",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 3000,
                            borderColor: "green",
                            borderWidth: 2,
                            label: {
                                backgroundColor: "green",
                                content: "Objectif",
                                enabled: true,
                            },
                            borderDash: [6, 2],
                            onClick: function(e) {
                                console.log("Annotation", e.type, this);
                            }
                        }
                    ]
                }

            },


        });
    }

    //var barChartHosp
    function buildHospBarChart(){

        var ctx = document.getElementById('barChart').getContext('2d');

        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data["hosp"]["dates"],
                datasets: [{
                    label: 'Personnes hospitalisées',
                    data: data["hosp"]["values"],
                    borderWidth: 0.5,
                    backgroundColor: 'rgba(209, 102, 21,0.3)',
                    borderColor: 'rgba(209, 102, 21,1)'
                }]
            },
            options: {
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 100      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        categoryPercentage: 1.0,
                        barPercentage: 1.0,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            maxTicksLimit: 6,
                            callback: function(value, index, values) {
                                return value.slice(8) + "/" + value.slice(5, 7);
                            }
                        }

                    }]
                },
                annotation: {
                    events: ["click"],
                    annotations: [
                        {
                            drawTime: "afterDatasetsDraw",
                            id: "hline",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 34000,
                            borderColor: "red",
                            borderWidth: 2,
                            label: {
                                backgroundColor: "red",
                                content: "Max. observé",
                                enabled: true
                            },
                            borderDash: [6, 2],
                            onClick: function(e) {
                                console.log("Annotation", e.type, this);
                            }
                        }
                    ]
                }

            },


        });
    }

</script>