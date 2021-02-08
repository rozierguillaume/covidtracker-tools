<!-- wp:spacer {"height":20} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading -->
<h1 id="dashboard">Vue d'ensemble</h1>
<!-- /wp:heading -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size">Ce graphique est une bonne vue d'ensemble de la situation en France. Il permet en un coup d'œil de suivre le nombre de cas détectés au Covid19, le nombre de personnes hospitalisées, en réanimation ou décédées à cause de la Covid19.</p>
<!-- /wp:paragraph -->


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item active">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#resume" role="tab" aria-controls="home" aria-selected="true">
            Résumé
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#evolution" role="tab" aria-controls="profile" aria-selected="false">
            Évolution quotidienne
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#malades" role="tab" aria-controls="contact" aria-selected="false">
            Situation actuelle des malades
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane active in" id="resume" role="tabpanel" aria-labelledby="resume-tab">
        <?php include(__DIR__.'/vueDEnsemble/resume.php'); ?>
    </div>
    <div class="tab-pane fade" id="evolution" role="tabpanel" aria-labelledby="evolution-tab">
        <?php include(__DIR__.'/vueDEnsemble/evolution.php'); ?>
    </div>
    <div class="tab-pane fade" id="malades" role="tabpanel" aria-labelledby="malades-tab">
        <?php include(__DIR__.'/vueDEnsemble/situationActuelleMalades.php'); ?>
    </div>
</div>

<!-- wp:spacer {"height":20} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<p>Ce graphique permet de visualiser en un coup d'oeil la situation de chaque département : </p>
<p id="line_metropoles" align="center"><a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/evolution_deps/evolution_deps_0.jpeg" target="_blank" rel="noopener noreferrer"><img src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/evolution_deps/evolution_deps_0.jpeg" style="max-width: 2000px;" width="100%"></a></p>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

