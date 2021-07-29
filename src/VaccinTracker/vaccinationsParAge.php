<script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.1.1/chroma.min.js" integrity="sha512-RWI59o+PDXjPl3bakOf3k2ZbDtfvn/OU/ZKe6QmkE0V/ve7vYKEJe0RdkDueS+VkghBazP+1o4LKGON+pHUa5g==" crossorigin="anonymous"></script>

<h2 style="margin-top: 40px;" id="vaccinations-par-age">Vaccinations par âge</h2>
Mise à jour : <span id="dateMajParAge">--/--</span>

<div>
    <select name="type_age" id="type_age" onchange="typeDonneesBarChartAge()">
        <option value="pop">Proportion de la population</option>
        <option value="abs">Personnes vaccinées</option>
    </select>
</div>

<div class="chart-container" style="position: relative; height:50vh; width:100%">
    <canvas id="barChartAge" style="margin-top:20px; max-height: 700px; max-width: 100%;"></canvas>
</div>
CovidTracker.fr - Données : Ministère de la Santé
<br>
<br>
<h3 id="evolution_age">Évolution de la couverture vaccinale</h3>
<div>
    <select name="type_age_evolution" id="type_age_evolution" onchange="switchEvolutionAge()">
        <option value="partiellement">Partiellement vaccinés</option>
        <option value="totalement">Totalement vaccinés</option>
    </select>
</div>
<div class="chart-container" style="position: relative; height:80vh; width:100%">
    <canvas id="lineChartAge" style="margin-top:20px; max-height: 700px;"></canvas>
</div>
CovidTracker.fr - Données : Ministère de la Santé
<script>
var data_age;
var barChartAge;
var data_age_all;
var lineChartAge;

fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-tot-a-fra_lastday.json', {cache: 'no-cache'})
       .then(response => {
           if (!response.ok) {
               throw new Error("HTTP error " + response.status);
           }
           return response.json();
       })
       .then(json => {
          this.data_age = json;
          buildBarChartAgePop();
        })
       .catch(function () {
           this.dataError = true;
           console.log("error1")
       }
      )

fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-tot-a-fra.json', {cache: 'no-cache'})
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(json => {
        this.data_age_all = json;
        buildLineChartAgePop("couv_dose1");
    })
    .catch(function () {
        this.dataError = true;
        console.log("error1")
    }
    )

      
function typeDonneesBarChartAge(){
    type_donnees = document.getElementById("type_age").value
    this.barChartAge.destroy()
    if(type_donnees=="pop"){
        buildBarChartAgePop();
    } else {
        buildLineChartAge();
    }
}

function switchEvolutionAge(){
    type_donnees = document.getElementById("type_age_evolution").value
    console.log(type_donnees)
    this.lineChartAge.destroy()
    if(type_donnees=="partiellement"){
        buildLineChartAgePop("couv_dose1")
    }
    if(type_donnees=="totalement"){
        buildLineChartAgePop("couv_complet")
    }
}

