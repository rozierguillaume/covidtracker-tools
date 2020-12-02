<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="https://covidtracker.fr">&lt;
        Retour <b>Accueil</b></a></div>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>

<script id="departementTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroDepartement" data-num="numeroDepartement" data-nom="nomDepartement" class="departement">
        <h2>
            nomDepartement (numeroDepartement)
            <a class="masquerDepartement pull-right" href="#">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </a>
        </h2>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dashboard_jour_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/dashboard_jour_nomDepartement.jpeg"
                     width="75%">
            </a>
        </p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_deps/heatmap_taux_numeroDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/heatmaps_deps/heatmap_taux_numeroDepartement.jpeg"
                     width="60%">
            </a>
        </p>
        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/saturation_rea_journ_nomDepartement.jpeg"
               target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/departements_dashboards/saturation_rea_journ_nomDepartement.jpeg"
                     width="60%">
            </a>
        </p>
        <!-- wp:spacer {"height":50} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        <p><a href="#menu">Retour au menu</a></p>
    </div>
</script>
<script>
    jQuery(document).ready(function ($) {
        function afficherDepartement(nomDepartment, numeroDepartement) {
            if ($('#' + numeroDepartement).length > 0) {
                return;
            }
            content = $('#departementTemplate').html();
            content = content.replaceAll('nomDepartement', nomDepartment);
            content = content.replaceAll('numeroDepartement', numeroDepartement);
            $('#donneesDepartements').prepend(content);
            trierDepartements();
        }

        function trierDepartements() {
            $divs = jQuery("#donneesDepartements div.departement");

            alphabeticallyOrderedDeps = $divs.sort(function (a, b) {
                return String.prototype.localeCompare.call($(a).data('nom').toLowerCase(), $(b).data('nom').toLowerCase());
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
            $("#listeDepartements option").each(function() {
                $(this).attr('selected', false);
            });
            $("#listeDepartements").trigger('change');
            $('.departement').remove();
            $('#map path').removeClass('selected');
        });

        $('body').on('click', '.masquerDepartement', function (e) {
            e.preventDefault();
            numeroDepartement = $(this).parents('.departement').data("num");
            console.log($("select option[data-num='" + numeroDepartement + "']"));
            $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
            $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
            $("#listeDepartements").trigger('change');
            $('#' + numeroDepartement).remove();
        });

        $('#selectAll').click(function () {

            //Sélection des toutes les options du select.
            $("#listeDepartements option").each(function() {
                nomDepartement = $(this).val();
                if (!$(this).attr('selected')) {
                    $(this).attr('selected', true);
                    if ($("#listeDepartements").val()) {
                        $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                    } else {
                        $("#listeDepartements").val(nomDepartement);
                    }
                    afficherDepartement(nomDepartement, $(this).data("num"));
                }
            });
            $("#listeDepartements").trigger('change');
            //Sélection des toutes les régions de la carte.
            $('#map path').addClass('selected');



            // $('#carte path').each(function () {
            //     if (!$(this).data("num")) {
            //         return;
            //     }
            //     departement = $(this).data("num");
            //     nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
            //     if (!$(this).hasClass('selected')) {
            //         $(this).addClass('selected');
            //         if ($("#listeDepartements").val()) {
            //             $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
            //         } else {
            //             $("#listeDepartements").val(nomDepartement);
            //         }
            //         $("#listeDepartements").trigger('change');
            //         afficherDepartement(nomDepartement, departement);
            //     }
            // });
        });

        $('#carte path').hover(function (e) {
            departement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
            $('#carte #map title').text(nomDepartement);
        });

        $('#carte path').click(function (e) {
            numeroDepartement = $(this).data("num");
            nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                $("#listeDepartements").trigger('change');
                $('#' + numeroDepartement).remove();
            } else {
                $(this).addClass('selected');
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

    })
</script>
<style>
    #listeDepartements {
        width: 100%;
    }

    #map {
        max-width: 100%;
        max-height: 100%;
    }

    #map path {
        fill: #86AAE0;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
    }

    #map path.selected {
        fill: #547096;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
    }

    #map path:hover {
        fill: #a1d1ff;
    }

    #map .separator {
        stroke: #ccc;
        fill: none;
        stroke-width: 1.5;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none;
    }
</style>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<p>
    <a href="#menu">Retour au menu</a>
</p>
<div id="donneesDepartements">

</div>

