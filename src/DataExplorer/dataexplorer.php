<!-- wp:html -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/google-palette/1.1.0/palette.js" integrity="sha512-C8lBe+d5Peg8kU+0fyU+JfoDIf0kP1rQBuPwRSBNHqqvqaPu+rkjlY0zPPAqdJOLSFlVI+Wku32S7La7eFhvlA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" integrity="sha512-XXtRBFtk/QfR8GEWwQPYjrQBHQwjidXg0wo8HJi9YOaFycWqd2uWkjJoAyx8Mb/+H8uhvmf70EAIxDnQxrwrvw==" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

<p style="font-size:130%;">CovidExplorer est un outil de CovidTracker permettant d'explorer les données de l'épidémie en France. Trois modules sont proposés : <i>Territoires</i>, <i>Tranches d'âge</i> et <i>Types</i>.
Le premier, ci-dessous, permet de comparer plusieurs territoires (régions, départements, France entière) entre eux.
Le deuxième, plus bas, permet d'explorer l'évolution de l'épidémie dans les tranches d'âge. Le troisième, en bas de page, permet d'explorer les différents types de données.

<i>Dernière donnée : <span id="dateDonnee">--/--</span>. Données : Santé publique France.</i></p>

<?php include(__DIR__ . '/styles.php'); ?>

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

<br><br>

<h3 id="territoires">Explorez les territoires</h3>
<p>Sélectionnez un type de données ainsi qu'un ou plusieurs territoires ci-dessous, puis la courbe s'affichera à droite (ou en-dessous sur mobile). 
</p>

<?php include(__DIR__ . '/dataexplorer_territoires.php'); ?>

<br><br><br>
<h3 id="ages">Explorez les tranches d'âge</h3>
<?php include(__DIR__ . '/dataexplorer_age.php'); ?>

<br><br><br>
<h3 id="types">Explorez les types de données</h3>
<?php include(__DIR__ . '/dataexplorer_types.php'); ?>

<?php include(__DIR__ . '/menuBasPage.php'); ?>
