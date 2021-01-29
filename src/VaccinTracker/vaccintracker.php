<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"
        integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>
<?php include(__DIR__ . '/vaccintrackerJs.php'); ?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<?php include(__DIR__ . '/vaccintrackerStyles.php'); ?>
<!-- wp:html -->

<p>Quelle proportion des Français a été vaccinée ? Combien faut-il encore vacciner de personnes avant d'atteindre l'immunité collective ? Quels sont les différents types de vaccins proposés ?
Ce tracker permet de suivre la proportion de Français déjà vaccinés contre la Covid19, et le nombre de personnes restant à vacciner pour atteindre l'immunité collective. VaccinTracker est une initiative citoyenne indépendante et non officielle.
</p>

<!--
<div style="margin-bottom: 20px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 7px; padding: 10px; background-color: rgba(0, 0, 0, 0.05);">
<b>11 janvier - Message important sur les données</b><br>
Lors du lancement de VaccinTracker le 27 décembre (jour du début de la campagne vaccinale), initiative indépendante, aucune donnée officielle de vaccination n’était disponible. Nous avons alors commencé à chercher, collecter et sommer les données publiées notamment dans la presse locale. Le Ministère de la Santé a contacté CovidTracker le 30 décembre afin de lui fournir des données officielles, plus exhaustives et à jour. Depuis, nous recevons régulièrement un nouveau chiffre du nombre de vaccinés de sa part, et nous le remercions pour cela. Cependant, cette situation n’est pas conforme avec nos principes d’OpenData. <b>VaccinTracker ne sera désormais mis à jour qu’à partir de données publiques officielles, dès que celles-ci seront disponibles.</b>
</div>
-->

<div id="news"></div>

<div class="alert alert-info clearFix"  style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍩 Offrez-moi un donut</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<div class="alert alert-warning"  style="font-size: 18px;">
    <b>Information sur les données.</b> Jusqu'alors le Ministère de la Santé communiquait un chiffre <a href="https://solidarites-sante.gouv.fr/actualites/presse/communiques-de-presse/article/vaccination-contre-la-covid-en-france-au-24-janvier-2021-plus-de-1-026-000">présenté</a> comme le "nombre de personnes vaccinées". Il apparaît que ce chiffre corresponde plutôt au nombre de doses injectées (deux doses sont nécessaires pour vacciner une personne) (<a href="https://www.leparisien.fr/societe/covid-19-pourquoi-le-nombre-de-personnes-vaccinees-n-est-pas-vraiment-celui-qu-on-croit-25-01-2021-8421084.php#xtor=AD-1481423553">Le Parisien</a>). Le vocabulaire présent sur cette page a donc été adapté en ce sens.
</div>
<!-- /wp:html -->

<!-- wp:html -->
<?php include(__DIR__ . '/resume.php') ?>
<?php include(__DIR__ . '/proportionVaccines.php') ?>
<?php include(__DIR__ . '/evolution.php') ?>

<div id="blocDepartments">
    <?php include(__DIR__ . '/carteDepartement.php') ?>
</div>
<div id="blocRegions">
    <?php include(__DIR__ . '/carteRegion.php') ?>
</div>

<div class="alert alert-info clearFix"  style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            <small>À VOIR AUSSI...</small><br>
            Combien de personnes reste-t-il à vacciner avant vous ? Estimez votre temps d'attente en fonction du rythme actuel de vaccination.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/vaccinplanner" target="_blank" rel="noreferrer noopener">Accéder à 🗓 <b>VaccinPlanner</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<?php include(__DIR__ . '/vaccin-map.html') ?>
<?php include(__DIR__ . '/autorisations.php') ?>
<?php include(__DIR__ . '/immuniteCollective.php') ?>
<?php include(__DIR__ . '/dansLeMonde.php') ?>


<!-- /wp:html -->
<!-- wp:html -->
<?php include(__DIR__ . '/menuBasPage.php'); ?>
<!-- /wp:html -->
<br>
Contributeurs de VaccinTracker : Aymerik Diebold, Florent Jaby, <a href="https://twitter.com/guillaumerozier">Guillaume Rozier</a>, Michael Souvy.
<br>
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">☕️ Offrez-moi un café</a></div>

<!-- wp:spacer -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
