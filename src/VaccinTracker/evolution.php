
<h2 style="margin-top : 80px;">Évolution</h2>
Pour vacciner l'ensemble de la population adulte (52 millions de personnes) d'ici à août 2021, il faudrait injecter <b><span id="objectif_quotidien">--</span> doses</b> chaque jour.
<br>
Au rythme actuel <small>(moyenne des 15 derniers jours)</small>, l'objectif de vacciner l'ensemble de la population adulte serait atteint le <b><span id="date_projetee_objectif"></span></b>.

<br><br>
Le graphique suivant présente le nombre cumulé de personnes ayant reçu au moins une dose de vaccin.
<br>
<br>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="evolutionlist">
        <li role="presentation" class="active"><a href="#cumulvaccines" aria-controls="home" role="tab" data-toggle="tab">Cumul personnes vaccinées</a></li>
        <li role="presentation"><a href="#quotidien" aria-controls="profile" role="tab" data-toggle="tab">Injections quotidiennes</a></li>
        <li role="presentation"><a href="#cumul" aria-controls="profile" role="tab" data-toggle="tab">Cumul injections</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="cumulvaccines">
            <div class="chart-container" style="position: relative; width:100%">
                <h3>Nombre cumulé de personnes vaccinées</h3>
                <canvas id="lineVacChart" style="margin-top:20px; max-height: 700px; "></canvas>
            </div>
            <small>Les projections sont réalisées en supposant que le rythme reste constant et similaire aux deux dernières semaines. Ce ne sont en aucun cas des prédictions.</small>
        </div>
        <div role="tabpanel" class="tab-pane" id="quotidien">
            <div class="chart-container-quot" style="position: relative; width:100%">
                <h3>Nombre d'injections de vaccin effectuées chaque jour</h3>
                <canvas id="lineVacChartQuot" style="margin-top:20px; max-height: 700px; "></canvas>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cumul">
            <div class="chart-container-quot" style="position: relative; width:100%">
                <h3>Nombre cumulé d'injections et livraisons de doses</h3>
                <canvas id="lineVacChartCum" style="margin-top:20px; max-height: 700px; "></canvas>
            </div>
        </div>
    </div>

</div>




Auteur : CovidTracker.fr - Données : Ministère de la Santé<br>
