<!--- EXT IMPORTS --->
    <!--- CSS sheets --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!--- Js scripts --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js" integrity="sha512-igVQ7hyQVijOUlfg3OmcTZLwYJIBXU63xL9RC12xBHNpmGJAktDnzl9Iw0J4yrSaQtDxTTVlwhY730vphoVqJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>


<!--- Début HTML -->
<body>

<!--- VAXIMPACT IMPORTS --->
    <!--- CSS sheets --->
    <?php include(__DIR__ . '/vaximpactCss.php'); ?>

    <!--- Js scripts --->
    <?php include(__DIR__ . '/vaximpact_assetsJs.php'); ?>
    <?php include(__DIR__ . '/vaximpact_utilsJs.php'); ?>

    <!-- Les graphiques HTML fonctionnent sur la base de templates qui sont en include.-->
    <?php include(__DIR__ . '/templates.php'); ?>

    <!--- Intro globale --->
    <p><b>Cet outil permet d'évaluer l'impact de la vaccination sur la dynamique de l'épidémie </b>. Ces statistiques s'appuient sur les données issues de la DREES, mises à jour chaque semaine.<br>

    </p>


    
    <div style="background: #f5f5f5; padding: 30px; border-radius: 20px;">

    
    <!--- Selecteur de région-->
    <?php include(__DIR__ . '/top_selectors.php'); ?>

    <!--- Précision composition groupes --->
    <!--<div class="alert alert-warning" role="alert">
        Le groupe "Vaccinés" comprend uniquement les patients ayant terminé leur schéma vaccinal et le groupe "Non Vaccinés" les patients n'ayant reçu aucune dose de vaccin.  (voir méthodologie en bas de page pour plus de détails).
    </div>-->

    <!--- Choix de la catégorie à afficher -->
    <!--- Il faut utiliser comme href le même nom que le field du fichier stats_by_week.json !!! --->
    <?php include(__DIR__ . '/nav_onglets.php'); ?>
    </div>

    <!--- Contenu des onglets qui sera généré en js --->
    <div class="tab-content" id="tabs" style="margin-top: 30px;"></div>

    <br>

    <!--- Affichage du cadre méthodologie --->
    <div style="border:solid 2px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 30px; margin-top: 100px;">
        <h2>Méthodologie</h2>
        <p>Ces statistiques sont obtenues à partir des données publiées par la DREES. Elles seront mises à jour lors de la publication de nouvelles données.</p>
        <p><a href="https://github.com/CovidTrackerFr/data-utils/raw/main/vaximpact/data/doc/impact_vaccin_covid.pdf">Télécharger le document de méthodologie (PDF)</a></p>
    </div>

    <br>
    
    <!--- Liste des auteurs --->
    Auteurs : Sacha Guilhaumou, Elias Orphelin, Guillaume Rozier.<br>
    Merci pour leur aide : Catherine Hill, Dan Chaltiel. Merci pour leur relecture : Vittoria Colizza, Karine Lacombe, BioHospitalix, Le Doc.
    
    <br>

    <!--- Inclusion du menu du bas avec les outils -->
    <?php include(__DIR__ . '/menuBasPage.php'); ?>

</body>
<!--- Fin HTML -->

<!--- Début JS --->
<script>


// Permet d'afficher un onglet de la navbar lorsqu'on clique dessus.
$('#tabs_navbar a').click(function (e) {
     e.preventDefault()
$(this).tab('show')
})


// Fonction principale, télécharge les données pour la région sélectionnée
function download_data(region_code, first_load = false, groupes_a_comparer, groupe1,groupe2)

{
    var populate_region = false;
    if (region_code != "FR")
        {
            var populate_region = true;
        }
   
    fetch(data_url.format(region_code), {cache: 'no-cache'})
        .then(function(resp){
            return resp.json();
        })
        .then((data) => window.data_for_region = data)
        .then(function(){
            fetch(stats_url.format(region_code), {cache: 'no-cache'})
            .then(function(resp){ return resp.json()})
            .then((data) => window.stats_for_region = data)
            .then(function(){
                dates_from_json=[];
                for (date of Object.keys(stats_for_region["data_by_week"]))
                {
                    dates_from_json.push(date);
                }
                last_week_number = Math.max.apply(null, dates_from_json);

            })
            .then(function(){
            populate_figures(stats_for_region, data_for_region, last_week_number, populate_region, first_load,groupes_a_comparer, groupe1,groupe2)
            })
        });        
    
    }

