<script>
    jQuery(document).ready(function ($) {
            $('.dropdown-toggle').dropdown();

            var valeurs_cas = [">", "250", "150", "50"];
            var couleurs_cas = ["#3c0000", "#c80000", "#f95228", "#98ac3b"];

            var valeurs_cas_12_couleurs = [">", "500", "450", "400", "350", "300", "250", "200", "150", "100", "75", "50", "25"];
            var couleurs_cas_12_couleurs = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];


            var valeurs_evolution = [">", "40", "30", "20", "10", "5", "0", "-5", "-10", "-20", "-30", "-40", "-50"];
            var couleurs_evolution = [
                "#4c0000",
                "#6a0000",
                "#f50e07",
                "#fb633b",
                "#fb9449",
                "#fbd763",
                "#b1df52",
                "#61c142",
                "#56ab3d",
                "#2e9c28",
                "#1c7b21",
                "#116522",
                "#084004"];


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
            var donneesFrance;
            var dateMaj;
            var typeCarte = 'incidence-cas';

            fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/incidence_departements.json')
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
                    colorerCarte();
                    selectionnerDepartement();
                });

            function construireLegende(values = [], colors = [], pourcentage = false) {
                content = $('#legendTemplatePre').html();
                values.map((val, idx) => {
                    if (pourcentage && (val != '>')) {
                        if (val > 0) {
                            content += $('#legendTemplateMid').html().replaceAll("valeur", '+' + val + ' %').replaceAll("colorBg", colors[idx]);
                        } else {
                            content += $('#legendTemplateMid').html().replaceAll("valeur", val + ' %').replaceAll("colorBg", colors[idx]);
                        }
                    } else {
                        content += $('#legendTemplateMid').html().replaceAll("valeur", val).replaceAll("colorBg", colors[idx]);
                    }
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
                if (typeCarte == 'incidence-cas') {
                    $('#titreCarte').html("Taux d'incidence");
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants");
                    tableauValeurs = valeurs_cas;
                    tableauCouleurs = couleurs_cas;
                    nomDonnee = "incidence_cas";
                } else if (typeCarte == 'incidence-cas-12-couleurs') {
                    $('#titreCarte').html("Taux d'incidence");
                    $('#descriptionCarte').html("Nombre de cas cette semaine pour 100k habitants");
                    tableauValeurs = valeurs_cas_12_couleurs;
                    tableauCouleurs = couleurs_cas_12_couleurs;
                    nomDonnee = "incidence_cas";
                } else if (typeCarte == 'evolution-cas') {
                    $('#titreCarte').html("Évolution du nombre de cas sur les 7 derniers jours");
                    $('#descriptionCarte').html("Lecture : du rouge signifie une augmentation du nombre de cas sur les 7 derniers jours par rapport aux 7 jours précédents");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_evol";
                    pourcentage = true;
                } else if (typeCarte == 'taux-positivite') {
                    $('#titreCarte').html("Taux de positivité");
                    $('#descriptionCarte').html("Proportion des tests positifs cette semaine");
                    tableauValeurs = valeurs_positivite;
                    tableauCouleurs = couleurs_positivite;
                    nomDonnee = "taux_positivite";
                } else if (typeCarte == 'incidence-hospitalisations') {
                    $('#titreCarte').html("Admissions à l'hôpital avec Covid19");
                    $('#descriptionCarte').html("cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "incidence_hosp";
                } else if (typeCarte == 'lits-hospitalisations') {
                    $('#titreCarte').html("Nombre de lits occupés à l'hôpital pour Covid19");
                    $('#descriptionCarte').html("pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_hosp;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_hosp";
                } else if (typeCarte == 'evolution-lits-hospitalisations') {
                    $('#titreCarte').html("Évolution du nombre de lits occupés à l'hôpital pour Covid19 sur les 7 derniers jours");
                    $('#descriptionCarte').html("Du rouge signifie une augmentation du nombre de lits occupés par des patients Covid19 à l'hôpital");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_hosp_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-deces') {
                    $('#titreCarte').html("Nombre de décès avec Covid19");
                    $('#descriptionCarte').html("cette semaine pour 100k habitants.");
                    tableauValeurs = valeurs_dc;
                    tableauCouleurs = couleurs_dc;
                    nomDonnee = "incidence_dc";
                } else if (typeCarte == 'evolution-deces') {
                    $('#titreCarte').html("Évolution du nombre de décès");
                    $('#descriptionCarte').html("sur les 7 derniers jours par rapport aux 7 jours précédents");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "incidence_dc_evol";
                    pourcentage = true;
                } else if (typeCarte == 'incidence-reanimations') {
                    $('#titreCarte').html("Admissions à l'hôpital avec Covid19");
                    $('#descriptionCarte').html("cette semaine et pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_rea;
                    tableauCouleurs = couleurs_rea;
                    nomDonnee = "incidence_rea";
                } else if (typeCarte == 'saturation-reanimations') {
                    $('#titreCarte').html("Taux d'occupation des lits de réanimation");
                    $('#descriptionCarte').html("uniquement par les paitients Covid19");
                    tableauValeurs = valeurs_saturation_rea;
                    tableauCouleurs = couleurs_saturation_rea;
                    nomDonnee = "saturation_rea";
                } else if (typeCarte == 'lits-reanimations') {
                    $('#titreCarte').html("Nombre de lits de réanimation occupés pour Covid19");
                    $('#descriptionCarte').html("pour 100k habitants de chaque département");
                    tableauValeurs = valeurs_lits_rea;
                    tableauCouleurs = couleurs_hosp;
                    nomDonnee = "lits_rea";
                } else if (typeCarte == 'evolution-lits-reanimations') {
                    $('#titreCarte').html("Évolution du nombre de lits de réanimation occupés pour Covid19 sur les 7 derniers jours");
                    $('#descriptionCarte').html("Du rouge signifie une augmentation du nombre de lits de réanimation occupés par des patients Covid19");
                    tableauValeurs = valeurs_evolution;
                    tableauCouleurs = couleurs_evolution;
                    nomDonnee = "lits_rea_evol";
                    pourcentage = true;
                } else {
                    $('#carte path').css("fill", "#c4c4cb");
                    return;
                }

                construireLegende(tableauValeurs, tableauCouleurs, pourcentage);

                for (departement in donneesDepartements) {
                    // console.log(departement);
                    //Récupération du numéor de département à partir de la select.
                    numeroDepartement = $('#listeDepartements option[value="' + departement + '"]').data("num");
                    // console.log(numeroDepartement);
                    //Récupération des données du département.
                    donneesDepartement = donneesDepartements[departement];
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
                }
            }

            function afficherDepartement(nomDepartment, numeroDepartement) {
                console.log(donneesDepartements[nomDepartement]);
                incidenceDepartement = donneesDepartements[nomDepartement]["incidence_cas"];
                saturationRea = Math.round(donneesDepartements[nomDepartement]["saturation_rea"]);
                tauxPositivite = donneesDepartements[nomDepartement]["taux_positivite"];
                incidenceFrance = Math.round(donneesFrance["incidence_cas"]);

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
                content = content.replaceAll('dateMaj', dateMaj);
                content = content.replaceAll('couleurIncidence', couleurIncidence);
                content = content.replaceAll('couleurSaturationRea', couleurSaturationRea);
                content = content.replaceAll('couleurTauxPositivite', couleurTauxPositivite);

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
                $('.departement').remove();
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
                    $('#carte #map title').text(nomDepartement + ' (taux positivité : ' + $(this).data("taux_positivite").toFixed(2) + ')');
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
        }
    )
</script>