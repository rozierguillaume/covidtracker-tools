<!--- Template graphique -->
<template id="template_graphique">
    <h3 class="title emphasis" style="margin-top: 20px;">Indicateurs</h3>
    <p id="title" style=""></p>
    <div style="width: 100%; max-width: 1000px; text-align:center;">
        <a id="link" target="_blank" rel="noopener noreferrer">
            <img id="imageTab" id="graph_img" width="75%">
        </a>
    </div>
</template>

<!--- Template risque relatif -->
<template id="template_reduction_risque">
    <div id="main_div_reduction_risque">
        <h3 class="title emphasis" id="title"></h3>
        <p id="description"></p>

            <div style="text-align:center; " id="slider_block">
                <input id="slider" class="slider" style="max-width: 500px; margin-top: 7px; text-align:center; display:inline-block; " type="range" min="1" max="50" step="1" value="1"; onchange="sliderShifted(this)" oninput="this.nextElementSibling.value = 'Jour '+ this.value; sliderShifted(this)">
                <output class="emphasis">Jour 1</output>
                    <!-- <div id="slider" style="max-width: 500px; margin-top: 7px; margin-left: 30px;" onclick="sliderShifted(this)"></div> -->
        </div>

        <div class="wrap" style="margin-top: 18px;" id="figure_wrap">

            <div class="boxshadow">
                <span id="groupe1" style="color:#4fafd9; font-size: 18px;">groupe-- </span><span style="color:#4fafd9; font-size: 18px; font-weight: bold;" id="chiffre_vax">--</span>
                <br>
                <span style="font-size: 15px;" class="cumul_on">cumulé(e)(s) sur 1 jour</span>
                <br>
                <div id="figure_vax" style="margin-top: 18px;"></div>
            </div>

            <div class="boxshadow">
                <span id="groupe2" style="color:orange; font-size: 18px;">groupe--</span><span style="color:orange; font-size: 18px; font-weight: bold;" id="chiffre_non_vax">--</span>
                <br>
                <span style="font-size: 15px;" class="cumul_on">cumulé(e)(s) sur 1 jour</span>
                <br>
                <div id="figure_non_vax" style="margin-top: 18px;"></div>
            </div>

        </div>

        <div style="font-size: 10px; margin-top: 10px; " id="block_maj">Mise à jour : <span class="date-maj-json"> -/-/- </span> • Dernières données : du <span class="date-data-start">-/-/-</span> au <span class="date-data-end">-/-/-</span> • Données DREES • VaxImpact.fr</div>

        <br>
        <p style="font-weight: bold; margin-top: 20px;" id="conclusion"></p>
    </div>
</template>

<!--- Template fraction etiologique -->
<template id="template_fraction_attribuable">
    <div id="main_div_fraction_attribuable">

        <h3 class="title emphasis" id="title"></h3>
        <p id="description"></p>

        <!-- <button id="button_non_vax" onclick="button_attribuable(this)" class="btn-actif btn_event" role="button" value="chez les non vaccinés">Chez les non vaccinés</button>
        <button id="button_pop_generale" onclick="button_attribuable(this)" class="btn-inactif btn_event" role="button" value="en population générale">En population générale</button>
         -->
        <div class="wrap" style="margin-top: 0px;" id="figure_wrap">

            <div class="boxshadow-wide" style="">
                <span style="color:black; font-size: 20px;"><span id="group">--</span> • </span>
                <span style="color:#800; font-size: 20px; font-weight: bold;"><span id="chiffre_vax_evitables">--</span> %</span>
                <br>
                <p id="premiere_conclu"></p>
                
                <div id="figure_vax" style="margin-top: 20px;"></div>
            </div>

        </div>

        <div style="font-size: 10px; margin-top: 10px;" id="block_maj">Mise à jour : <span class="date-maj-json"> -/-/- </span> • Dernières données : du <span class="date-data-start">-/-/-</span> au <span class="date-data-end">-/-/-</span> • Données DREES • VaxImpact.fr</div>
        
        <br>
        <p style="font-weight: bold; margin-top: 20px;" id="conclusion"></p>
    </div>
</template>