var groupes_a_comparer=document.getElementById("select_groupes").value;

    
// Par défaut, on initialise tous les graphiques pour la france entière.
download_data("FR", first_load = true, groupes_a_comparer, groupes_a_comparer.split(" vs ")[0], groupes_a_comparer.split(" vs ")[1]);	

  
function populate_figures(stats, raw_data, last_week, populate_region = false, first_load = false, groupes_a_comparer, groupe1, groupe2){
    // Cas
    fillFigure(
        stats,
        raw_data,
        last_week,
        first_load,
        active_tab_by_default = true,
        tab_name = "cas",
        json_data_field = "nb_pcr0",
        graphique_intro="Ce graphique permet de visualiser le nombre de nouveaux cas de Covid-19 (symptomatiques ou non) diagnostiqués chaque jour chez des individus de {0} en fonction du statut vaccinal des personnes.",
        graphique_link="https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/images/charts/france/pcr_plus_proportion_selon_statut_vaccinal{0}.jpeg",
        figures_data = [
            {
                figure_type : "reduction_risque", 
                field_name : "cas positif(s)",
                icon_type : "virus",
                icon_color_vax : LIGHT_BLUE,
                icon_color_non_vax : "orange",
                title : "Réduction du risque de cas positifs",
                intro : "Imaginons deux groupes, l'un comportant des individus {0} de {1}, et l'autre uniquement des individus {2}. S'il y a une personne testée positive au Covid-19 chez les {3}, alors il y aura probablement {4} personnes testées positives chez les {5}.",
                conclu : "Cela signifie que les individus {0} ont un risque multiplié par {1} d'être contaminés au Covid-19 par rapport aux individus {2}. À ce bénéfice individuel de la vaccination, il faut ajouter le bénéfice collectif : réduction des contaminations (protection individuelle et immunité collective) et donc réduction du risque individuel d'infection.",
            },
            { 
                figure_type : "fraction_attribuable",
                animate : true,
                field_name : "Infections évitables",
                icon_type : "virus",
                icon_color_vax: "black",
                icon_color_non_vazx:"black",
                title : "Infections évitables",
                intro : "Cet indicateur permet d'estimer la proportion de cas de Covid-19 qui auraient pu être évités si tous les individus avaient été {0}.",
                mini_conclu : "Cela signifie que sur 100 infections d'individus {0} ayant {1}, {2} cas auraient pu être évités si tous ces individus étaient {3}.",
                conclu : "Cela signifie que sur les {0} infections observées le {1}, {2} infections auraient été directement évitables par la vaccination. D'autres infections auraient pu être indirectement évitées, la vaccination permettant de réduire les contaminations (protection individuelle et immunité collective).",
            }
        ], groupes_a_comparer, groupe1,groupe2
    );

    
    
    // Hospitalisations
    fillFigure(
        stats,
        raw_data,
        last_week,
        first_load,
        active_tab_by_default = false,
        tab_name = "hospitalisation_conventionnelle",
        json_data_field = "hc_pcr",
        graphique_intro="Ce graphique permet de visualiser le nombre de nouvelles hospitalisations (hors réa.) pour suspiscion de Covid-19 ayant lieu chaque jour chez des individus de {0} en fonction du statut vaccinal des personnes.",
        graphique_link="https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/images/charts/france/hc_proportion_selon_statut_vaccinal{0}.jpeg",
        figures_data = [
            {
                figure_type : "reduction_risque", 
                field_name : "hospitalisation(s)",
                icon_type : "bed",
                icon_color_vax : LIGHT_BLUE,
                icon_color_non_vax : "orange",
                title : "Réduction du risque d'admission à l'hôpital",
                intro : "Imaginons deux groupes, l'un comportant des individus {0} de {1} et l'autre uniquement des individus {2} du même âge. S'il y a une personne hospitalisée pour Covid-19 chaque jour chez les {3}, alors il y aura probablement {4} personnes hospitalisées chaque jour chez les {5}.",
                conclu : "Cela signifie que les individus {0} ont un risque multiplié par {1} d'être hospitalisés pour Covid-19 par rapport aux individus {2}. À ce bénéfice individuel de la vaccination, il faut ajouter le bénéfice collectif : réduction des contaminations (protection individuelle et immunité collective) et donc réduction du risque individuel d'infection.",
            },
            { 
                figure_type : "fraction_attribuable",
                animate : true,
                field_name : "Admissions à l'hopital",
                icon_type : "bed",
                icon_color_vax: "black",
                icon_color_non_vax:"black",
                title : "Admissions à l'hôpital évitables",
                intro : "Cet indicateur permet d'estimer la proportion d'hospitalisations (hors réa.) pour Covid-19 qui auraient pu être évitées si tous les individus avaient été {0}.",
                mini_conclu : "Cela signifie que sur 100 hospitalisations pour Covid-19 d'individus {0} ayant {1}, {2} hospitalisations auraient pu être évitées si tous ces individus étaient {3}.",
                conclu : "Cela signifie que sur les {0} admissions hospitalières (hors réa.) observées le {1}, {2} hospitalisations auraient été directement évitables par la vaccination. D'autres admissions auraient pu être indirectement évités, la vaccination permettant de réduire les contaminations (protection individuelle et immunité collective).",
            }
        ], groupes_a_comparer, groupe1,groupe2
    );

    // Réanimations
    fillFigure(
        stats,
        raw_data,
        last_week,
        first_load,
        active_tab_by_default = false,
        tab_name = "soins_critiques",
        json_data_field = "sc_pcr",
        graphique_intro="Ce graphique permet de visualiser le nombre de nouvelles admissions en soins critiques pour Covid-19 ayant lieu chaque jour chez des individus de {0} en fonction du statut vaccinal des personnes.",
        graphique_link="https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/images/charts/france/sc_proportion_selon_statut_vaccinal{0}.jpeg",
        figures_data = [
            {
                figure_type : "reduction_risque", 
                field_name : "admission(s) en réa.",
                icon_type : "bed",
                icon_color_vax : LIGHT_BLUE,
                icon_color_non_vax : "orange",
                title : "Réduction du risque d'admission en soins critiques",
                intro : "Imaginons deux groupes, l'un comportant des individus {0} de {1} et l'autre uniquement des individus {2} du même age. S'il y a une personne admise en soins critiques pour Covid-19 chaque jour chez les {3}, alors il y aura probablement {4} personnes admises en soins critiques chaque jour chez les {5}.",
                conclu : "Cela signifie que les individus {0} ont un risque multiplié par {1} d'être admis en soins critiques pour Covid-19 par rapport aux individus {2}. À ce bénéfice individuel de la vaccination, il faut ajouter le bénéfice collectif : réduction des contaminations (protection individuelle et immunité collective) et donc réduction du risque individuel d'infection.",
            },
            { 
                figure_type : "fraction_attribuable",
                animate : true,
                field_name : "Admissions en soins critiques",
                icon_type : "bed",
                icon_color_vax: "black",
                icon_color_non_vax:"black",
                title : "Admissions en soins critiques évitables",
                intro : "Cet indicateur permet d'estimer la proportion d'admissions en soins critiques pour Covid-19 qui auraient pu être évitées si tous les individus avaient été {0}.",
                mini_conclu : "Cela signifie que sur 100 admissions en soins critiques pour Covid-19 concernant des individus {0} ayant {1}, {2} admissions auraient pu être évitées si tous ces individus étaient {3}.",
                conclu : "Cela signifie que sur les {0} admissions en soins critiques observées le {1}, {2} admissions auraient été directement évitables par la vaccination. D'autres admissions auraient pu être indirectement évités, la vaccination permettant de réduire les contaminations (protection individuelle et immunité collective).",
            }
        ], groupes_a_comparer, groupe1,groupe2
    );
    // Décès
    fillFigure(
        stats,
        raw_data,
        last_week,
        first_load,
        active_tab_by_default = false,
        tab_name = "deces",
        json_data_field = "dc_pcr",
        graphique_intro="Ce graphique permet de visualiser le nombre de deces du Covid-19 ayant lieu chaque jour chez des individus de {0} en fonction du statut vaccinal des personnes.",
        graphique_link="https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/images/charts/france/dc_proportion_selon_statut_vaccinal{0}.jpeg",
        figures_data = [
            {
                figure_type : "reduction_risque", 
                field_name : "deces",
                icon_type : "body",
                icon_color_vax : LIGHT_BLUE,
                icon_color_non_vax : "orange",
                title : "Réduction du risque de décès",
                intro : "Imaginons deux groupes, l'un comportant des individus {0} de {1} et l'autre uniquement des individus {2} du même age. Si une personne décède du Covid-19 chaque jour chez les {3}, alors il y aura probablement {4} décès du Covid-19 chaque jour chez les {5}.",
                conclu : "Cela signifie que les individus {0} ont un risque multiplié par {1} de décéder du Covid-19 par rapport aux individus {2}. À ce bénéfice individuel de la vaccination, il faut ajouter le bénéfice collectif : réduction des contaminations (protection individuelle et immunité collective) et donc réduction du risque individuel d'infection.",
            },
            { 
                figure_type : "fraction_attribuable",
                animate : true,
                field_name : "Décès",
                icon_type : "body",
                icon_color_vax: "black",
                icon_color_non_vax:"black",
                title : "Décès évitables",
                intro : "Cet indicateur permet d'estimer la proportion de décès du Covid-19 qui auraient pu être évitées si tous les individus avaient été {0}.",
                mini_conclu : "Cela signifie que sur 100 décès pour Covid-19 d'iindividus {0} ayant {1}, {2} décès auraient pu être évités si tous ces individus étaient {3}.",
                conclu : "Cela signifie que sur les {0} décès du Covid-19 observés le {1}, {2} décès auraient été directement évitables par la vaccination. D'autres décès auraient pu être indirectement évités, la vaccination permettant de réduire les contaminations (protection individuelle et immunité collective).",
            }
        ], groupes_a_comparer, groupe1,groupe2
    );




    // On remplit toutes les dates "mis à jour le ..." d'un coup
    populate_dates(stats, last_week);
}


