<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="https://covidtracker.fr">&lt;
        Retour <b>Accueil</b></a></div>

<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>

<script id="regionTemplate" type="text/template">
    <!-- wp:heading -->
    <div id="numeroRegion" data-num="numeroRegion" data-nom="nomRegion" class="region">
        <h2>
            nomRegion
            <a class="masquerRegion pull-right" href="#">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </a>
        </h2>

        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/dashboard_jour_nomRegion.jpeg" target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/dashboard_jour_nomRegion.jpeg" width="100%"> </a>
        </p>

        <p align="center">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/saturation_rea_journ_nomRegion.jpeg" target="_blank" rel="noopener noreferrer">
                <img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/regions_dashboards/saturation_rea_journ_nomRegion.jpeg" width="70%">
            </a>
        </p>

        <!-- wp:spacer {"height":50} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <p><a href="#menu">Haut de page</a></p>
    </div>
</script>
<script>
    jQuery(document).ready(function ($) {
        function afficherRegion(nomRegion, numeroRegion) {
            if ($('#' + numeroRegion).length > 0) {
                return;
            }
            content = $('#regionTemplate').html();
            content = content.replaceAll('nomRegion', nomRegion);
            content = content.replaceAll('numeroRegion', numeroRegion);
            $('#donneesRegions').prepend(content);
            trierRegions();
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
            $('#map path[data-num=' + numeroRegion + ']').addClass('selected');
            afficherRegion(nomRegion, numeroRegion);
        });

        $('.select2').on('select2:unselect', function (e) {
            nomRegion = e.params.data.id;
            numeroRegion = e.params.data.element.dataset.num;
            $('#map path[data-num=' + numeroRegion + ']').removeClass('selected');
            $('#' + numeroRegion).remove();
        });


        $('body').on('click', '.masquerRegion', function (e) {
            e.preventDefault();
            numeroRegion = $(this).parents('.region').data("num");
            $("select option[data-num='" + numeroRegion + "']").prop("selected", false);
            $('#map path[data-num=' + numeroRegion + ']').removeClass('selected');
            $("#listeRegions").trigger('change');
            $('#' + numeroRegion).remove();
        });

        $('#unselectAll').click(function () {
            $("#listeRegions option").each(function() {
                $(this).attr('selected', false);
                $("#listeRegions").trigger('change');
            });
            $('.region').remove();
            $('#map path').removeClass('selected');
        });

        $('#selectAll').click(function () {
            //Sélection des toutes les options du select.
            $("#listeRegions option").each(function() {
                nomRegion = $(this).val();
                if (!$(this).attr('selected')) {
                    $(this).attr('selected', true);
                    if ($("#listeRegions").val()) {
                        $("#listeRegions").val($.merge([nomRegion], $("#listeRegions").val()));
                    } else {
                        $("#listeRegions").val(nomRegion);
                    }
                    afficherRegion(nomRegion, $(this).data("num"));
                }
            });
            $("#listeRegions").trigger('change');
            //Sélection des toutes les régions de la carte.
            $('#map path').addClass('selected');

        });

        $('#carte path').hover(function (e) {
            numeroRegion = $(this).data("num");
            nomRegion = $("#listeRegions option[data-num='" + numeroRegion + "']").val();
            $('#carte #map title').text(nomRegion);
        });

        $('#carte path').click(function (e) {
            numeroRegion = $(this).data("num");
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
<style>
    #listeRegions {
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
        fill: #547096;
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

    .btn-primary{
        background-color: #86AAE0;
        border-color: #86AAE0;
    }

    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus {
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

</style>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!--<p>-->
<!--    <a href="#menu">Retour au menu</a>-->
<!--</p>-->
<div id="donneesRegions">

</div>

