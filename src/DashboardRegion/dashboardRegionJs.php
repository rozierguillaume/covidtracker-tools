<script>
    jQuery(document).ready(function ($) {

        var donneesRegions
        var reffectifRegions
        var donneesFrance
        var saturationReaRegions
        var dateMaj
        var valeurs_cas = [">", "250", "150", "50"]
        var couleurs_cas = ["#3c0000", "#c80000", "#f95228", "#98ac3b"]


        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/incidence_regions.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })

            .then(json => {
                donneesRegions = json['donnees_regions'];
                donneesFrance = json['donnees_france'];
                dateMaj = json["date_update"]

                tableauValeurs = valeurs_cas;
                tableauCouleurs = couleurs_cas;
                nomDonnee = "incidence_cas";
                pourcentage = false;
                construireLegende(tableauValeurs, tableauCouleurs, pourcentage);

                for (region in donneesRegions) {
                    // console.log(departement);
                    numeroRegion = $('#listeRegions option[value="' + region + '"]').data("num");
                    // console.log(numeroDepartement);
                    donneesRegion = donneesRegions[region];
                    // console.log(donneesDepartement);

                    var regionCarte = $('#carte path[data-code_insee="' + numeroRegion + '"], #carte g[data-code_insee="' + numeroRegion + '"] path');
                    regionCarte.data("incidence-cas", donneesRegion["incidence_cas"]);
                    regionCarte.css("fill", recupererCouleur(donneesRegion[nomDonnee], tableauValeurs, tableauCouleurs));
                }
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

        /*
        * Le lancement de l'animation se fait en ajoutant et retirant la classe animated
        * de la carte afin que tous les départements clignotent en meme temps.
        * Sans quoi chaque département commence son clignotement au moment où on lui attribue
        * la classe selected.
        */
        var stopAnimation = function () {
            $("#map").removeClass("animated")
        }

        var startAnimation = function () {
            $("#map").addClass("animated")
        }

        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/reffectif_region.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                reffectifRegions = json;
            });

        fetch('https://raw.githubusercontent.com/rozierguillaume/covid-19/master/data/france/stats/saturation_rea_regions.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                saturationReaRegions = json;
            });


        function afficherRegion(nomRegion, numeroRegion) {
            incidenceRegion = donneesRegions[nomRegion]["incidence_cas"]
            incidenceFrance = Math.round(donneesFrance["incidence_cas"])
            saturationRea = Math.round(saturationReaRegions[nomRegion])
            tauxPositivite = donneesRegions[nomRegion]["taux_positivite"]
            reffectifRegion = Math.round((reffectifRegions[nomRegion]["value"] * 100)) / 100

            if (incidenceRegion > 100) {
                couleurIncidence = "red"

            } else if (incidenceRegion > 50) {
                couleurIncidence = "orange"

            } else {
                couleurIncidence = "green"
            }

            if (saturationRea > 80) {
                couleurSaturation = "red"

            } else if (saturationRea > 40) {
                couleurSaturation = "orange"

            } else {
                couleurSaturation = "green"
            }

            if (reffectifRegion > 1.5) {
                couleurReffectif = "red"

            } else if (reffectifRegion >= 0.9) {
                couleurReffectif = "orange"

            } else {
                couleurReffectif = "green"
            }

            if (tauxPositivite >= 5) {
                couleurTauxPositivite = "red"

            } else if (tauxPositivite >= 1) {
                couleurTauxPositivite = "orange"

            } else {
                couleurTauxPositivite = "green"
            }

            if ($('#' + numeroRegion).length > 0) {
                return;
            }
            content = $('#regionTemplate').html();
            content = content.replaceAll('nomRegion', nomRegion);
            content = content.replaceAll('numeroRegion', numeroRegion);
            content = content.replaceAll('incidenceRegion', incidenceRegion);
            content = content.replaceAll('incidenceFrance', incidenceFrance);
            content = content.replaceAll('saturationRea', saturationRea + "%");
            content = content.replaceAll('tauxPositivite', tauxPositivite + "%");
            content = content.replaceAll('dateMaj', dateMaj);
            content = content.replaceAll('couleurIncidence', couleurIncidence);
            content = content.replaceAll('couleurSaturationRea', couleurSaturation);
            content = content.replaceAll('couleurReffectif', couleurReffectif);
            content = content.replaceAll('reffectifRegion', reffectifRegion);
            content = content.replaceAll('couleurTauxPositivite', couleurTauxPositivite);
            //content = content.replaceAll('couleurSaturationRea', couleurSaturationRea);

            $('#donneesRegions').prepend(content);
            //trierRegions();
            stopAnimation();
            setTimeout(startAnimation, 0);
        }

        function trierRegions() {
            $divs = jQuery("#donneesRegions div.region");
            alphabeticallyOrderedRegions = $divs.sort(function (a, b) {
                // alert($(a).data('nom').toLowerCase());
                // alert($(b).data('nom').toLowerCase());
                return String.prototype.localeCompare.call($(a).data('nom').toLowerCase(), $(b).data('nom').toLowerCase());
            });
            $("#donneesRegions").html(alphabeticallyOrderedRegions);
        }

        //
        $('.select2').select2({
            placeholder: 'Sélectionnez les régions que vous voulez consulter....',
            closeOnSelect: false,
        });

        $('.select2').val(null).trigger('change');

        $('div.region').addClass('hidden');

        $('.select2').on('select2:select', function (e) {
            nomRegion = e.params.data.id;
            numeroRegion = e.params.data.element.dataset.num;
            $('#map path[data-code_insee=' + numeroRegion + '], #map g[data-code_insee=' + numeroRegion + ']').addClass('selected');
            afficherRegion(nomRegion, numeroRegion);
        });

        $('.select2').on('select2:unselect', function (e) {
            nomRegion = e.params.data.id;
            numeroRegion = e.params.data.element.dataset.num;
            $('#map path[data-code_insee=' + numeroRegion + '], #map g[data-code_insee=' + numeroRegion + ']').removeClass('selected');
            $('#' + numeroRegion).remove();
        });

        $('body').on('click', '.masquerRegion', function (e) {
            e.preventDefault();
            numeroRegion = $(this).parents('.region').data("num");
            $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
            $('#map path[data-code_insee=' + numeroRegion + ']').removeClass('selected');
            $("#listeRegions").trigger('change');
            $('#' + numeroRegion).remove();
        });

        $('#unselectAll').click(function () {
            $("#listeRegions option").each(function () {
                $(this).attr('selected', false);
                $("#listeRegions").trigger('change');
            });
            $('div.region').remove();
            $('#map path').removeClass('selected');
        });

        $('#selectAll').click(function () {
            //Sélection des toutes les options du select.
            $("#listeRegions option").each(function () {
                nomRegion = $(this).val();
                if (!$(this).attr('selected')) {
                    $(this).attr('selected', true);
                    if ($("#listeRegions").val()) {
                        $("#listeRegions").val($.merge([nomRegion], $("#listeRegions").val()));
                    } else {
                        $("#listeRegions").val(nomRegion);
                    }
                    afficherRegion(nomRegion, $(this).data("num"));
                    trierRegions();
                }
            });
            $("#listeRegions").trigger('change');
            //Sélection des toutes les régions de la carte.
            $('#map path').addClass('selected');

        });

        $('#map path.region, #map g.region').hover(function (e) {
            numeroRegion = $(this).data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            $('#carte #map title').text(nomRegion);
        });

        $('#map path.region, #map g.region').click(function (e) {
            numeroRegion = $(this).data("code_insee");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
                $("#listeRegions").trigger('change');
                $('#' + numeroRegion).remove();
            } else {
                $(this).addClass('selected');
                if ($("#listeRegions").val()) {
                    $("#listeRegions").val($.merge([nomRegion], $("#listeRegions").val()));
                } else {
                    $("#listeRegions").val(nomRegion);
                }
                $("#listeRegions").trigger('change');
                afficherRegion(nomRegion, numeroRegion);
            }
        });

    })
</script>