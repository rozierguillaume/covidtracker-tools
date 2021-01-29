<h2 style="margin-top: 40px;" id="vaccinations-par-age">Vaccinations par âge</h2>
Mise à jour : 27/01 
<div class="chart-container" style="position: relative; height:50vh; width:100%">
    <canvas id="barChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
</div>

<script>
var data;

fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-tot-a-fra_lastday.json', {cache: 'no-cache'})
       .then(response => {
           if (!response.ok) {
               throw new Error("HTTP error " + response.status);
           }
           return response.json();
       })
       .then(json => {
          this.data = json;
          buildLineChartAge();
        })
       .catch(function () {
           this.dataError = true;
           console.log("error1")
       }
      )


function buildLineChartAge(){

    var ctx = document.getElementById('barChart').getContext('2d');

    this.lineChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            //labels: nb_vaccines.map(val => val.date),
            labels: data.age,
            datasets: [
                {
                label: 'Nombre de vaccinés (2 doses) ',
                data: data.n_dose2,
                borderWidth: 3,
                backgroundColor: "#1796e6",
                borderWidth: 0,
                cubicInterpolationMode: 'monotone',
            },
            {
                label: 'Nombre de vaccinés (1 dose) ',
                data: data.n_dose1,
                borderWidth: 3,
                backgroundColor: "#a1cbe6",
                borderWidth: 0,
                cubicInterpolationMode: 'monotone',
            },
           
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
						xAxes: [{
                            gridLines: {
                                display: false
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
