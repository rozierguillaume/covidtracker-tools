
<style>

.btn-group{
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    }

.btn{
    color: black;
    border: 1px solid grey;
    
}
.btn.active{
    background-color: grey;
    color: white;
    
}
#choixTable button{
    margin: 0px;
}

table {
  border-spacing: 0;
  width: 100%;
  border: 0px solid #ddd;
}



th, td {
  text-align: left;
  padding: 16px;
  font-weight: normal;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}

th {
  position: sticky;
  top: -10px;
  z-index: 2;
  background-color: white;
  cursor: pointer;
}

</style>

<body>


<h3 id="table" style="margin-top: 40px;">Table de données</h3>
<select name="type" id="typeDoneesTable" onchange="selectDataTable()" style="margin-top:10px; margin-right: 10px;">
        <optgroup label="Indicateurs épidémiques">
            <option value="incidence">Taux d'incidence</option>
            <option value="cas">Cas positifs</option>
            <option value="tests">Dépistage</option>
            <option value="taux_positivite_rolling_before">Taux de positivite</option>
        </optgroup>
        <optgroup label="Indicateurs sanitaires">
            <option value="hospitalisations">Hospitalisations</option>
            <option value="incid_hospitalisations">Admissions à l'hôpital</option>
            <option value="reanimations">Réanimations</option>
            <option value="incid_reanimations">Admissions en réanimation</option>
            <option value="saturation_reanimations">Saturation des réanimations</option>
        
            <option value="nbre_acte_corona">Actes SOS médecin</option>
            <option value="nbre_pass_corona">Passages aux urgences</option>
            <option value="deces_hospitaliers">Décès hospitaliers</option>
        </optgroup>
        <optgroup label="Vaccination">
            <option value="n_cum_dose1">Personnes vaccinées</option>
        </optgroup>
</select>
<input type='checkbox' id='pour100kTable' onchange="pour100kTableChecked()" style="margin-bottom:10px;"> Pour 100k habitants<br>

<div id="choixTable">
    <div class="btn-group-sm" role="group" aria-label="Choix table">
        <button id="choixTableDepartement" type="button" class="btn btn-secondary active">
            Par département
        </button>
        <button id="choixTableRegion" type="button" class="btn btn-secondary">
            Par région
        </button>
    </div>
</div>

<h4 style="margin-top: 25px;"><span id="descriptionTable" ></span></h4>


<div style="overflow:scroll; height:85vh" shadow="">
    <table id="myTable">
    </table>
</div>
<i>Cliquez sur une entête pour ordonner la colonne correspondante. </i>

<script type="text/javascript">

var territoire = "departements"
    jQuery(document).ready(function ($) {
        $('#choixTableDepartement').click(function(){
            $('#choixTableDepartement').addClass('active');
            $('#choixTableRegion').removeClass('active');

            territoire = "departements"
            populateTable()
        });

        $('#choixTableRegion').click(function(){
            $('#choixTableRegion').addClass('active');
            $('#choixTableDepartement').removeClass('active');

            territoire = "regions"
            populateTable()            
        });
    });

function replaceBadCharacters(dep){
    return dep.replace("'", "&apos;").replace("ô", "&ocirc;")
}

var datatype_table = "incidence"
var data_table;
var lastsort=0;
var lastorder="desc";

setTimeout(function () {
    fetchDataTable();
        }, 2000);

