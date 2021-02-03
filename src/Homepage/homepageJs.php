<script>
    var data;
    var data_opencovid;
    var data_sidep;
    var projection_cas = [];
    var data_indicateurs;

    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/objectif_deconfinement.json')
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
            calculerProjection();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/opencovid.json')
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

    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/cas_sidep.json')
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

    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/stats.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            this.data_indicateurs = json;
            console.log(data_indicateurs)
            updateDataDivIndicateurs();

        })
        .catch(function () {
                this.dataError = true;
            }
        )

    function updateDataDivOpenCovid(){
        var cas_open_covid = data_opencovid["cas"]
        if(cas_open_covid<=0){
            cas_open_covid = "--"
        }
        document.getElementById("cas_opencovid").innerHTML = cas_open_covid;
        document.getElementById("date_opencovid").innerHTML = data_opencovid["update"];
    }

    function updateDataDivSidep(){
        document.getElementById("cas_sidep").innerHTML = data_sidep["cas"];
        document.getElementById("date_sidep").innerHTML = data_sidep["update"];
    }

    function updateDataDivIndicateurs(){
        document.getElementById("taux_incidence").innerHTML = data_indicateurs["taux_incidence"]["valeur"];
        document.getElementById("taux_incidence_str").innerHTML = data_indicateurs["taux_incidence"]["str"];

        document.getElementById("reffectif").innerHTML = data_indicateurs["reffectif"]["valeur"];
        document.getElementById("reffectif_str").innerHTML = data_indicateurs["reffectif"]["str"];

        document.getElementById("sat_rea").innerHTML = data_indicateurs["taux_saturation_rea"]["valeur"] + "%";
        document.getElementById("sat_rea_str").innerHTML = data_indicateurs["taux_saturation_rea"]["str"];

        document.getElementById("taux_positivite").innerHTML = data_indicateurs["taux_positivite"]["valeur"] + "%";
        document.getElementById("taux_positivite_str").innerHTML = data_indicateurs["taux_positivite"]["str"];

    }

    function numberWithSpaces(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "&nbsp;");
    }

    function updateDataDiv(){
        rea_actu = data["rea"]["values"][data["rea"]["values"].length-1]
        hosp_actu = data["hosp"]["values"][data["hosp"]["values"].length-1]
        cas_actu = data["cas"]["values"][data["cas"]["values"].length-1]
        dc_actu = data["dc"]["values"][data["dc"]["values"].length-1]

        rea_j7 = data["rea"]["values"][data["rea"]["values"].length-8]
        cas_j7 = data["cas"]["values"][data["cas"]["values"].length-8]
        dc_j7 = data["dc"]["values"][data["dc"]["values"].length-8]
        hosp_j7 = data["hosp"]["values"][data["hosp"]["values"].length-8]

        update_date = data["rea"]["dates"][data["rea"]["dates"].length-1]
        update_date = update_date.slice(8) + "/" + update_date.slice(5, 7);

        update_date_cas = data["cas"]["dates"][data["cas"]["dates"].length-1]
        update_date_cas = update_date_cas.slice(8) + "/" + update_date_cas.slice(5, 7);

        document.getElementById("cas_moyen_quotidien").innerHTML = numberWithSpaces(cas_actu);
        document.getElementById("reanimations").innerHTML = numberWithSpaces(rea_actu);
        document.getElementById("hospitalisations").innerHTML = numberWithSpaces(hosp_actu);
        document.getElementById("dc_hosp").innerHTML = numberWithSpaces(dc_actu);

        if (rea_j7 > rea_actu){
            document.getElementById("croissance_rea").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((rea_actu-rea_j7)/rea_j7*100))+ "&nbsp;%) ";
        } else {
            document.getElementById("croissance_rea").innerHTML = "en hausse (+&nbsp;" + Math.round((rea_actu-rea_j7)/rea_j7*100)+ "&nbsp;%) ";
        }

        if (cas_j7 > cas_actu){
            document.getElementById("croissance_cas").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((cas_actu-cas_j7)/cas_j7*100))+ "&nbsp;%) ";
        } else {
            document.getElementById("croissance_cas").innerHTML = "en hausse (+&nbsp;" + Math.round((cas_actu-cas_j7)/cas_j7*100)+ "&nbsp;%) ";
        }

        if (dc_j7 > dc_actu){
            document.getElementById("croissance_dc_hosp").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((dc_actu-cas_j7)/dc_j7*100))+ "&nbsp;%) ";
        } else {
            document.getElementById("croissance_dc_hosp").innerHTML = "en hausse (+&nbsp;" + Math.round((dc_actu-dc_j7)/dc_j7*100)+ "&nbsp;%) ";
        }

        if (hosp_j7 > hosp_actu){
            document.getElementById("croissance_hosp").innerHTML = "en baisse (-&nbsp;" + Math.round(Math.abs((hosp_actu-hosp_j7)/hosp_j7*100))+ "&nbsp;%) ";
        } else {
            document.getElementById("croissance_hosp").innerHTML = "en hausse (+&nbsp;" + Math.round((hosp_actu-hosp_j7)/hosp_j7*100)+ "&nbsp;%) ";
        }

        const oneDay = (1000 * 60 * 60 * 24) ;
        maj_int = (moment() - Date.parse("2021-"+update_date.slice(3,5)+"-"+update_date.slice(0,2)))/oneDay
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
    function buildLineChart(projection_cas, labels_cas, projection_rea){

        var ctx = document.getElementById('lineCasChart').getContext('2d');

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data["cas"]["dates"],
                datasets: [{
                    label: 'Cas positifs',
                    data: data["cas"]["values"],
                    borderWidth: 3,
                    pointRadius: 1,
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
                        delay: 500      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
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
                            borderWidth: 3,
                            label: {
                                backgroundColor: "green",
                                content: "Objectif",
                                enabled: true
                            },
                            onClick: function(e) {
                                console.log("Annotation", e.type, this);
                            }
                        }
                    ]
                }
            }
        });
    }

    var lineChartDc;
    function buildLineChartDc(){
        
        var ctx = document.getElementById('lineDcChart').getContext('2d');

        lineChartDc = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data["dc"]["dates"],
                datasets: [{
                    label: 'Décès hospitaliers ',
                    data: data["dc"]["values"],
                    borderWidth: 3,
                    pointRadius: 1,
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
                            display: false
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


        // Emoji de couleur

        buildLineChart(projection_cas, labels_cas);
        
        buildBarChart(projection_rea, labels_rea);
        buildLineChartDc();
        buildBarChartHosp();

    }

    var barChart
    function buildBarChart(projection_rea, labels_rea){

        var ctx = document.getElementById('barReaChart').getContext('2d');

        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data["rea"]["dates"],
                datasets: [{
                    label: 'Personnes en réanimation',
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
                            display: false
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
                            borderWidth: 3,
                            label: {
                                backgroundColor: "green",
                                content: "Objectif",
                                enabled: true
                            },
                            onClick: function(e) {
                                console.log("Annotation", e.type, this);
                            }
                        }
                    ]
                }

            },


        });
    }

    var barChartHosp
    function buildBarChartHosp(){

        var ctx = document.getElementById('barHospChart').getContext('2d');

        barChartHosp = new Chart(ctx, {
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
                        delay: 500      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
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
                    ]
                }

            },


        });
    }

</script>