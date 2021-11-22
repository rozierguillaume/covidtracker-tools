<div shadow="" style="margin-top: 20px;">

    <?php include(__DIR__ . '/carte/carteJs.php'); ?>

    <div class="hidden">
        <?php include(__DIR__ . '/../DashboardDepartement/selectDepartements.php'); ?>
    </div>

    <div class="row nowrap" style="padding: 0px">
        <h3>Taux d'incidence</h3>
        <span id="descriptionCarte">Nombre de personnes testées positives sur les 7 derniers jours pour 100 000 habitants</span>, données du <span id="dateCarte">--/--</span> (J-3)
        <br>
        <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                alt="un triangle aux trois côtés égaux"
                height="87px"
                width="130px" 
            />
    </div>
    <div class="row nowrap text-center" style="padding: 20px; 0px">
        <div class="text-center">
            <div class="col-xs-10 col-md-6 col-md-offset-3">
                <div id="carte">
                    <?php include(__DIR__ . '/../DashboardDepartement/carteDepartements.php'); ?>
                </div>
            </div>
            <div id="legendeCarte" class="col-xs-2"></div>
        </div>
    </div>

    Plus d'informations sur le <a href="https://covidtracker.fr/dashboard-departements">Dashboard Départements</a>
</div>

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->