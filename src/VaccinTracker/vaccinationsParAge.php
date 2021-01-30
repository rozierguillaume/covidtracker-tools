

<h2 style="margin-top: 40px;" id="vaccinations-par-age">Vaccinations par âge</h2>
Mise à jour : 27/01 

<div>
    <select name="type_age" id="type_age" onchange="typeDonneesBarChartAge()">
        <option value="abs">Personnes vaccinées</option>
        <option value="pop">Proportion de la population</option>
    </select>
    </div>

<div class="chart-container" style="position: relative; height:50vh; width:100%">
    <canvas id="barChartAge" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
</div>
CovidTracker.fr - Données : Ministère de la Santé
<br>
<script>
var data_age;
var barChartAge;

fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-tot-a-fra_lastday.json', {cache: 'no-cache'})
       .then(response => {
           if (!response.ok) {
               throw new Error("HTTP error " + response.status);
           }
           return response.json();
       })
       .then(json => {
          this.data_age = json;
          buildLineChartAge();
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
        buildLineChartAgePop();
    } else {
        buildLineChartAge();
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
                label: 'Nombre de vaccinés (2 doses) ',
                data: data_age["n_dose2"],
                borderWidth: 3,
                backgroundColor: "#1796e6",
                borderWidth: 0,
                cubicInterpolationMode: 'monotone',
            },
            {
                label: 'Nombre de vaccinés (1 dose) ',
                data: data_age["n_dose1"],
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
							stacked: true,
                            
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

    function buildLineChartAgePop(){
        var ctx = document.getElementById('barChartAge').getContext('2d');

        this.barChartAge = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: data_age.age,
                datasets: [
                    {
                    label: 'Vaccinés (1 ou 2 doses) ',
                    data: data_age["n_dose2_pop"],
                    borderWidth: 3,
                    backgroundColor: "#1796e6",
                    borderWidth: 0,
                    cubicInterpolationMode: 'monotone',
                },
                {
                    label: 'Vaccinés (1 dose) ',
                    data: data_age["n_dose1_pop"],
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
                        return data['datasets'][tooltipItem.datasetIndex]['label'] + ': ' + data['datasets'][tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' %';
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
                                    min: 0,
                                    max:100,
                                    callback: function (value) {
                                        return value + ' %';
                                    }
                                },
                                stacked: true,
                                
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