function fetchDataTable(){
    fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/dataexplorer_compr.json', {cache: 'no-cache'})
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
                this.data_table = json;
                populateTable()
            })
        .catch(function () {
            this.dataError = true;
            console.log("error-x1")
        }
        )
}
function header_table(){
    jour_nom = data_table['france'][datatype_table].jour_nom
    N = data_table['france'][datatype_table].valeur.length
    var date = data_table['france'][jour_nom][N-1]
return `

        <tr>
            <th onclick='sortTable(0, "ind")'><b>Territoire</b> <span id='col0'>▼</span></th>
            <th onclick='sortTable(1, "ind")'>`+ "<b>Valeur</b> au<br>" + date +` <span id='col1'>▽</span></th>
            <th onclick='sortTable(2, "ind")'><b>Croissance hebdomadaire</b><br></b>aujourd'hui <span id='col2'>▽</span></th>
            <th onclick='sortTable(3, "ind")'><b>Croissance hebdomadaire</b><br>à J-3 <span id='col3'>▽</span></th>
            <th onclick='sortTable(4, "ind")'><b>Croissance sur 72 H</b><br>aujourd'hui<br><span id='col4'>▽</span></th>
            <th>Évolution depuis sept. 2020</th>
        </tr>

  `
}

function selectDataTable(){
    datatype_table = document.getElementById("typeDoneesTable").value
    pour100kChangeStyleTable();
    populateTable();
}

var pour100kTable=false
function pour100kTableChecked(){
    pour100kTable = !pour100kTable;
    populateTable();
}

pour100kChangeStyleTable()
function pour100kChangeStyleTable(){
    if (datatype_table == "incidence"){
        document.getElementById("pour100kTable").checked = true;
        document.getElementById("pour100kTable").setAttribute("disabled", "");
        

    } else if (datatype_table == "taux_positivite_rolling_before") {
        document.getElementById("pour100kTable").checked = false;
        document.getElementById("pour100kTable").setAttribute("disabled", "");
        
    } else {
        document.getElementById("pour100kTable").removeAttribute("disabled");
        if(!pour100kTable){
            document.getElementById("pour100kTable").checked = false;
        } else {
            document.getElementById("pour100kTable").checked = true;
        }
    }
}
var confines_19_mars_21 = ["02", "06", "27", "59", "60", "62", "75", "76", "77", "78", "80", "91", "92", "93", "94", "95"]
var confines_27_mars_21 = ["69", "58"]

