
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/google-palette/1.1.0/palette.min.js" integrity="sha512-+rKeqfKuzCrzOolK5cPvYqzEHJTEPWG1MTvH02P+MYgmw7uMyNiewzvzlPj0wOgPd10jdNAtkf8tL1aQt7RsxQ==" crossorigin="anonymous"></script>

Générateur de courbes de Castex<br>
<i>* Ceci est une page parodique comportant de fausses données.</i>

<br>
<button onclick="buildBarChart()" style="padding: 30px; font-size: 20px; background-color:white; border-radius: 10px;">👉🏻 Générer une courbe selon Castex 👈🏻</button>
<br>

<h3 id="title"></h3>
<div class="chart-container" style="position: relative; height:70vh; width:90vw; max-width: 1000px; max-height: 500px;">
    <canvas id="barChart" style="margin-top:20px;"></canvas>
</div>

<i>* Ceci est une page parodique comportant de fausses données.</i>

<script>

    var already_built = false;

    function randomTitle(){
        list_titles = [
            "Nombre de cas",
            "Taux de positivité",
            "Admissions en réanimation",
            "Admissions à l'hôpital",
            "Lits occupés",
            "Lits de réanimation occupés",
            "Taux d'incidence",
            "Taux de reproduction R",
            "Décès hospitaliers"
        ]
        idx = Math.random()*list_titles.length
        document.getElementById("title").innerHTML = list_titles[Math.floor(idx)] + " selon Castex*"
        return list_titles[Math.floor(idx)]
    }

    function fakeData(len){
        var data = []
        rand1 = (Math.random())+0.5
        rand2 = (Math.random())+0.5
        rand3 = (Math.random())+0.5
        rand4 = (Math.random())+0.5

        pos_i = Math.random()*len

        value = Math.random()*100
        value = 10
    
        for(i=0; i<len; i++){
            
            day_rand = Math.random()*10
            day = moment("2020-03-01").add(i, 'days');
            data.push({x: day, y: value})
            
            if(i<=Math.random()*len){
                value = value * (rand1)
            } else {
                value = value * (rand2)
            }
        }
        console.log(data)
        return data
    }

    var barChart;
    function buildBarChart(){
        if (already_built==true){
            barChart.destroy()
        }
        var seq = palette('mpn65', 40);
        console.log(seq)
        var ctx = document.getElementById('barChart').getContext('2d');

        this.barChart = new Chart(ctx, {
            type: 'line',
            data: {
                //labels: ,
                datasets: [
                    {   
                        label: randomTitle(),
                        data: fakeData(20),
                        borderColor: "#"+seq[Math.floor(Math.random()*39)],
                        //fill: seq[Math.floor(Math.random()*39)],

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
                            //min:0,
                            //max:1000
                        }
                    }],
                    xAxes: [{
                        offset: true,
                        //stacked: true,
                        type: 'time',
                        //distribution: 'linear',
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
        already_built=true
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
</style>