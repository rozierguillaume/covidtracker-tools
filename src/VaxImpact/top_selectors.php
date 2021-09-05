
<div class="row">
    <div class="col-md-10 col-lg-8 col-xs-12">
        <select id="select_region" class="selectors" autocomplete="off" onchange="selectRegion(this)">

            <optgroup label="France">
                <option selected="selected" value="FR">Toute la France</option>
            </optgroup>
            
            <optgroup label="Régions">
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
    </div>
</div>