function populateTable(){
    document.getElementById("descriptionTable").innerHTML = "<b>" + titres[datatype_table] + ".</b> " + descriptions[datatype_table]

    if(pour100kTable){
        document.getElementById("descriptionTable").innerHTML += " Pour 100k habitants."
    }

    var content_html=header_table()
    var matrice = data_table[territoire].slice()
    matrice.push('france')

    matrice.map((dep_id, idx) => {
        if(datatype_table in data_table[dep_id]){
            population = 1

            if(pour100kTable){
                if(!incompatibles_pour100k.includes(datatype_table)){
                population = data_table[dep_id].population/100000
                }
            }

            suffixe = ""

            if(datatype_table.includes("positiv")){
                suffixe="%"
            }

            N = data_table[dep_id][datatype_table].valeur.length
            valeur_j0 = data_table[dep_id][datatype_table].valeur[N-1]/population
            valeur_72h = data_table[dep_id][datatype_table].valeur[N-4]/population
            valeur_j7 = data_table[dep_id][datatype_table].valeur[N-8]/population
            valeur_j3 = data_table[dep_id][datatype_table].valeur[N-15]/population

            prefixe_evolution = ""
            color="black"
            if(valeur_j7!=0){
                evolution_abs = valeur_j0 - valeur_j7
                evolution = ((evolution_abs) / valeur_j7 * 100).toFixed(1)
                
                color="green"
                if(evolution>=0){
                    color="red"
                    prefixe_evolution = "+"
                }
                evolution = evolution.replace(".", ",")
                evolution_abs = evolution_abs.toFixed(1).replace(".", ",")

            } else {
                evolution = "--"
                evolution_abs="--"
            }

            prefixe_evolution_72h = ""
            color_72h="black"
            if(valeur_72h!=0){
                evolution_abs_72h = valeur_j0 - valeur_72h
                evolution_72h = ((evolution_abs_72h) / valeur_72h * 100).toFixed(1)
                
                color_72h="green"
                if(evolution_72h>=0){
                    color_72h="red"
                    prefixe_evolution_72h = "+"
                }
                evolution_72h = evolution_72h.replace(".", ",")
                evolution_abs_72h = evolution_abs_72h.toFixed(1).replace(".", ",")

            } else {
                evolution_72h = "--"
                evolution_abs_72h="--"
            }

            prefixe_evolution_j3 = ""
            color_j3="black"
            if(valeur_j3!=0){
                evolution_abs_j3 = valeur_j7 - valeur_j3
                evolution_j3 = ((evolution_abs_j3) / valeur_j3 * 100).toFixed(1)
                
                color_j3 = "green"
                if(evolution_j3>=0){
                    prefixe_evolution_j3 = "+"
                    color_j3="red"
                }
                evolution_j3 = evolution_j3.replace(".", ",")
                evolution_abs_j3 = evolution_abs_j3.toFixed(1).replace(".", ",")

            } else {
                evolution_j3 = "--"
                evolution_abs_j3="--"
            }

            valeur_j0 = valeur_j0.toFixed(1).replace(".", ",")

            confine=""
            nom = dep_id

            //if(confines_19_mars_21.includes(dep_id)){
               // confine="<span style='font-size: 60%; color: white; background-color: black; padding: 2px; border-radius: 5px; opacity: 0.5;'>Confiné (19 mars)</span>"
            //}
            //if(confines_27_mars_21.includes(dep_id)){
              //  confine="<span style='font-size: 60%; color: white; background-color: black; padding: 2px; border-radius: 5px; opacity: 0.5;'>Confiné (27 mars)</span>"
            //}

            complement_territoire = ""

            if (territoire=="departements"){
                complement_territoire = data_table.departements_noms[dep_id]
            }

            if(dep_id == "france"){
                complement_territoire = "🇫🇷"
                nom = "France"
            }
            
            content_html += "<tr>"
            content_html += "<td class='td-b'><span style='font-size: 125%;'>" + nom + " " + complement_territoire + "</span><br>" + confine + "</td>"
            content_html += "<td><span></span><span style='font-size: 125%;'>" + valeur_j0 + suffixe + "</span></td>"
            content_html += `<!--{{val}}--><td><span style="background:{{color}}; color: black; border-radius: 10px; padding: 2px; margin-right: 5px;"></span><span>`.replace("{{color}}", color).replace("{{val}}", evolution) + prefixe_evolution + evolution + " % </span></td>"
            content_html += `<td><span style="background:{{color}}; color: black; border-radius: 10px; padding: 2px; margin-right: 5px;"></span><span>`.replace("{{color}}", color_j3) + prefixe_evolution_j3 + evolution_j3 + " % </span></td>"
            content_html += `<td><span style="background:{{color}}; color: black; border-radius: 10px; padding: 2px; margin-right: 5px;"></span><span>`.replace("{{color}}", color_72h) + prefixe_evolution_72h + evolution_72h + " % </span></td>"
            content_html += "<td style='text-align: right; padding: 0px 0px 0px 0px;'>" + "<canvas style='display: inline-block;' id='littleChart" + replaceBadCharacters(dep_id) + "' width='300' height='50'></canvas>" + "</td>"
            
            content_html += "</tr>"
        }
        })

        document.getElementById("myTable").innerHTML = content_html

        ctx_list = []
        chart_list = []

        matrice.map((dep_id, idx) => {
            if(datatype_table in data_table[dep_id]){
                buildLittleChart(dep_id)
            } else {
                console.log(dep_id)
            }
        })

    sortTable(lastsort, lastorder)
}

