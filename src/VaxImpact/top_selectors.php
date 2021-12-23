
<div class="row">
    <div class="col-md-10 col-lg-12 col-xs-12">
       


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
            <option value="vaccinés avec rappel vs non vaccinés" selected="selected">Vaccinés avec rappel vs. non vaccinés</option>
            <option value="vaccinés avec rappel vs vaccinés sans rappel" >Vaccinés avec rappel vs. vaccinés sans rappel</option>
            <option value="vaccinés sans rappel vs non vaccinés">Vaccinés sans rappel vs. non vaccinés</option>

            
        

        </select>
    </div>
</div>