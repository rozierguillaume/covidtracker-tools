<script id="legendTemplatePre" type="text/template">
    <table>
        <tbody>
</script>

<script id="legendTemplateMid" type="text/template">
    <tr>
        <td class="legendValue"
            style="text-align: center; background-color: colorBg; color: white; font-size: 50%; padding: 5px;"
            data-idx="idxval"
        >
            valeur
        </td>
    </tr>
</script>

<script id="legendTemplatePost" type="text/template">
    </tbody>
    </table>
</script>

<script>
    Array.prototype.asortBy = function (p) {
        return this.slice(0).sort(function (a, b) {
            return (a[p] < b[p]) ? 1 : (a[p] > b[p]) ? -1 : 0;
        });
    };

    Number.prototype.addZero = function () {
        if (this <= 9) {
            return "0" + this;
        }
        return this
    };

    var donneesDepartements;
    var data_incid;
    var selected_departement = "";

    jQuery(document).ready(function ($) {

        var tableauValeurs = [0, 50]

        var tableauCouleurs1dose = [
            "#005AB5",
            "#DC3220"
        ];

        var tableauCouleurs2doses = [
            "#3874b0",
            "#db6e63"
        ];
        

        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/pred_dep_incid.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(json => {
            data_incid = json;
            })
        .catch(function (error) {
            this.dataError = true;
            console.log("error 2")
            console.log(error)
        }
        )


        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/dep_incidence_moins_50.json')
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                donneesDepartements = json;
                colorationsCartes();
                majCompteurDepartements();
                updateList();
            });

        nb_dep_incid_inf_50=0;
        nb_dep_incid_sup_50=0;
        nb_dep_incid_inf_50_pred=0;
        nb_dep_incid_sup_50_pred=0;

        function compter_departements(data){
            if(data["aujourdhui"]<50){
                    nb_dep_incid_inf_50 += 1
                } else {
                    nb_dep_incid_sup_50 +=1
                }
            if(data["prediction_j7"]<50){
                nb_dep_incid_inf_50_pred += 1
            } else {
                nb_dep_incid_sup_50_pred +=1
            }
        }

        function majCompteurDepartements(){
            document.getElementById("nb_dep_incid_inf_50").innerHTML = nb_dep_incid_inf_50;
            document.getElementById("nb_dep_incid_inf_50_pred").innerHTML = nb_dep_incid_inf_50_pred;
        }

        function replaceBadCharacters(dep){
            return dep.replace("'", "&apos;") //.replace("ô", "&ocirc;")
        }

        function updateList(){
            html_str = "<option value=''>Choisissez un département</option>";

            for (dep in donneesDepartements){
                html_str += "<option value='" + replaceBadCharacters(donneesDepartements[dep]["nomDepartement"]) + "'>" + donneesDepartements[dep]["nomDepartement"] + "</option>"
            }
            
            document.getElementById("deps_list_choice").innerHTML = html_str;   
        }

        function colorationsCartes() {
            pourcentage = true;

            $('#carteEHPAD1Dose path').css("fill", "#c4c4cb");
            $('#carteEHPAD2Doses path').css("fill", "#c4c4cb");

            construireLegendesEHPAD(tableauValeurs, tableauCouleurs1dose, $("#legendeCarteAujourdhui"));
            construireLegendesEHPAD(tableauValeurs, tableauCouleurs2doses, $("#legendeCartePrediction"));

            for (numeroDepartement in donneesDepartements) {
                if (numeroDepartement == '00') {
                    continue;
                }
                donneesDepartement = donneesDepartements[numeroDepartement];

                var departementCarteDose1 = $('#carteEHPAD1Dose path[data-num="' + numeroDepartement + '"]');
                departementCarteDose1.data("res_couv_tot_dose1", donneesDepartement["aujourdhui"]);
                departementCarteDose1.css("fill", recupererCouleurEHPAD(donneesDepartement["aujourdhui"], tableauValeurs, tableauCouleurs1dose));

                var departementCarteDose2 = $('#carteEHPAD2Doses path[data-num="' + numeroDepartement + '"]');
                departementCarteDose2.data("res_couv_tot_dose2", donneesDepartement["prediction_j7"]);
                departementCarteDose2.css("fill", recupererCouleurEHPAD(donneesDepartement["prediction_j7"], tableauValeurs, tableauCouleurs2doses));
                
                compter_departements(donneesDepartement);
            }
        }

        function recupererCouleurEHPAD(valeur, tableauDonnees, tableauCouleurs) {
            for (i = tableauCouleurs.length - 1; i >= 0; i--) {
                if (i == 0) {
                    return tableauCouleurs[i];
                } else if (valeur >= tableauDonnees[i]) {
                    return tableauCouleurs[i];
                }
            }
            return "#727272";
        }

        function construireLegendesEHPAD(values = [], colors = [], divLegende) {
            content = $('#legendTemplatePre').html();
            values.map((val, idx) => {
                if (val > 0) {
                    content += $('#legendTemplateMid').html().replaceAll("valeur", '> ' + val + ' cas / sem. / 100k. hab.').replaceAll("colorBg", colors[idx]);
                } else {
                    content += $('#legendTemplateMid').html().replaceAll("valeur", '< ' + values[idx + 1] + ' cas');
                }
            });
            content += $('#legendTemplatePost').html();
            divLegende.html(content);
        }


        $('#carteEHPAD1Dose .departement path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = donneesDepartements[departement]["nomDepartement"];

            if ($(this).data("res_couv_tot_dose1")) {
                $('#carteEHPAD1Dose #map title').text(nomDepartement + ' (' + $(this).data("res_couv_tot_dose1").toFixed(1) + ' cas)');
            } else {
                $('#carteEHPAD1Dose #map title').text(nomDepartement + ' : pas de donnée !');
            }

        });

        $('#carteEHPAD2Doses .departement path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = donneesDepartements[departement]["nomDepartement"];

            if ($(this).data("res_couv_tot_dose2")) {
                $('#carteEHPAD2Doses #map title').text(nomDepartement + ' (' + $(this).data("res_couv_tot_dose2").toFixed(1) + ' cas)');
            } else {
                $('#carteEHPAD2Doses #map title').text(nomDepartement + ' : pas de donnée !');
            }
        });

        $('#carteEHPAD1Dose .departement path').click(function (e) {
            numeroDepartement = $(this).data("num");
            nomDepartement = donneesDepartements[departement]["nomDepartement"];

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#' + numeroDepartement).remove();
            } else {
                $('#carte .departement path.selected').removeClass('selected');
                buildLineChart(nomDepartement);
                $(this).addClass('selected');
            }
        });

        $('#carteEHPAD2Doses .departement path').click(function (e) {
            numeroDepartement = $(this).data("num");
            nomDepartement = donneesDepartements[departement]["nomDepartement"];

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#' + numeroDepartement).remove();
            } else {
                $('#carte .departement path.selected').removeClass('selected');
                buildLineChart(nomDepartement);
                $(this).addClass('selected');
            }
        });

    });

    var lineChart;
    function buildLineChart(dep){
        document.getElementById("nom_departement").innerHTML = dep;

        len_to_fill = data_incid["dates"].length - data_incid[dep]["pred_incidence"].length
        var nan_list = []

        for(var i=0; i<len_to_fill; i++){
        nan_list.push(NaN);
        }
        if (selected_departement != "") {
        lineChart.destroy();
        }

        selected_departement = dep
        
        var ctx = document.getElementById('lineCasChart').getContext('2d');

        lineChart = new Chart(ctx, { 
            type: 'line',
            data: {
                labels: data_incid["dates"],
                datasets: [{
                    label: 'Taux d\'incidence',
                    data: data_incid[dep]["incidence"],
                    borderWidth: 3,
                    backgroundColor: 'rgba(51, 113, 185, 0.3)',
                    borderColor: 'rgba(51, 113, 185, 0.8)'
                },
                {
                    label: 'Projection taux d\'incidence',
                    data: nan_list.concat(data_incid[dep]["pred_incidence"]),
                }]
            },
            options: {
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
                        {
                        drawTime: "afterDatasetsDraw",
                        id: "hline",
                        type: "line",
                        mode: "horizontal",
                        borderDash: [2, 2],
                        scaleID: "y-axis-0",
                        value: 50,
                        borderColor: "red",
                        borderWidth: 3,
                        label: {
                            backgroundColor: "red",
                            content: "Seuil d'alerte",
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
</script>