function fillFigure(stats, raw_data, last_week, active_tab_by_default, first_load, tab_name, json_data_field, graphique_intro, graphique_link, figures_data, groupes_a_comparer, groupe1, groupe2){

    // On créé un div au nom de l'onglet en cours
    if (document.querySelector("#"+tab_name))
    {
        var div_container = document.querySelector("#"+tab_name)
        div_container.innerHTML="";
    }
    
    else
    {
        var div_container = document.createElement("div");
        div_container.id=tab_name;
    }

    div_container.setAttribute("role", "tabpanel");
    div_container.classList.add("tab-pane");

    // S'il s'agit du 1er lancement et de l'onglet par défaut, on l'active
    if (first_load == true && active_tab_by_default==true)
    {
        div_container.classList.add("active");
    }

    if (graphique_intro!="" && graphique_link!="")
    {
        var graphe = document.querySelector('#template_graphique');
        graphe = document.importNode(graphe.content, true);

        var age = document.getElementById("select_age")
        var age_text = age.options[age.selectedIndex].text;

        if(age.value!="all"){
            var get_graph = "_"+age.value;
        }
        else{
            var get_graph=""
        }
    

       
        graphe.querySelector("#title").innerHTML = graphique_intro.format(age_text.toLowerCase());
        graphe.querySelector("#link").href = graphique_link.format(get_graph);
        graphe.querySelector("#imageTab").src = graphique_link.format(get_graph);

    
    }


    // Pour chaque onglet, on iterate les différentes figures
    for (figure of figures_data)
    {
        // On récupère la HTML template
        var template = document.querySelector('#template_'+figure.figure_type);
        template = document.importNode(template.content, true);
        var age = document.getElementById("select_age")
        var age_text = age.options[age.selectedIndex].text;
        age = age.value;
        console.log(`breakpoint1${groupes_a_comparer}`);
        var FER_population = (parseFloat(stats["data_by_week"][last_week]["data"][age][groupes_a_comparer][tab_name]["FER_population"])).toFixed(0);
        if (figure.figure_type=="reduction_risque"){
            var raw_chiffre_non_vax = (parseFloat(stats["data_by_week"][last_week]["data"][age][groupes_a_comparer][tab_name]["risque_relatif"])).toFixed(0);
            var chiffre_vax = 1;
        }

        else if (figure.figure_type=="fraction_attribuable"){
            var raw_chiffre_non_vax = (parseFloat(stats["data_by_week"][last_week]["data"][age][groupes_a_comparer][tab_name]["FER_exposes"])).toFixed(0);
            var chiffre_vax = 100-raw_chiffre_non_vax;
        }


        // On récupère les icones pour dresser le graphique
        var vax_icons = get_icons(figure.icon_type, chiffre_vax, figure.icon_color_vax);
        var non_vax_icons = get_icons(figure.icon_type, raw_chiffre_non_vax, figure.icon_color_non_vax, figure.animate);

        var chiffre_vax = `1 ${figure.field_name}`;

        if (figure.figure_type=="reduction_risque"){
            var chiffre_non_vax = `${raw_chiffre_non_vax} ${figure.field_name}`;
        }
        else
        {
           var chiffre_non_vax=raw_chiffre_non_vax;
        }

        template.querySelector('#title').innerHTML = figure.title;
        
        if (figure.figure_type=="reduction_risque"){
            template.querySelector('#description').innerHTML = figure.intro.format(groupe1, age_text.toLowerCase(), groupe2, groupe1, raw_chiffre_non_vax, groupe2);
            template.querySelector('#groupe1').innerHTML = `Groupe des ${groupe1} • `;
            template.querySelector('#groupe2').innerHTML = `Groupe des ${groupe2} • `;
            template.querySelector('#chiffre_vax').innerHTML = chiffre_vax;
            template.querySelector('#chiffre_non_vax').innerHTML = chiffre_non_vax;
            template.querySelector('#figure_vax').innerHTML = vax_icons;
            template.querySelector('#figure_non_vax').innerHTML = non_vax_icons;
            template.querySelector('#conclusion').innerHTML = figure.conclu.format(groupe2,raw_chiffre_non_vax,groupe1);

            var slider = "slider_{0}".format(tab_name);
            template.querySelector('#slider').setAttribute("id",slider);
            template.querySelector('#'+slider).setAttribute("tab_name",tab_name);
            template.querySelector('#'+slider).setAttribute("field_name",figure.field_name);
            template.querySelector('#'+slider).setAttribute("icon_type",figure.icon_type);
            template.querySelector('#'+slider).setAttribute("non_vax_value",raw_chiffre_non_vax);
            
        }

        else if (figure.figure_type=="fraction_attribuable"){
            template.querySelector('#premiere_conclu').innerHTML = figure.mini_conclu.format(groupe2,age_text.toLowerCase(), chiffre_non_vax, groupe1);
            template.querySelector('#premiere_conclu').setAttribute("tag",figure.mini_conclu);
            template.querySelector('#premiere_conclu').setAttribute("age",age_text.toLowerCase()); 
            // template.querySelector('#conclusion').innerHTML = figure.conclu.format(raw_data["data_by_week"][last_week]["data"][age][groupe1][json_data_field], format_date_to_day_month(stats["data_by_week"][last_week]["week_end_date"]), parseFloat(raw_data["data_by_week"][last_week]["data"][age][groupe1][json_data_field]*FER_population/100).toFixed(0));
            template.querySelector('#figure_vax').innerHTML = vax_icons + non_vax_icons;
            template.querySelector('#group').innerHTML = figure.field_name + " chez les "+groupe2;
            template.querySelector('#group').setAttribute("tag",figure.field_name);
            template.querySelector('#chiffre_vax_evitables').innerHTML = chiffre_non_vax;
            template.querySelector('#chiffre_vax_evitables').setAttribute("non_vaccines",chiffre_non_vax);
            template.querySelector('#chiffre_vax_evitables').setAttribute("population",FER_population);

        }

    if (raw_chiffre_non_vax == -1){
        no_data(template, age, json_data_field, slider, raw_data, last_week, groupe1, groupe2);
    }

    if (graphe){div_container.appendChild(graphe);}
    div_container.appendChild(template);
    document.querySelector('#tabs').appendChild(div_container);

    }
}


// Récupère les données pour le bon âge
function selectAge(selected){

    var selector_groupes = document.getElementById("select_groupes");
    // On récupère les données pour la région directement ! 
    download_data("FR", first_load=false,selector_groupes.value, selector_groupes.value.split(' vs ')[0], selector_groupes.value.split(' vs ')[1]);
}

</script>

