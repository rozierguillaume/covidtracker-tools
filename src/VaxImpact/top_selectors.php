
<div class="row">
    <div class="col-md-10 col-lg-12 col-xs-12">
        <select id="select_region" class="selectors" autocomplete="off" onchange="selectRegion(this)" style="display:none;">

            <optgroup label="France">
                <option selected="selected" value="FR">Toute la France</option>
            </optgroup>
            
            <optgroup label="Régions" disabled="disabled">
                <option value="ARA">Auvergne-Rhône-Alpes</option>
                <option value="BFC">Bourgogne-Franche-Comté</option>
                <option value="BRE">Bretagne</option>
                <option value="COR">Corse</option>
                <option value="CVL">Centre-Val de Loire</option>
                <option value="GES">Grand Est</option>        
                <option value="GUA">Guadeloupe</option>
                <option value="GUY">Guyane</option>
                <option value="HDF">Hauts-de-France</option>
                <option value="IDF">Ile-de-France</option>        
                <option value="LRE">La Réunion</option>
                <option value="MAR">Martinique</option>
                <option value="MAY">Mayotte</option>
                <option value="NAQ">Nouvelle-Aquitaine</option>
                <option value="NOR">Normandie</option>
                <option value="OCC">Occitanie</option>
                <option value="PAC">Provence-Alpes-Côte d'Azur</option>
                <option value="PDL">Pays de la Loire</option>
            </optgroup>

        </select>


        <select id="select_age" class="selectors" autocomplete="off" onchange="selectAge(this)">

            <optgroup label="Tout âge">
                <option selected="selected" value="all">Tous les âges</option>
            </optgroup>
            
            <optgroup label="Par classe d'âge">
                <option value="[0,19]">0 - 19 ans</option>
                <option value="[20,39]">20 - 39 ans</option>
                <option value="[40,59]">40 - 59 ans</option>
                <option value="[60,79]">60 - 79 ans</option>
                <option value="[80;+]">80 ans ou plus</option>
            
            </optgroup>

        </select>
         <select id="select_groupes" class="selectors" autocomplete="off" onchange="selectAge(this)">
            <option value="vaccinés sans rappel vs non vaccinés" selected="selected">Vaccinés sans rappel vs. non vaccinés</option>

            <option value="vaccinés avec rappel vs non vaccinés">Vaccinés avec rappel vs. non vaccinés</option>
            <option value="vaccinés avec rappel vs vaccinés sans rappel" >Vaccinés avec rappel vs. vaccinés sans rappel</option>
            
        

        </select>
    </div>
</div>