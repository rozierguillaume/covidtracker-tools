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

    jQuery(document).ready(function ($) {

        var donneesDepartementsVaccination;
        var typeCarteDepartement = 'n_dose1_cumsum_pop';
        var dateMaj = "";

        var tableauValeurs = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90]

        var tableauCouleurs = [
            "#cfdde6",
            "#b8d4e6",
            "#a1cbe6",
            "#8ac2e6",
            "#73bae6",
            "#5cb1e6",
            "#45a8e6",
            "#2e9fe6",
            "#1796e6",
            "#0076bf"
        ];

        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-dep.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                donneesDepartementsVaccination = json;
                colorerCarte()
            });

        function computeMean() {
            let total = 0;
            let count = 0;
            for (numeroDepartement in donneesDepartementsVaccination) {
                if (numeroDepartement == 'departements') {
                    continue;
                }
                total += donneesDepartementsVaccination[numeroDepartement]["n_dose1_cumsum_pop"];
                count++;
            }
            return total/count;
        }

        function computeMedian() {
            let percentages = [];
            for (numeroDepartement in donneesDepartementsVaccination) {
                if (numeroDepartement == 'departements') {
                    continue;
                }
                percentages.push(donneesDepartementsVaccination[numeroDepartement]["n_dose1_cumsum_pop"]);
            }
            percentages = percentages.sort();
            let len = percentages.length;
            let mid = Math.ceil(len/2);
            let median = len % 2 === 0 ? (percentages[mid] + percentages[mid -1]) /2 : percentages[mid -1];
            return median;
        };

        //from Picomath
        function erf(x) {
            // constants
            var a1 =  0.254829592;
            var a2 = -0.284496736;
            var a3 =  1.421413741;
            var a4 = -1.453152027;
            var a5 =  1.061405429;
            var p  =  0.3275911;

            // Save the sign of x
            var sign = 1;
            if (x < 0) {
                sign = -1;
            }
            x = Math.abs(x);

            // A&S formula 7.1.26
            var t = 1.0/(1.0 + p*x);
            var y = 1.0 - (((((a5*t + a4)*t) + a3)*t + a2)*t + a1)*t*Math.exp(-x*x);

            return sign*y;
        }

        function computeDeciles() {
            let percentages = [];
            for (numeroDepartement in donneesDepartementsVaccination) {
                if (numeroDepartement == 'departements') {
                    continue;
                }
                percentages.push(donneesDepartementsVaccination[numeroDepartement]["n_dose1_cumsum_pop"]);
            }
            percentages = percentages.sort();

            let tableauValeurs = []
            tableauValeurs.push(Math.floor(percentages[0]));
            for(let i = 1; i <= 9; i++){
                let y = percentages[Math.round(percentages.length / 10.0 * i)];
                let nbDec = 0;
                while(floorDec(y, nbDec) < tableauValeurs[0] || nbDec > 2) {
                    nbDec += 1;
                }
                tableauValeurs.push(floorDec(y, nbDec));
            }
            return tableauValeurs;
        };

        function floorDec(val, n) {
            let tenPowN = Math.pow(10, n);
            return Math.floor(val * tenPowN) / tenPowN;
        };

        function computeGaussScale() {
            let tableauValeurs = []
            tableauValeurs.push(0);
            let median = computeMedian();
            for(let i = 1; i <= 8; i++){
                let y = 0.5 + 0.5 * erf((i/13-median/130)/Math.sqrt(2));
                tableauValeurs.push(Math.floor(y *100));
            }
            tableauValeurs.push(90);
            return tableauValeurs;
        };

        function colorerCarte() {
            pourcentage = false;
            plus = "+";
            vaccination = false;

           if (typeCarteDepartement == 'n_dose1_cumsum_pop') {
                nomDonnee = "n_dose1_cumsum_pop";
                pourcentage = true;
                plus = "";
            } else {
                $('#carte path').css("fill", "#c4c4cb");
                return;
            }

           tableauValeurs = computeDeciles();

            construireLegende(tableauValeurs, tableauCouleurs, true);

            for (numeroDepartement in donneesDepartementsVaccination) {
                if (numeroDepartement == 'departements'){
                    continue;
                }
                donneesDepartement = donneesDepartementsVaccination[numeroDepartement];
                var departementCarte = $('#carte path[data-num="' + numeroDepartement + '"]');
                //Affectation de la valeur de la donnée du département à sa représentation sur la carte. .
                departementCarte.data(nomDonnee, donneesDepartement[nomDonnee]);
                //Coloration du département sur la carte. .
                departementCarte.css("fill", recupererCouleur(donneesDepartement[nomDonnee], tableauValeurs, tableauCouleurs));
            }
        }

        function construireLegende(values = [], colors = [], pourcentage = false) {
            content = $('#legendTemplatePre').html();
            values.map((val, idx) => {
                if (pourcentage) {
                    if (val == ">") {
                        caseLegende = $('#legendTemplateMid').html()
                            .replaceAll("valeur", '> ' + plus + values[idx+1] + ' %')
                            .replaceAll("colorBg", colors[idx])
                            .replaceAll('idxval', idx);
                    } else if (val > 0) {
                        caseLegende = $('#legendTemplateMid').html()
                            .replaceAll("valeur", '> ' + plus + val + ' %')
                            .replaceAll("colorBg", colors[idx])
                            .replaceAll('idxval', idx);
                    } else {
                        caseLegende = $('#legendTemplateMid').html()
                            .replaceAll("valeur", val + ' %')
                            .replaceAll("colorBg", colors[idx])
                            .replaceAll('idxval', idx);
                    }
                } else {
                    caseLegende = $('#legendTemplateMid').html()
                        .replaceAll("valeur", '< ' + val)
                        .replaceAll("colorBg", colors[idx])
                        .replaceAll('idxval', idx);
                }
                if (colors[idx]=='#cfdde6'){
                    caseLegende = caseLegende.replaceAll("white", "#304b61");
                }
                content += caseLegende;
            });
            content += $('#legendTemplatePost').html();
            $('#legendeCarte').html(content);
        }

        function recupererCouleur(valeur, tableauDonnees, tableauCouleurs) {
            for (i = tableauCouleurs.length - 1; i >= 0; i--) {
                if (i == 0) {
                    return tableauCouleurs[i];
                } else if (valeur >= tableauDonnees[i]) {
                    return tableauCouleurs[i];
                }
            }
            return "#727272";
        }

        var dateMajRec = "";

        function afficherDepartement(nomDepartement, numeroDepartement) {

            $('.departement-detail').remove();
            donneesVaccinationDepartement = donneesDepartementsVaccination[numeroDepartement];
            donneesJournalieresDepartement = donneesVaccinationDepartement['n_dose1_cumsum'];
            datesJours = donneesVaccinationDepartement['dates'];
            vaccinesDepartement = donneesJournalieresDepartement[donneesJournalieresDepartement.length-1];
            vaccinesDepartementPop = donneesVaccinationDepartement['n_dose1_cumsum_pop'];
            vaccinesDepartement = numberWithSpaces(vaccinesDepartement);

            dateMaj = datesJours[datesJours.length-1]
            let fullDate = new Date(dateMaj);
            // let fullDateRec = new Date(dateMajRec);

            if (vaccinesDepartement <= 0) {
                vaccinesDepartement = "--";
            }

            if ($('#' + numeroDepartement).length > 0) {
                return;
            }

            content = $('#departementTemplate').html();
            content = content.replace(/nomDepartement/g, nomDepartement);
            content = content.replace(/numeroDepartement/g, numeroDepartement);
            content = content.replace(/vaccinesDepartement/g, vaccinesDepartement);
            content = content.replace(/vaccinesPopReg/g, vaccinesDepartementPop);

            content = content.replace(/dateMajDoses/g, parseInt(fullDate.getDate()).addZero() + '/' + (fullDate.getMonth() + 1).addZero());

            $('#donneesDepartements').prepend(content);
            let datasets = [{
                label: 'Vaccinés (1 ou 2 doses) - ' + nomDepartement,
                // data: vaccinesDepartementsHistorique[numeroDepartement].map(val => val.vaccines),
                data: donneesJournalieresDepartement,
                borderWidth: 3,
                backgroundColor: 'rgba(0, 168, 235, 0.5)',
                borderColor: 'rgba(0, 168, 235, 1)',
                cubicInterpolationMode: 'monotone'
            }
            ];
            let labels = datesJours;
            $('#departement-graphique-detail').show();
            createDepartementChart(labels, datasets);
        }

        function createDepartementChart(labels, datasets) {
            let chart = document.getElementById('chartDepartementDetail');
            // Graphique courbe d'un département
            var lineChartDepartement = new Chart(chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    maintainAspectRatio: false,
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
                                display: false
                            },
                            ticks: {
                                min: 0
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
                                callback: function (value, index, values) {
                                    return value.slice(8) + "/" + value.slice(5, 7);
                                }
                            }

                        }]
                    },
                    annotation: {
                        events: ["click"],
                        annotations: []
                    }
                }
            });
        }
        
        $('body').on('click', '.masquerDepartement', function (e) {
            e.preventDefault();
            numeroDepartement = $(this).parents('.departement-detail').data("num");
            // $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
            $('#map path[data-code_insee=' + numeroDepartement + ']').removeClass('selected');
            // $("#listeDepartements").trigger('change');
            $('#' + numeroDepartement).remove();
            $('#departement-general').show();
            $('#departement-graphique-detail').hide();
        });

        $('#carte .departement path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
            if (typeCarteDepartement == 'n_dose1_cumsum_pop') {
                $('#carte #map title').text(nomDepartement + ' (' + $(this).data("n_dose1_cumsum_pop").toFixed(2) + ')');
            } else {
                $('#carte #map title').text(nomDepartement);
            }
        });

        $('#carte .departement path').click(function (e) {
            numeroDepartement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#' + numeroDepartement).remove();
            } else {
                $('#carte .departement path.selected').removeClass('selected');
                afficherDepartement(nomDepartement, numeroDepartement);
                $(this).addClass('selected');
            }
        });

        //surlignage des dep au survol de la légende
        $("#legendeCarte").on({
            mouseenter: function(e){
                let idx= parseInt($(this).data('idx'));
                let value = tableauValeurs[idx];
                let borneinf, bornesup;
                if (idx == tableauValeurs.length -1) {
                    bornesup = Infinity;
                    borneinf = tableauValeurs[idx];
                } else {
                    borneinf = value;
                    bornesup = tableauValeurs[idx+1];
                }
                $('#carte').find('svg path').filter(function(){
                    let val = $(this).data('n_dose1_cumsum_pop');
                    return val >= borneinf && val <= bornesup;
                }).css({"stroke-width": '2.6', 'stroke': 'yellow'});
            },
            mouseleave: function(e){
                $('#carte').find('svg path').css({'stroke-width': '', 'stroke': ''});
            }
        }, '.legendValue');

    });
</script>


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
