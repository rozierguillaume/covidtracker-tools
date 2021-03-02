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