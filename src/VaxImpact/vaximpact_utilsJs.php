<script>
// Fonction visant à imiter la fonction format() de python.
// "Je suis {0} {1}".format("Guillaume", "Rozier") => "Je suis Guillaume Rozier"
String.prototype.format = function() 
{
    string_to_format = this;
    for (argument in arguments) 
    {
        string_to_format = string_to_format.replace("{" + argument + "}", arguments[argument])
    }
    return string_to_format
}


function getDoubleDigit(value){
    if(value.toString().length == 1){
			return "0"+(value).toString()
			}	
    else {
            return (value).toString()
        }
}


// Appui sur "Chez les non vaccinés" ou "En population générale" dans la partie fraction attribuable
function button_attribuable(button){

    // On enlève la classe qui highlight le bouton pour tous les boutons sauf celui cliqué
    for (i of document.querySelector("#"+button.parentNode.parentNode.id).getElementsByClassName("btn_event"))
    {
        if (i.id != button.id)
        {
            i.classList.remove("btn-actif");
            i.classList.add("btn-inactif");
        }
    }

    // On highlight notre bouton
    button.classList.remove("btn-inactif");
    button.classList.add("btn-actif");

    // On modifie dans le titre "chez les non vaccinés" vs "en population générale"
    var title = document.querySelector("#tabs").querySelector("#"+button.parentNode.parentNode.id).querySelector("#group");
    title.innerHTML = title.getAttribute("tag") + " " + button.value;
    
    // On récupère le chiffre de la fraction évitable
    var chiffre = document.querySelector("#tabs").querySelector("#"+button.parentNode.parentNode.id).querySelector("#chiffre_vax_evitables");

    // On récupère le type des icons actuellement utilisés pour les conserver pour la suite
    var icon_type = document.querySelector("#tabs").querySelector("#"+button.parentNode.parentNode.id).querySelector("#main_div_fraction_attribuable").querySelector("#figure_vax").getElementsByTagName("svg")[0].id;
    
    // On récupère le nouveau chiffre à afficher dans les attributs HTML du bouton selon l'id du bouton cliqué.
    if (button.id == "button_non_vax"){chiffre.innerHTML = chiffre.getAttribute("non_vaccines");}
    if (button.id == "button_pop_generale"){chiffre.innerHTML = chiffre.getAttribute("population");}

    // On modifie dans l'intro "chez les non vaccinés" vs "en population générale"
    var mini_intro = document.querySelector("#tabs").querySelector("#"+button.parentNode.parentNode.id).querySelector("#premiere_conclu");
    mini_intro.innerHTML = mini_intro.getAttribute("tag").format(mini_intro.getAttribute("age"), button.value, chiffre.innerHTML);

    // On redessine les nouveaux icons 
    var non_evitables_icons = get_icons(icon_type, 100-chiffre.innerHTML, "black", animate = false);
    var evitables_icons = get_icons(icon_type, chiffre.innerHTML, "red", animate = true);

    // On met à jour la figure
    var updated_figure = document.querySelector("#tabs").querySelector("#"+button.parentNode.parentNode.id).querySelector("#main_div_fraction_attribuable").querySelector("#figure_vax");  
    updated_figure.innerHTML = non_evitables_icons+evitables_icons;
}


// Fonction qui permet de récupérer les icons et d'en faire une figure unique.
function get_icons(icon_name, number, color="black", animate=false){

    var animate_str = "" ;
    var icons = "" ;

    if(animate==true){
        animate_str = `<animate
            attributeType="XML"
            attributeName="fill"
            values="#800;#f00;#800;#800"
            dur="2s"
            repeatCount="indefinite"/>
        `
    }

    // On récupère les icons depuis le fichier vaximpact_assets.js
    this.body = BODY_ICON.format(color, animate_str)
    this.bed = BED_ICON.format(color, animate_str)
    this.virus = VIRUS_ICON.format(color, animate_str)

    for(let i = 0; i < number; i++)
    {
        icons = icons + this[icon_name]; 
    }

    return icons; 
}

