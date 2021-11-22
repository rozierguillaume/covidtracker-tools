<script>
    jQuery(document).ready(function ($) {
            $('.dropdown-toggle').dropdown();

            var valeurs_cas = [">", "400", "250", "150", "50"];
            var couleurs_cas = ["purple", "#3c0000", "#c80000", "#f95228", "#98ac3b"];

            var valeurs_n_dose1_cumsum_pop = [">", "82", "79", "76", "73", "69", "66", "60", "50", "30"];
            //var couleurs_n_dose1_cumsum_pop = ["#98ac3b", "#3c0000", "#c80000", "#f95228"];
            var couleurs_n_dose1_cumsum_pop = [
                "#0076bf", "#148dd9", "#2e9fe6", "#45a8e6", "#5cb1e6",
                "#73bae6", "#8ac2e6", "#a1cbe6", "#b8d4e6", "#cfdde6"]

            var valeurs_cas_12_couleurs = [">", "500", "450", "400", "350", "300", "250", "200", "150", "100", "75", "50", "25"];
            var couleurs_cas_12_couleurs = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_positivite_restreint = ["> 13", "13", "10", "7", "4", "1"];
            var couleurs_positivite_restreint = ['black', '#6a0000', '#c40001', '#f50e07', '#fb9449', '#118408'];

            var valeurs_var_c1 = ["100", "82", "74", "66", "58", "50", "42", "34", "26", "18", "10", "2"]//["100", "95", "90", "85", "80", "75", "70", "65", "60", "55", "45", "40"];
            var couleurs_var_c1 = ['#00004d', '#17175a', '#292b68', '#393f76', '#475484', '#566a92', '#6680a0', '#7696ae', '#88adbd', '#9cc4cb', '#b5dada', '#e9e9e9']//['#000f5c', '#162169', '#263376', '#334683', '#405990', '#4d6d9d', '#5a80a9', '#6995b5', '#79a9c0', '#8dbdcb', '#a5d1d3', '#dedecc']//['#00429d', '#2250a4', '#345eaa', '#436db0', '#507cb7', '#5e8bbd', '#6b9ac2', '#78a9c8', '#87b9cd', '#97c8d1', '#aad7d4', '#dedecc']//['#00429d', '#2552a5', '#3863ad', '#4874b4', '#5786bc', '#6497c4', '#72a9cc', '#80bbd5', '#90cedd', '#a0e0e6', '#b5f1f0', '#d8ffff']

            var valeurs_evolution = [">", "40", "30", "20", "10", "5", "0", "-5", "-10", "-20", "-30", "-40", "-50"];
             var couleurs_evolution = ['#93003a', '#bb1d4b', '#d84560', '#ec6e77', '#f79792', '#f8c2af', '#ededce', '#a8d6d4', '#87b8cc', '#6b9ac2', '#517bb6', '#345eaa', '#00429d'];

        var valeurs_comparaison = [">", "20", "15", "10", "5", "2", "-2", "-5", "-10", "-15", "-20", "-30"];
        var couleurs_comparaison = [
            "#0076bf", "#2e9fe6", "#5cb1e6", "#8ac2e6", "#b8d4e6",
            "#e1eff8",
            "#fbd763","#fb9449","#fb633b","#f50e07","#6a0000","#4c0000", "#000"];


        var valeurs_hosp = [">", "50", "45", "40", "35", "30", "25", "20", "15", "10", "9", "6", "3"];
            var valeurs_lits_hosp = [">", "90", "80", "70", "60", "50", "40", "30", "25", "20", "15", "10", "5"];
            var couleurs_hosp = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_positivite = [">", "25", "20", "15", "12", "10", "8", "6", "5", "4", "3", "2", "1"];
            var couleurs_positivite = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_rea = [">", "10", "8", "6", "5", "4", "3", "2.5", "2", "1.5", "1", "0.5", "0.25"];
            var valeurs_lits_rea = [">", "25", "20", "17.5", "15", "12.5", "10", "7.5", "5", "4", "3", "2", "1"];
            var couleurs_rea = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_saturation_rea = [">", "300", "250", "200", "180", "150", "120", "100", "80", "60", "40", "20", "10"];
            var couleurs_saturation_rea = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var valeurs_dc = [">", "12", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1"];
            var couleurs_dc = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

            var donneesDepartements;
            var donneesDepartementsVaccination;
            var donneesFrance;
            var dateMaj;
            var typeCarte = 'incidence-cas';
            var tableauValeurs;
            var nomDonnee;
            var nb_vaccines = [];
            var dejaVaccines = 0;
            var proportionVaccines1doseFrance = 0;

            fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-dep.json')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    return response.json();
                })
                .then(json => {
                    donneesDepartementsVaccination = json;
                    fetchOtherData();

                });
            
                fetch('https://raw.githubusercontent.com/CovidTrackerFr/data-utils/main/vaccination-ameli/data/output/donnees-vaccination-par-tranche-dage-type-de-vaccin-et-departement.json')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    return response.json();
                })
                .then(json => {
                    donneesVaccinationAmeli = json;
                    fetchOtherData();

                });

            function fetchOtherData() {
                fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/incidence_departements.json')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("HTTP error " + response.status);
                        }
                        return response.json();
                    })
                    .then(json => {

                        donneesDepartements = json['donnees_departements'];
                        donneesFrance = json['donnees_france'];
                        dateMaj = json["date_update"];
                        dateDepistage = json["date_donnees"]
                        colorerCarte();
                        selectionnerDepartement();
                    });


                // Get data from health ministry csv
                fetch('https://raw.githubusercontent.com/rozierguillaume/vaccintracker/main/data/output/vacsi-fra.json', {cache: 'no-cache'}) //https://www.data.gouv.fr/fr/datasets/r/b234a041-b5ea-4954-889b-67e64a25ce0d
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("HTTP error " + response.status);
                        }
                        return response.json();
                    })
                    .then(json => {

                        this.data = json;
                        console.log (this.data);

                        //console.log(json)
                        data["dates"].map((value, idx) => {
                            nb_vaccines.push({
                                date: value,
                                heure: "",
                                total: 0,
                                n_dose1: data["n_cum_dose1"][idx],
                                source: "Ministère de la santé"
                            });
                        })

                        nb_vaccines = nb_vaccines.filter((v, i, a) => a.findIndex(t => (t.date == v.date)) === i); // suppression doublons
                        nb_vaccines = nb_vaccines.sortBy('date'); // tri par date
                        dejaVaccinesNb = nb_vaccines[nb_vaccines.length - 1].n_dose1
                        dejaVaccines = dejaVaccinesNb * 100 / 67000000;
                        proportionVaccines1doseFrance = (Math.round(dejaVaccines * 10000000) / 10000000).toFixed(2);


                    })
                    .catch(function () {
                            this.dataError = true;
                            console.log("error4")
                        }
                    )

            }

            function construireLegende(values = [], colors = [], pourcentage = false, pourcentage_abs = false) {
                content = $('#legendTemplatePre').html();
                values.map((val, idx) => {
                    if (pourcentage) {
                        if (val == '>') {
                            caseLegende = $('#legendTemplateMid').html()
                                .replaceAll("valeur", "> " + plus + values[idx + 1] + ' %')
                                .replaceAll("colorBg", colors[idx])
                                .replaceAll("index", idx);
                        } else if (val > 0) {
                            caseLegende = $('#legendTemplateMid').html()
                                .replaceAll("valeur", '< ' + plus + val + ' %')
                                .replaceAll("colorBg", colors[idx])
                                .replaceAll("index", idx);
                        } else {
                            caseLegende = $('#legendTemplateMid').html()
                                .replaceAll("valeur", '< ' + val + ' %')
                                .replaceAll("colorBg", colors[idx])
                                .replaceAll("index", idx);
                        }
                    } else if (pourcentage_abs) {
                        caseLegende = $('#legendTemplateMid').html()
                            .replaceAll("valeur", val + " %")
                            .replaceAll("colorBg", colors[idx])
                            .replaceAll("index", idx);
                    } else {
                        if (val == '>') {
                            caseLegende = $('#legendTemplateMid').html()
                                .replaceAll("valeur", val + ' ' + values[idx + 1])
                                .replaceAll("colorBg", colors[idx])
                                .replaceAll("index", idx);
                        } else {
                            caseLegende = $('#legendTemplateMid').html()
                                .replaceAll("valeur", "< " + val)
                                .replaceAll("colorBg", colors[idx])
                                .replaceAll("index", idx);
                        }
                    }
                    if (colors[idx] == '#ededce') {
                        caseLegende = caseLegende.replaceAll("white", "#304b61");
                    }
                    content += caseLegende;
                })

                content += $('#legendTemplatePost').html();
                $('#legendeCarte').html(content);
            }

            function recupererCouleur(valeur, tableauDonnees, tableauCouleurs) {
                for (i = tableauCouleurs.length - 1; i >= 0; i--) {
                    if (i == 0) {
                        return tableauCouleurs[i];
                    } else if (valeur <= tableauDonnees[i]) {
                        return tableauCouleurs[i];
                    }
                }
                return "#c4c4cb";
            }

            function colorerCarte() {
                pourcentage = false;
                pourcentage_abs = false;
                plus = "+";
                vaccination = false;
                if (typeCarte == 'incidence-cas') {
                    $('#titreCarte').html("<h3>Taux d'incidence</h3>");
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants");
                    tableauValeurs = valeurs_cas;
                    tableauCouleurs = couleurs_cas;
                    nomDonnee = "incidence_cas";
                } else if (typeCarte == 'incidence-cas-12-couleurs') {
                    $('#titreCarte').html("<h3>Taux d'incidence</h3>");
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants");
                    tableauValeurs = valeurs_cas_12_couleurs;
                    tableauCouleurs = couleurs_cas_12_couleurs;
                    nomDonnee = "incidence_cas";
                } else if (typeCarte == 'var_c1') {
                    $('#titreCarte').html("<h3>Proportion de mutation L452R (Delta)</h3>");
                    $('#descriptionCarte').html("Proportion des cas criblés ayant la mutation L452R, présente sur le variant Delta (en %)");
                    tableauValeurs = valeurs_var_c1;
                    tableauCouleurs = couleurs_var_c1;
                    nomDonnee = "var_c1";
                    pourcentage_abs = true;
                } else if (typeCarte == 'evolution-cas') {
                    $('#titreCarte').html("<h3>Évolution du nombre de cas sur 7 jours</h3>");
                    $('#descriptionCarte').html("Lecture : du rouge signifie une augmentation du nombre de cas cette semaine par rapport à la semaine précédente");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_evol";
                    pourcentage = true;
                } else if (typeCarte == 'taux-positivite') {
                    $('#titreCarte').html("<h3>Taux de positivité</h3>");
                    $('#descriptionCarte').html("Proportion des tests positifs cette semaine");
                    tableauValeurs = valeurs_positivite;
                    tableauCouleurs = couleurs_positivite;
                    nomDonnee = "taux_positivite";
                    pourcentage_abs = true;
                } else if (typeCarte == 'taux-positivite-restreint') {
                    $('#titreCarte').html("<h3>Taux de positivité</h3>");
                    $('#descriptionCarte').html("Proportion des tests positifs cette semaine");
                    tableauValeurs = valeurs_positivite_restreint;
                    tableauCouleurs = couleurs_positivite_restreint;
                    nomDonnee = "taux_positivite";
                    pourcentage_abs = true;
                } else if (typeCarte == 'incidence-hospitalisations') {
                    $('#titreCarte').html("<h3>Admissions à l'hôpital</h3>");
                    $('#descriptionCarte').html("pour Covid19, cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "incidence_hosp";
                } else if (typeCarte == 'lits-hospitalisations') {
                    $('#titreCarte').html("<h3>Nombre de lits occupés à l'hôpital</h3>");
                    $('#descriptionCarte').html("pour Covid19 et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_hosp";
                } else if (typeCarte == 'evolution-lits-hospitalisations') {
                    $('#titreCarte').html("<h3>Évolution du nombre de lits occupés sur 7 jours</h3>");
                    $('#descriptionCarte').html("Lecture : du rouge signifie une augmentation du nombre de lits occupés par des patients Covid19 à l'hôpital cette semaine par rapport à la semaine précédente");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_hosp_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-deces') {
                    $('#titreCarte').html("<h3>Nombre de décès hospitaliers</h3>");
                    $('#descriptionCarte').html("avec Covid19, cette semaine et pour 100k habitants");
                    tableauValeurs = valeurs_dc;
                    tableauCouleurs = couleurs_dc;
                    nomDonnee = "incidence_dc";
                } else if (typeCarte == 'evolution-deces') {
                    $('#titreCarte').html("<h3>Évolution des décès hospitaliers sur 7 jours</h3>");
                    $('#descriptionCarte').html("avec Covid19, sur la dernière semaine par rapport à la semaine précédente");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_dc_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-reanimations') {
                    $('#titreCarte').html("<h3>Admissions à l'hôpital</h3>");
                    $('#descriptionCarte').html("pour Covid19, cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_rea;
                    tableauCouleurs = couleurs_rea;
                    nomDonnee = "incidence_rea";
                } else if (typeCarte == 'saturation-reanimations') {
                    $('#titreCarte').html("<h3>Taux d'occupation des lits de réanimation</h3>");
                    $('#descriptionCarte').html("proportion des lits de réanimation occupés uniquement par les patients Covid19");
                    tableauValeurs = valeurs_saturation_rea;
                    tableauCouleurs = couleurs_saturation_rea;
                    nomDonnee = "saturation_rea";
                } else if (typeCarte == 'lits-reanimations') {
                    $('#titreCarte').html("<h3>Nombre de lits de réanimation occupés</h3>");
                    $('#descriptionCarte').html("pour Covid10 et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_rea;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_rea";
                } else if (typeCarte == 'evolution-lits-reanimations') {
                    $('#titreCarte').html("<h3>Évolution des lits de réanimation occupés sur 7 jours</h3>");
                    $('#descriptionCarte').html("Lecture : du rouge signifie une augmentation du nombre de lits de réanimation occupés par des patients Covid19 cette semaine par rapport à la semaine précédente");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_rea_evol";
                    pourcentage = true;
                } else if (typeCarte == 'n_dose1_cumsum_pop') {
                    $('#titreCarte').html("<h3>Proportion population partiellement vaccinée</h3>");
                    $('#descriptionCarte').html("Proportion de la population ayant reçu au moins une dose de vaccin");
                    tableauValeurs = valeurs_n_dose1_cumsum_pop;
                    tableauCouleurs = couleurs_n_dose1_cumsum_pop;
                    nomDonnee = "n_dose1_cumsum_pop";
                    pourcentage = true;
                    vaccination = true;
                    plus = "";
                } else if (typeCarte == 'n_dose1_comparaison') {
                    $('#titreCarte').html("<h3>Comparaison population partiellement vaccinée</h3>");
                    $('#descriptionCarte').html("Ecart en points de la population ayant reçu une dose par rapport à la moyenne nationale : "+proportionVaccines1doseFrance+" %");
                    tableauValeurs = valeurs_comparaison;
                    tableauCouleurs = couleurs_comparaison;
                    nomDonnee = "n_dose1_comparaison";
                    pourcentage = false;
                    vaccination = true;
                    plus = "";
                } else {
                    $('#carte path').css("fill", "#c4c4cb");
                    return;
                }

                construireLegende(tableauValeurs, tableauCouleurs, pourcentage, pourcentage_abs);

                $('#dateCarte').html(dateMaj)

                for (departement in donneesDepartements) {
                    // console.log(departement);
                    //Récupération du numéor de département à partir de la select.
                    numeroDepartement = $('#listeDepartements option[value="' + departement + '"]').data("num");
                    // console.log(numeroDepartement);

                    //Récupération des données du département.
                    if (vaccination == true) {
                        donneesDepartement['numeroDepartement'] = numeroDepartement;
                        donneesDepartement = donneesDepartementsVaccination[numeroDepartement];
                        donneesDepartement['n_dose1_comparaison'] = donneesDepartement['n_dose1_cumsum_pop']-proportionVaccines1doseFrance;
                    } else {
                        donneesDepartement = donneesDepartements[departement];
                    }
                    // console.log(donneesDepartement);
                    //Affectation du numéro de département à sa représentation sur la carte. .
                    var departementCarte = $('#carte path[data-num="' + numeroDepartement + '"]');
                    //Affectation de la valeur de la donnée du département à sa représentation sur la carte. .
                    departementCarte.data(nomDonnee, donneesDepartement[nomDonnee]);

                    //Coloration du département sur la carte. .
                    departementCarte.css("fill", recupererCouleur(donneesDepartement[nomDonnee], tableauValeurs, tableauCouleurs));
                }
            }

            function selectionnerDepartement() {
                if ($("#departementSearched").length > 0) {
                    nomDepartement = $("#departementSearched").text();
                    numeroDepartement = $('#listeDepartements option[value="' + nomDepartement + '"]').data("num");
                    if (numeroDepartement) {
                        $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');
                        if ($("#listeDepartements").val()) {
                            $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                        } else {
                            $("#listeDepartements").val(nomDepartement);
                        }
                        $("#listeDepartements").trigger('change');
                        afficherDepartement(nomDepartement, numeroDepartement);
                        $('html,body').animate({scrollTop: $('#donneesDepartements').offset().top - 80}, 2000);
                    }
                } else if ($("#numeroDepartementSearched").length > 0) {
                    numeroDepartement = $("#numeroDepartementSearched").text();
                    nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
                    if (numeroDepartement) {
                        $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');
                        if ($("#listeDepartements").val()) {
                            $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                        } else {
                            $("#listeDepartements").val(nomDepartement);
                        }
                        $("#listeDepartements").trigger('change');
                        afficherDepartement(nomDepartement, numeroDepartement);
                        $('html,body').animate({scrollTop: $('#donneesDepartements').offset().top - 80}, 2000);
                    }
                }
            }

            function afficherDepartement(nomDepartment, numeroDepartement) {
                // console.log(donneesDepartements[nomDepartement]);
                incidenceDepartement = donneesDepartements[nomDepartement]["incidence_cas"];
                saturationRea = Math.round(donneesDepartements[nomDepartement]["saturation_rea"]);
                tauxPositivite = donneesDepartements[nomDepartement]["taux_positivite"];
                n_dose1_cumsum_pop = donneesVaccinationAmeli[numeroDepartement]["taux_cumu_1_inj"];
                incidenceFrance = Math.round(donneesFrance["incidence_cas"]);
                dateMajVaccination = donneesVaccinationAmeli[numeroDepartement]["dates"][donneesVaccinationAmeli[numeroDepartement]["dates"].length - 1]

                if (incidenceDepartement > 100) {
                    couleurIncidence = "red";
                } else if (incidenceDepartement > 50) {
                    couleurIncidence = "orange";
                } else {
                    couleurIncidence = "green";
                }

                if (saturationRea > 80) {
                    couleurSaturationRea = "red";
                } else if (saturationRea > 30) {
                    couleurSaturationRea = "orange";
                } else {
                    couleurSaturationRea = "green";
                }

                if (tauxPositivite >= 5) {
                    couleurTauxPositivite = "red";
                } else if (tauxPositivite >= 1) {
                    couleurTauxPositivite = "orange";
                } else {
                    couleurTauxPositivite = "green";
                }

                if ($('#' + numeroDepartement).length > 0) {
                    return;
                }
                content = $('#departementTemplate').html();
                content = content.replaceAll('nomDepartement', nomDepartment);
                content = content.replaceAll('numeroDepartement', numeroDepartement);
                content = content.replaceAll('incidenceDepartement', incidenceDepartement);
                content = content.replaceAll('incidenceFrance', incidenceFrance);
                content = content.replaceAll('saturationRea', saturationRea + "%");
                content = content.replaceAll('tauxPositivite', tauxPositivite + "%");
                content = content.replaceAll('n_dose1_cumsum_pop', n_dose1_cumsum_pop + "%");
                content = content.replaceAll('dateMaj', dateMaj);
                content = content.replaceAll('dateTauxIncidence', dateDepistage+" (J-3)");
                content = content.replaceAll('dateVaccinationMaj', dateMajVaccination);
                content = content.replaceAll('couleurIncidence', couleurIncidence);
                content = content.replaceAll('couleurSaturationRea', couleurSaturationRea);
                content = content.replaceAll('couleurTauxPositivite', "black");

                $('#donneesDepartements').prepend(content);
                //trierDepartements();
                $("#map").removeClass("animated");
                setTimeout(function () {
                    $("#map").addClass("animated");
                }, 100);
            }

            function trierDepartements() {
                $divs = jQuery("#donneesDepartements div.departement");

                alphabeticallyOrderedDeps = $divs.sort(function (a, b) {
                    return String.prototype.localeCompare.call($(a).data('num'), $(b).data('num'));
                });

                $("#donneesDepartements").html(alphabeticallyOrderedDeps);
            }

            $('.select2').select2({
                placeholder: 'Sélectionnez les départements que vous voulez consulter....',
                closeOnSelect: false,
            });

            $('.select2').val(null).trigger('change');

            $('div.departement').addClass('hidden');

            $('.select2').on('select2:select', function (e) {
                nomDepartement = e.params.data.id;
                numeroDepartement = e.params.data.element.dataset.num;
                $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');
                // $('#' + nomDepartement).parent().removeClass('hidden');
                afficherDepartement(nomDepartement, numeroDepartement);
            });

            $('.select2').on('select2:unselect', function (e) {
                nomDepartement = e.params.data.id;
                numeroDepartement = e.params.data.element.dataset.num;
                $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
                $('#' + numeroDepartement).remove();
            });

            $('#unselectAll').click(function () {
                $("#listeDepartements option").each(function () {
                    $(this).prop('selected', false);
                });
                $("#listeDepartements").trigger('change');
                $('path.departement').remove();
                $('div.departement').remove();
                $('#map path').removeClass('selected');
            });

            $('body').on('click', '.masquerDepartement', function (e) {
                e.preventDefault();
                numeroDepartement = $(this).parents('.departement').data("num");
                $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
                $("#listeDepartements").trigger('change');
                $('#' + numeroDepartement).remove();
            });

            $('#selectAll').click(function () {

                //Sélection des toutes les options du select.
                $("#listeDepartements option").each(function () {
                    nomDepartement = $(this).val();
                    if (!$(this).prop('selected')) {
                        $(this).prop('selected', true);
                        if ($("#listeDepartements").val()) {
                            $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                        } else {
                            $("#listeDepartements").val(nomDepartement);
                        }
                        afficherDepartement(nomDepartement, $(this).data("num"));
                        trierDepartements();
                    }
                });
                $("#listeDepartements").trigger('change');
                //Sélection des toutes les régions de la carte.
                $('#map path:not(.separator)').addClass('selected');
            });

            $('#carte path').hover(function (e) {
                departement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
                if (typeCarte == 'incidence-cas' || typeCarte == 'incidence-cas-12-couleurs') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_cas") + ')');
                } else if (typeCarte == 'evolution-cas') {
                    signe = '';
                    if ($(this).data("incidence_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution cas : ' + signe + $(this).data("incidence_evol") + '%)');
                } else if (typeCarte == 'taux-positivite') {
                    $('#carte #map title').text(nomDepartement + ' (taux positivité : ' + $(this).data("taux_positivite").toFixed(2) + ' %)');
                } else if (typeCarte == 'taux-positivite-restreint') {
                    $('#carte #map title').text(nomDepartement + ' (taux positivité : ' + $(this).data("taux_positivite").toFixed(2) + ' %)');
                } else if (typeCarte == 'var_c1') {
                    $('#carte #map title').text(nomDepartement + ' (mutations dont Delta : ' + $(this).data("var_c1").toFixed(2) + ' %)');
                } else if (typeCarte == 'n_dose1_cumsum_pop') {
                    $('#carte #map title').text(nomDepartement + ' (' + $(this).data("n_dose1_cumsum_pop").toFixed(2) + ' %)');
                } else if (typeCarte == 'n_dose1_comparaison') {
                    signe = '';
                    if ($(this).data("n_dose1_comparaison") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' ('+ signe + $(this).data("n_dose1_comparaison").toFixed(1) + ' points)');
                } else if (typeCarte == 'incidence-hospitalisations') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_hosp").toFixed(2) + ')');
                } else if (typeCarte == 'lits-hospitalisations') {
                    $('#carte #map title').text(nomDepartement + ' (lits occupés : ' + $(this).data("lits_hosp").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-lits-hospitalisations') {
                    signe = '';
                    if ($(this).data("lits_hosp_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution lits occupés : ' + signe + $(this).data("lits_hosp_evol") + '%)');
                } else if (typeCarte == 'incidence-deces') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_dc").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-deces') {
                    signe = '';
                    if ($(this).data("incidence_dc_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution décès : ' + signe + $(this).data("incidence_dc_evol").toFixed(2) + '%)');
                } else if (typeCarte == 'incidence-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_rea").toFixed(2) + ')');
                } else if (typeCarte == 'saturation-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (taux occupation : ' + $(this).data("saturation_rea").toFixed(0) + '%)');
                } else if (typeCarte == 'lits-reanimations') {
                    $('#carte #map title').text(nomDepartement + ' (lits réa occupés : ' + $(this).data("lits_rea").toFixed(2) + ')');
                } else if (typeCarte == 'evolution-lits-reanimations') {
                    signe = '';
                    if ($(this).data("lits_rea_evol") > 0) {
                        signe = '+';
                    }
                    $('#carte #map title').text(nomDepartement + ' (evolution lits réa occupés : ' + signe + $(this).data("lits_rea_evol") + '%)');
                } else {
                    $('#carte #map title').text(nomDepartement);
                }
            });

            $('#carte path').click(function (e) {
                numeroDepartement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
                if ($(this).hasClass('selected')) {
                    $("#carte path[data-num='" + numeroDepartement + "']").removeClass("selected");
                    $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                    $("#listeDepartements").trigger('change');
                    $('#' + numeroDepartement).remove();
                } else {
                    $("#carte path[data-num='" + numeroDepartement + "']").addClass("selected");
                    // $(this).addClass('selected');
                    if ($("#listeDepartements").val()) {
                        $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                    } else {
                        $("#listeDepartements").val(nomDepartement);
                    }
                    $("#listeDepartements").trigger('change');
                    // $('#' + nomDepartement).parent().removeClass('hidden');
                    afficherDepartement(nomDepartement, numeroDepartement);
                }
            });

            $("#choixTypeCarte li a").click(function (e) {
                e.preventDefault();
                typeCarteChoisi = $(this).parent().data('carte');
                if (typeCarte != typeCarteChoisi) {
                    typeCarte = typeCarteChoisi;
                    $("#choixTypeCarte button.selected").removeClass('selected');
                    $("#choixTypeCarte li a.selected").removeClass('selected');
                    $(this).parents('.btn-group').first().children('button').addClass('selected');
                    $(this).addClass('selected');
                    colorerCarte();
                }
            });

            $("#legendeCarte").on({
                mouseenter: function (e) {
                    let idx = parseInt($(this).data('idx'));
                    let value = tableauValeurs[idx];
                    let borneinf, bornesup;
                    if (value == ">") {
                        bornesup = Infinity;
                        borneinf = tableauValeurs[idx + 1];
                    } else if (idx == tableauValeurs.length - 1) {
                        bornesup = value;
                        borneinf = -Infinity;
                    } else {
                        bornesup = value;
                        borneinf = tableauValeurs[idx + 1];
                    }
                    $("#carte").find('svg path').filter(function () {
                        let val = $(this).data(nomDonnee);
                        return val > borneinf && val <= bornesup;
                    })
                        .css({'stroke': 'yellow', 'stroke-width': '2.6'});
                },
                mouseleave: function (e) {
                    $("#carte").find('svg path').css({'stroke': '', 'stroke-width': ''});
                }
            }, '.legendValue');
        }


    )

    Array.prototype.sortBy = function (p) {
        return this.slice(0).sort(function (a, b) {
            return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
        });
    }
</script>
