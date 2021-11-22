<script>
    jQuery(document).ready(function ($) {

        $('.dropdown-toggle').dropdown();

        var valeurs_cas = [">", "400", "250", "150", "50"];
        var couleurs_cas = ["purple", "#3c0000", "#c80000", "#f95228", "#98ac3b"];

        var valeurs_cas_12_couleurs = [">", "500", "450", "400", "350", "300", "250", "200", "150", "100", "75", "50", "25"];
        var couleurs_cas_12_couleurs = ["#3c0000", "#4c0000", "#6a0000", "#840000", "#a00000", "#c40001", "#d50100", "#e20001", "#f50e07", "#f95228", "#fb9449", "#98ac3b", "#118408"];

        var donneesDepartements;
        var donneesFrance;
        var dateMaj;
        var typeCarte = 'incidence-cas';

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
                dateMaj = json["date_donnees"];
                colorerCarte();
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
            $('#dateCarte').html(dateMaj)
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


            function trierDepartements() {
                $divs = jQuery("#donneesDepartements div.departement");

                alphabeticallyOrderedDeps = $divs.sort(function (a, b) {
                    return String.prototype.localeCompare.call($(a).data('num'), $(b).data('num'));
                });

                $("#donneesDepartements").html(alphabeticallyOrderedDeps);
            }

            // $('.select2').select2({
            //     placeholder: 'Sélectionnez les départements que vous voulez consulter....',
            //     closeOnSelect: false,
            // });

            // $('.select2').val(null).trigger('change');



            // $('.select2').on('select2:select', function (e) {
            //     nomDepartement = e.params.data.id;
            //     numeroDepartement = e.params.data.element.dataset.num;
            //     $('#map path[data-num=' + numeroDepartement + ']').addClass('selected');
            //     // $('#' + nomDepartement).parent().removeClass('hidden');
            //     afficherDepartement(nomDepartement, numeroDepartement);
            // });
            //
            // $('.select2').on('select2:unselect', function (e) {
            //     nomDepartement = e.params.data.id;
            //     numeroDepartement = e.params.data.element.dataset.num;
            //     $('#map path[data-num=' + numeroDepartement + ']').removeClass('selected');
            //     $('#' + numeroDepartement).remove();
            // });


            $('#carte path').hover(function (e) {
                departement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + departement + "']").val();
                if (typeCarte == 'incidence-cas') {
                    $('#carte #map title').text(nomDepartement + ' (incidence : ' + $(this).data("incidence_cas") + ')');
                } else {
                    $('#carte #map title').text(nomDepartement);
                }
            });

            $('#carte path').click(function (e) {
                numeroDepartement = $(this).data("num");
                nomDepartement = $("#listeDepartements option[data-num='" + numeroDepartement + "']").val();
                window.open('https://covidtracker.fr/dashboard-departements/?dep='+numeroDepartement, '_blank');
            });


        }
    )
</script>


<script id="legendTemplatePre" type="text/template">
    <table>
        <tbody>
</script>

<script id="legendTemplateMid" type="text/template">
    <tr>
        <td style="text-align: center; background-color: colorBg; color: white; font-size: 50%; padding: 5px;">valeur
        </td>
    </tr>
</script>

<script id="legendTemplatePost" type="text/template">
    </tbody>
    </table>
</script>

