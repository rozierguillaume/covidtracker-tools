
<h2 style="margin-top : 80px;">Évolution</h2>
Pour vacciner l'ensemble de la population adulte (52 millions de personnes) d'ici à août 2021, il faudrait injecter <b><span id="objectif_quotidien">--</span> doses</b> chaque jour.
<br>
Au rythme actuel <small>(moyenne des 15 derniers jours)</small>, l'objectif de vacciner l'ensemble de la population adulte serait atteint le <b><span id="date_projetee_objectif"></span></b>.

<br><br>
Le graphique suivant présente le nombre cumulé de personnes ayant reçu au moins une dose de vaccin.
<br><i><small>Les premières doses sont comptabilisées par date d'injection, les secondes doses par date de remontée. Des écarts peuvent donc être observés avec la réalité.</small></i>
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
        <select class="form-control" name="type" id="type" onchange="typeDonneesChart()">
            <option value="cumul"><b>Cumul</b> vaccinés</option>
            <option value="quotidien">Vaccinations quotidiennes</option>
        </select>
    </div>
</div>

<div class="chart-container" style="position: relative; width:100%">
    <canvas id="lineVacChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
</div>

Auteur : CovidTracker.fr - Données : Ministère de la Santé<br>
<small>(1) : les projections sont réalisées en supposant que le rythme reste constant et similaire aux deux dernières semaines. Ce ne sont en aucun cas des prédictions.</small>
