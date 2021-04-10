<?php include(__DIR__ . '/vitemadoseCss.php') ?>
<?php include(__DIR__ . '/vitemadoseJs.php') ?>

<p>
    Vite Ma Dose ! est un outil de CovidTracker permettant de détecter les rendez-vous disponibles dans votre département afin de vous faire vacciner (<a href="https://www.gouvernement.fr/etes-vous-eligible-a-la-vaccination-contre-la-covid-19" target="_blank" rel="noreferrer noopener">sous réserve d'éligibilité</a>). Pour l'instant, les plateformes supportées sont : Doctolib, Maiia, Keldoc et Ordoclic. <i>Vite Ma Dose ! n'est pas un outil officiel, n'est pas exhaustif et ne remplace pas une recherche manuelle.</i>
</p>
<br><br>

<div class="alert alert-info clearFix" style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            CovidTracker est gratuit, indépendant et sans publicité.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍪
                    Offrez-moi un cookie</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<form class="div-doses doses">
<div class="stats-vmd" id="stats-vmd"> 
    <div> <h2>-</h2> <div style="font-size: 15px;">centres ayant des disponibilités<br>en France</div> </div>
    <div> <h2>-</h2> <div style="font-size: 15px;">centres détectés<br>en France</div> </div> 
    <div> <h2>-%</h2> <div style="font-size: 15px;">de centres ayant des disponibilités<br>en France</div> </div> 
</div>
    <select id="dpt-select" class="dpt-select" >
        <option value="">Indiquez votre département</option>
    </select>

    <div id="rdv">
      <label for="dpt-select">pour commencer votre recherche, veuillez indiquer votre département.</label>
    </div>

</form>

<?php include(__DIR__ . '/carteCentres.html') ?>

<div class="alert alert-info clearFix"  style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            <small>À VOIR AUSSI...</small><br>
            Combien de personnes ont été vaccinées ? Suivez la campagne vaccinale sur VaccinTracker.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/vaccintracker" target="_blank" rel="noreferrer noopener">Accéder à 💉 <b>VaccinTracker</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>
<br>

<br>
Remerciement aux <a href="https://github.com/CovidTrackerFr/vitemadose/graphs/contributors">contributeurs</a>.<br>
Un bug ? Une idée d'amélioration ? Contributions bienvenues sur Github : <a href="https://github.com/rozierguillaume/covidtracker-tools/tree/main/src/ViteMaDose">front-end</a>, <a href="https://github.com/CovidTrackerFr/vitemadose">algorithme de détection</a>.
