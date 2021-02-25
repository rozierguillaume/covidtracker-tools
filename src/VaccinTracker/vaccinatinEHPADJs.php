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

    var donneesDepartementsEhpadVaccination;


    jQuery(document).ready(function ($) {

        var tableauValeurs = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90]

        var tableauCouleurs1dose= [
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

        var tableauCouleurs2doses= [
            "#9cb394",
            "#90b384",
            "#80ae73",
            "#71ab60",
            "#65a950",
            "#56ab3d",
            "#2e9c28",
            "#1c7b21",
            "#116522",
            "#084004"
        ];


        fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-res-tot-dep.json')
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                donneesDepartementsEhpadVaccination = json;
                console.log(donneesDepartementsEhpadVaccination);
                colorationsCartesEHPAD();
            });

        function colorationsCartesEHPAD() {
            pourcentage = true;

            $('#carteEHPAD1Dose path').css("fill", "#c4c4cb");
            $('#carteEHPAD2Doses path').css("fill", "#c4c4cb");

            construireLegendesEHPAD(tableauValeurs, tableauCouleurs1dose, $("#legendeCarteEHPAD1Dose"));
            construireLegendesEHPAD(tableauValeurs, tableauCouleurs2doses, $("#legendeCarteEHPAD2Doses"));

            for (numeroDepartement in donneesDepartementsEhpadVaccination) {
                if (numeroDepartement == '00'){
                    continue;
                }
                donneesDepartement = donneesDepartementsEhpadVaccination[numeroDepartement];

                var departementCarteDose1 = $('#carteEHPAD1Dose path[data-num="' + numeroDepartement + '"]');
                departementCarteDose1.data("res_couv_tot_dose1", donneesDepartement["res_couv_tot_dose1"]);
                departementCarteDose1.css("fill", recupererCouleurEHPAD(donneesDepartement["res_couv_tot_dose1"], tableauValeurs, tableauCouleurs1dose));

                var departementCarteDose2 = $('#carteEHPAD2Doses path[data-num="' + numeroDepartement + '"]');
                departementCarteDose2.data("res_couv_tot_dose2", donneesDepartement["res_couv_tot_dose2"]);
                departementCarteDose2.css("fill", recupererCouleurEHPAD(donneesDepartement["res_couv_tot_dose2"], tableauValeurs, tableauCouleurs2doses));
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
                if (pourcentage && (val != '>')) {
                    if (val > 0) {
                        content += $('#legendTemplateMid').html().replaceAll("valeur", '+ ' + val + ' %').replaceAll("colorBg", colors[idx]);
                    } else {
                        content += $('#legendTemplateMid').html().replaceAll("valeur", val + ' %').replaceAll("colorBg", colors[idx]);
                    }
                } else {
                    content += $('#legendTemplateMid').html().replaceAll("valeur", val).replaceAll("colorBg", colors[idx]);
                }
            });
            content += $('#legendTemplatePost').html();
            divLegende.html(content);
        }


        $('#carteEHPAD1Dose .departement path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
            if ($(this).data("res_couv_tot_dose1")){
                $('#carteEHPAD1Dose #map title').text(nomDepartement + ' (' + $(this).data("res_couv_tot_dose1").toFixed(1) + ' %)');
            } else {
                $('#carteEHPAD1Dose #map title').text(nomDepartement + ' : pas de donnée !');
            }

        });

        $('#carteEHPAD2Doses .departement path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
            if ($(this).data("res_couv_tot_dose2")){
                $('#carteEHPAD2Doses #map title').text(nomDepartement + ' (' + $(this).data("res_couv_tot_dose2").toFixed(1) + ' %)');
            } else {
                $('#carteEHPAD2Doses #map title').text(nomDepartement + ' : pas de donnée !');
            }
        });

    });
</script>