// Converts date from format YYYY-MM-dd to dd-MM-YYYY
function format_date(date)
{
    return date.substring(8,10) + "/" + date.substring(5,7) + "/" + date.substring(0,4);
}

function format_date_to_day_month(date)
{
    const formatter = new Intl.DateTimeFormat('fr', { month: 'short' });
    var date = new Date(date);
    return getDoubleDigit(date.getDate()) + " " + formatter.format(date)
}

// Permet de remplir les dates de début / fin de semaine et de mise à jour.
function populate_dates(data, week_max){
    var min_format = format_date(data["data_by_week"][week_max]["week_start_date"]);
    var max_format = format_date(data["data_by_week"][week_max]["week_end_date"]);
    var json_format = format_date(data["last_updated"]);

	for (element of document.getElementsByClassName('date-data-start'))
	{element.innerHTML = min_format;}

    for (element of document.getElementsByClassName('date-data-end'))
	{element.innerHTML = max_format;}
	
    for (element of document.getElementsByClassName('date-maj-json'))
	{element.innerHTML = json_format;}

}

// Permet de modifier les chiffres lorsque l'on bascule le slider.
function sliderShifted(slider) {
    var field = slider.getAttribute("tab_name");
    var detail_field = slider.getAttribute("field_name");
    var multiplier = slider.value;
    var icon_type = slider.getAttribute("icon_type");
    var non_vax_value = slider.getAttribute("non_vax_value");
    
    // Generating new icons
    var vax_icons = get_icons(icon_type, multiplier, LIGHT_BLUE);
    var non_vax_icons = get_icons(icon_type, non_vax_value*multiplier, "orange");

    // Updating title
    document.getElementById(field).querySelector('#chiffre_vax').innerHTML = `${parseFloat(multiplier).toFixed(0)} ${detail_field}`;
    document.getElementById(field).querySelector('#chiffre_non_vax').innerHTML = `${parseFloat(non_vax_value*multiplier).toFixed(0)} ${detail_field}.`;
    for (element of document.getElementById(field).getElementsByClassName('cumul_on')) {element.innerHTML = "cumulé(e)(s) sur {0} jour".format(multiplier)};

    // Updating icons in figures
    document.getElementById(field).querySelector('#figure_vax').innerHTML = vax_icons;
    document.getElementById(field).querySelector('#figure_non_vax').innerHTML = non_vax_icons;
}

// Replaces data if calculation can't be made
function no_data(template, age, json_data_field, slider, raw_data, last_week, groupe1, groupe2)
{
    
    var list_to_clean=["#description", '#chiffre_vax_evitables', '#group', '#premiere_conclu', '#conclusion', '#figure_wrap', '#button_non_vax', '#button_pop_generale']

    for (item of list_to_clean)
    {
        if (template.querySelector(item))
        {
            template.querySelector(item).remove();
        }
    
    if (template.querySelector('#'+slider))
    {
        template.querySelector('#'+slider).remove();
    }
    if (template.querySelector("#slider_block")){
        template.querySelector("#slider_block").remove();
}   

    if(raw_data["data_by_week"][last_week]["data"][age][groupe1][json_data_field] == 0)
    {
        var message="<b> Aucun cas chez les vaccinés cette semaine ! </b> <br> <i> L'indicateur n'est donc pas calculable </i> ";
    }

    else if(raw_data["data_by_week"][last_week]["data"][age][groupe2][json_data_field] == 0)
    {
        var message="<b>L'indicateur n'est pas calculable avec les données de la semaine. </b> ";
    }
}

    var div_NaN = document.createElement("div");
    div_NaN.setAttribute("id", "victory_message")
    div_NaN.setAttribute('style', "font-size: 18px; ")
    div_NaN.innerHTML=message;
    template.querySelector('#block_maj').parentNode.insertBefore(div_NaN,template.querySelector('#block_maj'));
}

</script>