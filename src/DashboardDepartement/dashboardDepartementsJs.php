<script>
    jQuery(document).ready(function ($) {
            $('.dropdown-toggle').dropdown();

            var valeurs_cas = [">", "250", "150", "50"];
            var couleurs_cas = ["#3c0000", "#c80000", "#f95228", "#98ac3b"];

            var valeurs_n_dose1_cumsum_pop = [">", "5.5", "5", "4.5", "4", "3.5", "3", "2.5", "2", "1.5"];
            //var couleurs_n_dose1_cumsum_pop = ["#98ac3b", "#3c0000", "#c80000", "#f95228"];
            var couleurs_n_dose1_cumsum_pop = ["#0076bf", "#1796e6",  "#2e9fe6", "#45a8e6",  "#5cb1e6", "#73bae6", "#8ac2e6", "#a1cbe6", "#b8d4e6",  "#cfdde6"]
            
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
            var donneesDepartementsVaccination;
            var donneesFrance;
            var dateMaj;
            var typeCarte = 'incidence-cas';
            
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

            function fetchOtherData(){
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
            }

            function construireLegende(values = [], colors = [], pourcentage = false) {
                content = $('#legendTemplatePre').html();
                values.map((val, idx) => {
                    if (pourcentage && (val != '>')) {
                        if (val > 0) {
                            content += $('#legendTemplateMid').html().replaceAll("valeur", plus + val + ' %').replaceAll("colorBg", colors[idx]);
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
                } else if($("#numeroDepartementSearched").length > 0){
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
                n_dose1_cumsum_pop = donneesDepartementsVaccination[numeroDepartement]["n_dose1_cumsum_pop"];
                incidenceFrance = Math.round(donneesFrance["incidence_cas"]);
                dateMajVaccination = donneesDepartementsVaccination[numeroDepartement]["dates"][donneesDepartementsVaccination[numeroDepartement]["dates"].length - 1]

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
                } else if (typeCarte == 'n_dose1_cumsum_pop') {
                    $('#carte #map title').text(nomDepartement + ' (' + $(this).data("n_dose1_cumsum_pop").toFixed(2) + ' %)');
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