<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="alert alert-info clearFix" style="font-size: 18px; margin-top:10px; margin-bottom:40px;">
    <div class="row">
        <div class="col-md-8">
            <small>NOUVEAU !</small>
            <br>
            <b>Explorez les données avec CovidExplorer</b>
            <br>
            Comment évolue le taux d'incidence dans votre département par rapport à votre région ? Quelle est la courbe des hospitalisations en France ?...<br>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn-shadow">
                <a href="https://covidtracker.fr/covidexplorer" target="_blank" rel="noreferrer noopener">Accéder à 🔎
                    <b>CovidExplorer</b></a>
            </button> &nbsp;&nbsp;
        </div>
    </div>
</div>

<?php include(dirname(__FILE__) . '/dashboardRegionJs.php') ?>
<?php include(dirname(__FILE__) . '/dashboardRegionCss.php') ?>
<?php include(dirname(__FILE__) . '/selectEtCarte.php') ?>
<?php include(dirname(__FILE__) . '/templateRegion.php') ?>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<div id="donneesRegions">

</div>