function buildLineChartAge(type){
    
    
    var ctx = document.getElementById('barChartAge').getContext('2d');

    this.barChartAge = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: data_age.age,
            datasets: [
                {
                label: 'Nombre de vaccinés (complètement) ',
                data: data_age["n_tot_complet"],
                borderWidth: 3,
                backgroundColor: "#1796e6",
                borderWidth: 0,
                cubicInterpolationMode: 'monotone',
            },
            {
                label: 'Nombre de vaccinés (partiellement) ',
                data: data_age["n_tot_dose1"],
                borderWidth: 3,
                backgroundColor: "#a1cbe6",
                borderWidth: 0,
                cubicInterpolationMode: 'monotone',
            },
           
            ]
        },
        options: {
            tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let value = data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']].toString().split(/(?=(?:...)*$)/).join(' ');
                            return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + value;
                        }
                    }
                },
            maintainAspectRatio: false,
            scales: {
						xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                    callback: function (value) {
                                        return value/1000 +" k";
                                    }
                                },
							stacked: false,
                            
						}],
						yAxes: [{
                            gridLines: {
                                display: false
                            },
							stacked: true
						}]
					},
            plugins: {
                deferred: {
                    xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                    yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                    delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                }
                },
            annotation: {
            events: ["click"],
            annotations: [
            ]
        }
        }
    });
    }

    function buildLineChartAgePop(type_donnees){
        
        var datasets = []
        var colorscale = chroma.scale(['#440154FF', '#39568CFF', '#1E968BFF', '#73D055FF', '#FDE725FF'])
        var maxdate;
        Object.keys(data_age_all).map((value_age, idx) => {
            var data = data_age_all[value_age]
            var data_xy = data[type_donnees].map((value, idx) => ({x: data.jour[idx], y: value}))
            maxdate = data.jour[data.jour.length-1]
            datasets.push({
                    label: value_age,
                    data: data_xy, //.map((value, index) => {x:data_age_all[value_age].jour[index], y: value}),
                    borderWidth: 3,
                    borderColor: colorscale(idx/10).hex(),
                    pointRadius: 0,
                    pointHitRadius: 1,
                    fill: false,
                    cubicInterpolationMode: 'monotone',
                })
            }
        )
        var ctx = document.getElementById('lineChartAge').getContext('2d');
        this.lineChartAge = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data_age_all["18 - 24 ans"].jour,
                datasets: datasets
            },
            plugins: [ChartDataLabels],
            options: {
                layout: {
                padding: {
                    left: -2,
                    right: 100,
                    top: 0,
                    bottom: 0
                    }
                },
                tooltips: {
                    mode: "x",
                    intersect: false,
                    //callbacks: {
                     //   label: function(tooltipItem, data) {
                     //   return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' %';
                      //  }
                    //}
                },
                maintainAspectRatio: false,
                scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false
                                },
                                type: 'time',
                                distribution: 'linear',
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    min: 0,
                                    max:105,
                                    callback: function (value) {
                                        return value + ' %';
                                    }
                                },
                                stacked: false
                            }]
                        },
                plugins: {
                    datalabels: {
                        anchor: "end",
                        clamp: true,
                        align: 'right',
                        color: function(ctx) {
                            return ctx.dataset.borderColor
                        },
                        formatter: function(value, context) {
                            if (context.dataset.data[context.dataIndex].x == maxdate)
                            {
                                return  context.dataset.label;
                            }
                            return "";
                        }
                },
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                    },
                    annotation: {
                    events: ["click"],
                    annotations: [
                        {
                            drawTime: "afterDatasetsDraw",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 100,
                            borderWidth: 1,
                            borderDash: [5, 5],
                            borderColor: "darkgreen",
                            label: {
                                backgroundColor: 'darkgreen',
                                content: "100 %",
                                enabled: true,
                                position: "top"
                            }
                        },
                        {
                            drawTime: "afterDatasetsDraw",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 80,
                            borderWidth: 1,
                            borderDash: [5, 5],
                            borderColor: "green",
                            label: {
                                backgroundColor: 'green',
                                content: "80 %",
                                enabled: true,
                                position: "top"
                            }
                        },
                        {
                            drawTime: "afterDatasetsDraw",
                            type: "line",
                            mode: "horizontal",
                            scaleID: "y-axis-0",
                            value: 60,
                            borderWidth: 1,
                            borderDash: [5, 5],
                            borderColor: "grey",
                            label: {
                                backgroundColor: 'grey',
                                content: "60 %",
                                enabled: true,
                                position: "top"
                            }
                        }
                    ]
                }
            }
        });
        
        }

    function buildBarChartAgePop(){
        
        let date = data_age.date
        document.getElementById("dateMajParAge").innerHTML = date.slice(8) + "/" + date.slice(5, 7);

        var ctx = document.getElementById('barChartAge').getContext('2d');
        console.log(data_age["couv_tot_complet"])
        this.barChartAge = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: data_age.age,
                datasets: [
                    {
                    label: 'Vaccinés (complètement) ',
                    data: data_age["couv_tot_complet"],
                    borderWidth: 3,
                    backgroundColor: "#1796e6",
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: 'Vaccinés (partiellement) ',
                    data: data_age["couv_tot_dose1"],
                    borderWidth: 3,
                    backgroundColor: "#a1cbe6",
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: 'Non vaccinés ',
                    data: [100, 100, 100, 100, 100, 100],
                    borderWidth: 3,
                    backgroundColor: "#ededed",
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
            
                ]
            },
            options: {
                tooltips: {
                    filter: function (tooltipItem) {
                        return tooltipItem.datasetIndex != 2;
                    },
                    callbacks: {
                        label: function(tooltipItem, data) {
                        return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' %';
                        }
                    }
                },
                maintainAspectRatio: false,
                scales: {
                            xAxes: [{
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    min: 0,
                                    max:100,
                                    callback: function (value) {
                                        return value + ' %';
                                    }
                                },
                                stacked: false,
                                
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: true
                            }]
                        },
                plugins: {
                    deferred: {
                        xOffset: 150,   // defer until 150px of the canvas width are inside the viewport
                        yOffset: '50%', // defer until 50% of the canvas height are inside the viewport
                        delay: 200      // delay of 500 ms after the canvas is considered inside the viewport
                    }
                    },
                annotation: {
                events: ["click"],
                annotations: [
                ]
            }
            }
        });
        
        }


</script>
