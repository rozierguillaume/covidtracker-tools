
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

.td-b{
    font-weight: bold;
}

th, td {
  text-align: left;
  padding: 16px;
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
</head>
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

<div style="overflow:scroll; height:75vh" shadow="">
    <table id="myTable">
    </table>
</div>

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
var lastorder="asc";

fetchDataTable();
function fetchDataTable(){
    fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dataexplorer_compr.json', {cache: 'no-cache'})
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
            <th onclick='sortTable(0, "ind")'>Territoire <span id='col0'>▼</span></th>
            <th onclick='sortTable(1, "ind")'>`+ "Valeur (" + date +`) <span id='col1'>▽</span></th>
            <th onclick='sortTable(2, "ind")'>Évolution relative (7 j.) <span id='col2'>▽</span></th>
            <th onclick='sortTable(3, "ind")'>Évolution absolue (7 j.) <span id='col3'>▽</span></th>
            <th></th>
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

function populateTable(){
    document.getElementById("descriptionTable").innerHTML = "<b>" + titres[datatype_table] + ".</b> " + descriptions[datatype_table]

    if(pour100kTable){
        document.getElementById("descriptionTable").innerHTML += " Pour 100k habitants."
    }

    var content_html=header_table()
    var matrice = data_table[territoire].slice()
    matrice.push('france')

    console.log(matrice)

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
            valeur_j7 = data_table[dep_id][datatype_table].valeur[N-8]/population

            prefixe_evolution = ""
            if(valeur_j7!=0){
                evolution_abs = valeur_j0 - valeur_j7
                evolution = ((evolution_abs) / valeur_j7 * 100).toFixed(1)
                
                
                if(evolution>=0){
                    prefixe_evolution = "+"
                }
                evolution = evolution.replace(".", ",")
                evolution_abs = evolution_abs.toFixed(1).replace(".", ",")

            } else {
                evolution = "--"
                evolution_abs="--"
            }

            valeur_j0 = valeur_j0.toFixed(1).replace(".", ",")

            confine=""
            nom = dep_id

            if(confines_19_mars_21.includes(dep_id)){
                confine="<i><span style='color: red'>Confiné (19 mars)</span></i>"
            }

            complement_territoire = ""

            if (territoire=="departements"){
                complement_territoire = data_table.departements_noms[dep_id]
            }

            if(dep_id == "france"){
                complement_territoire = "🇫🇷"
                nom = "France"
            }
            
            content_html += "<tr>"
            content_html += "<td class='td-b'>" + nom + " " + complement_territoire + "<br>" + confine + "</td>"
            content_html += "<td>" + valeur_j0 + suffixe + "</td>"
            content_html += "<td>" + prefixe_evolution + evolution + " % </td>"
            content_html += "<td>" + prefixe_evolution + evolution_abs + " </td>"
            content_html += "<td style='text-align: right; padding: 0px 0px 0px 0px;'>" + "<canvas style='display: inline-block;' id='littleChart" + replaceBadCharacters(dep_id) + "' width='170' height='50'></canvas>" + "</td>"
            
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
    DEB = N-40
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
      
      if(idxToSort>0){
        assess=false
        if(order=="desc"){
            assess = (parseInt(x.innerHTML.toLowerCase()) > parseInt(y.innerHTML.toLowerCase()))
        } 
        if(order=="asc") {
            assess = (parseInt(x.innerHTML.toLowerCase()) < parseInt(y.innerHTML.toLowerCase()))
        }
      }

      if(idxToSort==0){
        assess=false
        if(order=="desc"){
            //assess = (parseInt(x.innerHTML.toLowerCase()) < parseInt(y.innerHTML.toLowerCase()))
            assess = (('' + x.innerHTML).localeCompare(y.innerHTML))
        } 
        if(order=="asc") {
            //assess = (parseInt(x.innerHTML.toLowerCase()) > parseInt(y.innerHTML.toLowerCase()))
            assess = (('' + y.innerHTML).localeCompare(x.innerHTML))
        }
      }

      if (assess==1) {
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

