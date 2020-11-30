<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="https://covidtracker.fr">&lt;
        Retour <b>Accueil</b></a></div>

<?php include('./selectEtCarte.php') ?>

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
            $('#carte path.selected').each(function () {
                if (!$(this).data("num")) {
                    return;
                }
                numeroDepartement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
                $(this).removeClass('selected');
                $("select option[data-num='" + numeroDepartement + "']").prop("selected", false);
                $("#listeDepartements").trigger('change');
                $('#' + numeroDepartement).remove();
            });
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
            $('#carte path').each(function () {
                if (!$(this).data("num")) {
                    return;
                }
                departement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
                if (!$(this).hasClass('selected')) {
                    $(this).addClass('selected');
                    if ($("#listeDepartements").val()) {
                        $("#listeDepartements").val($.merge([nomDepartement], $("#listeDepartements").val()));
                    } else {
                        $("#listeDepartements").val(nomDepartement);
                    }
                    $("#listeDepartements").trigger('change');
                    afficherDepartement(nomDepartement, departement);
                }
            });
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

<!---->
<!--    <p><a href="#Ain">Ain (01)</a> • <a href="#Aisne">Aisne (02)</a> • <a href="#Allier">Allier (03)</a> • <a-->
<!--                href="#Alpes-Maritimes">Alpes-Maritimes (06)</a> • <a href="#Alpes-de-Haute-Provence">Alpes-de-Haute-Provence-->
<!--            (04)</a> • <a href="#Ardennes">Ardennes (08)</a> • <a href="#Ardèche">Ardèche (07)</a> • <a href="#Ariège">Ariège-->
<!--            (09)</a> • <a href="#Aube">Aube (10)</a> • <a href="#Aude">Aude (11)</a> • <a href="#Aveyron">Aveyron-->
<!--            (12)</a> • <a href="#Bas-Rhin">Bas-Rhin (67)</a> • <a href="#Bouches-du-Rhône">Bouches-du-Rhône (13)</a> •-->
<!--        <a href="#Calvados">Calvados (14)</a> • <a href="#Cantal">Cantal (15)</a> • <a href="#Charente">Charente-->
<!--            (16)</a> • <a href="#Charente-Maritime">Charente-Maritime (17)</a> • <a href="#Cher">Cher (18)</a> • <a-->
<!--                href="#Corrèze">Corrèze (19)</a> • <a href="#Corse-du-Sud">Corse-du-Sud (2A)</a> • <a href="#Creuse">Creuse-->
<!--            (23)</a> • <a href="#Côte-d'or">Côte-d'or (21)</a> • <a href="#Côtes-d'armor">Côtes-d'armor (22)</a> • <a-->
<!--                href="#Deux-Sèvres">Deux-Sèvres (79)</a> • <a href="#Dordogne">Dordogne (24)</a> • <a href="#Doubs">Doubs-->
<!--            (25)</a> • <a href="#Drôme">Drôme (26)</a> • <a href="#Essonne">Essonne (91)</a> • <a href="#Eure">Eure-->
<!--            (27)</a> • <a href="#Eure-et-Loir">Eure-et-Loir (28)</a> • <a href="#Finistère">Finistère (29)</a> • <a-->
<!--                href="#Gard">Gard (30)</a> • <a href="#Gers">Gers (32)</a> • <a href="#Gironde">Gironde (33)</a> • <a-->
<!--                href="#Guadeloupe">Guadeloupe (971)</a> • <a href="#Guyane">Guyane (973)</a> • <a href="#Haut-Rhin">Haut-Rhin-->
<!--            (68)</a> • <a href="#Haute-Corse">Haute-Corse (2B)</a> • <a href="#Haute-Garonne">Haute-Garonne (31)</a> •-->
<!--        <a href="#Haute-Loire">Haute-Loire (43)</a> • <a href="#Haute-Marne">Haute-Marne (52)</a> • <a-->
<!--                href="#Haute-Savoie">Haute-Savoie (74)</a> • <a href="#Haute-Saône">Haute-Saône (70)</a> • <a-->
<!--                href="#Haute-Vienne">Haute-Vienne (87)</a> • <a href="#Hautes-Alpes">Hautes-Alpes (05)</a> • <a-->
<!--                href="#Hautes-Pyrénées">Hautes-Pyrénées (65)</a> • <a href="#Hauts-de-Seine">Hauts-de-Seine (92)</a> •-->
<!--        <a href="#Hérault">Hérault (34)</a> • <a href="#Ille-et-Vilaine">Ille-et-Vilaine (35)</a> • <a href="#Indre">Indre-->
<!--            (36)</a> • <a href="#Indre-et-Loire">Indre-et-Loire (37)</a> • <a href="#Isère">Isère (38)</a> • <a-->
<!--                href="#Jura">Jura (39)</a> • <a href="#La Réunion">La Réunion (974)</a> • <a href="#Landes">Landes-->
<!--            (40)</a> • <a href="#Loir-et-Cher">Loir-et-Cher (41)</a> • <a href="#Loire">Loire (42)</a> • <a-->
<!--                href="#Loire-Atlantique">Loire-Atlantique (44)</a> • <a href="#Loiret">Loiret (45)</a> • <a href="#Lot">Lot-->
<!--            (46)</a> • <a href="#Lot-et-Garonne">Lot-et-Garonne (47)</a> • <a href="#Lozère">Lozère (48)</a> • <a-->
<!--                href="#Maine-et-Loire">Maine-et-Loire (49)</a> • <a href="#Manche">Manche (50)</a> • <a href="#Marne">Marne-->
<!--            (51)</a> • <a href="#Martinique">Martinique (972)</a> • <a href="#Mayenne">Mayenne (53)</a> • <a-->
<!--                href="#Mayotte">Mayotte (976)</a> • <a href="#Meurthe-et-Moselle">Meurthe-et-Moselle (54)</a> • <a-->
<!--                href="#Meuse">Meuse (55)</a> • <a href="#Morbihan">Morbihan (56)</a> • <a href="#Moselle">Moselle-->
<!--            (57)</a> • <a href="#Nièvre">Nièvre (58)</a> • <a href="#Nord">Nord (59)</a> • <a href="#Oise">Oise (60)</a>-->
<!--        • <a href="#Orne">Orne (61)</a> • <a href="#Paris">Paris (75)</a> • <a href="#Pas-de-Calais">Pas-de-Calais-->
<!--            (62)</a> • <a href="#Puy-de-Dôme">Puy-de-Dôme (63)</a> • <a href="#Pyrénées-Atlantiques">Pyrénées-Atlantiques-->
<!--            (64)</a> • <a href="#Pyrénées-Orientales">Pyrénées-Orientales (66)</a> • <a href="#Rhône">Rhône (69)</a> •-->
<!--        <a href="#Sarthe">Sarthe (72)</a> • <a href="#Savoie">Savoie (73)</a> • <a href="#Saône-et-Loire">Saône-et-Loire-->
<!--            (71)</a> • <a href="#Seine-Maritime">Seine-Maritime (76)</a> • <a href="#Seine-Saint-Denis">Seine-Saint-Denis-->
<!--            (93)</a> • <a href="#Seine-et-Marne">Seine-et-Marne (77)</a> • <a href="#Somme">Somme (80)</a> • <a-->
<!--                href="#Tarn">Tarn (81)</a> • <a href="#Tarn-et-Garonne">Tarn-et-Garonne (82)</a> • <a-->
<!--                href="#Territoire de Belfort">Territoire de Belfort (90)</a> • <a href="#Val-d'oise">Val-d'oise (95)</a>-->
<!--        • <a href="#Val-de-Marne">Val-de-Marne (94)</a> • <a href="#Var">Var (83)</a> • <a href="#Vaucluse">Vaucluse-->
<!--            (84)</a> • <a href="#Vendée">Vendée (85)</a> • <a href="#Vienne">Vienne (86)</a> • <a href="#Vosges">Vosges-->
<!--            (88)</a> • <a href="#Yonne">Yonne (89)</a> • <a href="#Yvelines">Yvelines (78)</a></p>-->

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<p>
    <a href="#menu">Retour au menu</a>
</p>

<div id="donneesDepartements">

</div>