var ctx_list = []
var chart_list = []
function buildLittleChart(dep_id){

    var ctx = document.getElementById('littleChart'+dep_id).getContext('2d');
    ctx_list.push(ctx)

    jour_nom = data_table[dep_id][datatype_table].jour_nom
    N = data_table[dep_id][datatype_table].valeur.length
    DEB = 130
    data_ch = data_table[dep_id][datatype_table].valeur.slice(DEB, N).map((value, idx) => ({x: data_table['france'][jour_nom][idx+DEB], y:value}))

    var gradient = ctx_list[ctx_list.length-1].createLinearGradient(180, 0, 0, 0);
    gradient.addColorStop(0, 'rgba(58, 94, 153, 0.2)');   
    gradient.addColorStop(1, 'rgba(68, 110, 179, 0)');

    var gradientbis = ctx_list[ctx_list.length-1].createLinearGradient(0, 0, 200, 0);
    gradientbis.addColorStop(0, 'rgba(58, 94, 153, 0.1)');   
    gradientbis.addColorStop(1, 'rgba(68, 110, 179,1)');


    var myChart = new Chart(ctx_list[ctx_list.length-1], {
        type: 'line',
        data: {
            datasets: [{
                label: '',
                data: data_ch,
                borderWidth: 3,
                pointRadius: 0.1,
                borderColor: gradientbis,
                backgroundColor: gradient,
                pointHitRadius: 5
            }]
        },
        options: {
            animation: {
                duration: 0
            },
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        min: 0,
                    },

                }],
                xAxes: [{
                    type: 'time',
                    distribution: 'linear',
                    display: false,
                    gridLines: {
                        display: false
                     }
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
                        return ""
                    }
                },
            },
        }
    });
    chart_list.push(myChart)

}

function sortTable(idxToSort, order) {
    
    if(lastsort==idxToSort){
        if(lastorder=="desc"){
            lastorder="asc"
        }else if(lastorder=="asc"){
            lastorder="desc"
        }
    }
    if (order=="ind"){
        order=lastorder
    }
    lastsort = idxToSort
    lastorder = order

    if(lastorder=="asc"){
        document.getElementById('col'+'0').innerHTML = "▽"
        document.getElementById('col'+'1').innerHTML = "▽"
        document.getElementById('col'+'2').innerHTML = "▽"
        document.getElementById('col'+'3').innerHTML = "▽"
        document.getElementById('col'+idxToSort).innerHTML = "▼"
    } else {
        document.getElementById('col'+'0').innerHTML = "△"
        document.getElementById('col'+'1').innerHTML = "△"
        document.getElementById('col'+'2').innerHTML = "△"
        document.getElementById('col'+'3').innerHTML = "△"
        document.getElementById('col'+idxToSort).innerHTML = "▲"
    }
    

  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  //console.log(table.innerHTML)
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  var j = 0
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    //console.log(rows)
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[idxToSort];
      y = rows[i + 1].getElementsByTagName("TD")[idxToSort];
      //check if the two rows should switch place:
      assess=false

      if(idxToSort>0){
        if(order=="desc"){
            //console.log("___")
            //console.log(idxToSort)
            //console.log(x.getElementsByTagName('span')[1].innerHTML)

            assess = (parseInt(x.getElementsByTagName('span')[1].innerHTML.toLowerCase()) > parseInt(y.getElementsByTagName('span')[1].innerHTML.toLowerCase()))
        } else if(order=="asc") {
            assess = (parseInt(x.getElementsByTagName('span')[1].innerHTML.toLowerCase()) < parseInt(y.getElementsByTagName('span')[1].innerHTML.toLowerCase()))
        }
      } else if(idxToSort==0){
        if(order=="desc"){
            //assess = (parseInt(x.innerHTML.toLowerCase()) < parseInt(y.innerHTML.toLowerCase()))
            assess = (('' + x.getElementsByTagName('span')[0].innerHTML).localeCompare(y.getElementsByTagName('span')[0].innerHTML))
            assess = (assess == 1)
        } else if(order=="asc") {
            //assess = (parseInt(x.innerHTML.toLowerCase()) > parseInt(y.innerHTML.toLowerCase()))
            assess = (('' + y.getElementsByTagName('span')[0].innerHTML).localeCompare(x.getElementsByTagName('span')[0].innerHTML))
            assess = (assess == 1)
        }
      }
      if (assess==true) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }

    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>

</body>
</html>

