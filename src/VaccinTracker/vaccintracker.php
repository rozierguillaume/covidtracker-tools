<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"
        integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>

<?php include(__DIR__ . '/vaccintrackerCss.php'); ?>

<!-- wp:html -->

<p>Quelle proportion des Français a été vaccinée ? Combien faut-il encore vacciner de personnes avant d'atteindre
    l'immunité collective ? Quels sont les différents types de vaccins proposés ? Ce tracker permet de suivre la proportion de Français déjà vaccinés contre la Covid19. VaccinTracker est une initiative citoyenne indépendante et
    non officielle.
</p>

<div id="news"></div>

<div class="alert alert-info clearFix" style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            Bonne année 2021 ! CovidTracker est gratuit, sans pub et développé bénévolement.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://lydia-app.com/collect/covidtracker/fr" target="_blank" rel="noreferrer noopener">🍩
                    Offrez-moi un donut</a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>


<!-- /wp:html -->

<?php include(__DIR__.'/resume.php'); ?>
<?php include(__DIR__.'/proportionVaccines.php'); ?>
<?php include(__DIR__.'/evolution.php'); ?>
<h2 style="margin-top : 80px;">
    Répartition des vaccinés
</h2>

<div class="" style="margin-bottom: 40px;">
    Coloration en fonction du pourcentage de population vaccinée.
    Données fournies par le Ministère de la Santé.
    Cliquez sur une région pour afficher plus de détails.
</div>
<br>

<center>
<div id="choixCarte">
    <div class="btn-group" role="group" aria-label="Choix carte">
        <button id="choixCarteDepartement" type="button" class="btn btn-secondary active">
            Par département
        </button>
        <button id="choixCarteRegion" type="button" class="btn btn-secondary">
            Par région
        </button>
    </div>
</div>
</center>

<div id="blocCarteDepartement">
    <?php include(__DIR__ . '/carteDepartement.php') ?>
</div>
<div id="blocCarteRegion" class="hidden">
    <?php include(__DIR__ . '/carteRegion.php') ?>
</div>
<div class="alert alert-info clearFix" style="font-size: 18px;">
    <div class="row">
        <div class="col-md-8">
            <small>À VOIR AUSSI...</small>
            <br>
            Combien de personnes reste-t-il à vacciner avant vous ? Estimez votre temps d'attente en fonction du rythme
            actuel de vaccination.<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/vaccinplanner" target="_blank" rel="noreferrer noopener">Accéder à 🗓
                    <b>VaccinPlanner</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>
<?php include(__DIR__ . '/vaccinationsParAge.php') ?>

<div class="alert alert-warning" style="font-size: 18px; margin-top:40px; margin-bottom: 20px;">
    <b>29 janvier - Information sur les données.</b> <i>Provenance des données</i> : jusqu’alors les données étaient
    remontées manuellement par les ARS au Ministère de la Santé. Désormais, le Système d’Information VAC-SI est utilisé.
    De petits écarts peuvent temporairement être observés le temps que toutes les données soient saisies. Les données du
    jour concerneront désormais J-1. <i>Type des données</i> : les données concernent désormais le nombre de personnes
    ayant reçu une dose (non plus le nombre de doses injectées). <a
            href="https://solidarites-sante.gouv.fr/actualites/presse/communiques-de-presse/article/le-suivi-de-la-couverture-vaccinale-desormais-opere-via-vaccin-covid">Plus
        d'informations</a>.
</div>

<?php include(__DIR__ . '/vaccin-map.html') ?>
<?php include(__DIR__ . '/autorisations.php') ?>
<?php include(__DIR__ . '/immuniteCollective.php') ?>
<?php include(__DIR__ . '/dansLeMonde.php') ?>
<br>
<br>
<?php include(__DIR__ . '/vaccintrackerJs.php'); ?>
<?php include(__DIR__ . '/menuBasPage.php'); ?>
<!-- /wp:html -->
<br>
Contributeurs de VaccinTracker : Aymerik Diebold, Florent Jaby, <a href="https://twitter.com/guillaumerozier">Guillaume
    Rozier</a>, Michael Souvy.
<br>
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link"
                                                 href="https://lydia-app.com/collect/covidtracker/fr" target="_blank"
                                                 rel="noreferrer noopener">☕️ Offrez-moi un café</a></div>

<!-- wp:spacer -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
