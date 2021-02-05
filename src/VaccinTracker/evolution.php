
<h2 style="margin-top : 80px;">Évolution</h2>
Pour vacciner l'ensemble de la population adulte (52 millions de personnes) d'ici à août 2021, il faudrait injecter <b><span id="objectif_quotidien">--</span> doses</b> chaque jour.
<br>
Au rythme actuel <small>(moyenne des 7 derniers jours)</small>, l'objectif de vacciner l'ensemble de la population adulte serait atteint le <b><span id="date_projetee_objectif"></span></b>.

<br><br>
Le graphique suivant présente le nombre cumulé de personnes ayant reçu au moins une dose de vaccin. <small>Les premières doses sont comptabilisées par date d'injection, les secondes doses par date de remontée. Des écarts peuvent donc être observés avec la réalité.</small>
<br>
<br>

<div>
    <!--
    <div style="float:left; margin-left: 3px; margin-right:15px;">
        <input type="checkbox" id="objectif" name="objectif" onchange="ajouterObjectifAnnotation()">
        <label for="objectif" style="font-weight: normal;">Afficher objectif</label>
    </div>
-->
    <div>
        <select name="type" id="type" onchange="typeDonneesChart()">
            <option value="cumul"><b>Cumul</b> vaccinés</option>
            <option value="quotidien">Vaccinations quotidiennes</option>
        </select>
    </div>
</div>

<div class="chart-container" style="position: relative; height:60vh; width:100%">
    <canvas id="lineVacChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
</div>

Auteur : CovidTracker.fr - Données : Ministère de la Santé