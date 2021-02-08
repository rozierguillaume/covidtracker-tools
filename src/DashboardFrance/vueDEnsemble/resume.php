<div id="resume">
    <div id="echelleResume">
        Échelle :
        <div>
            <input id="radioLineaire" type="radio" data-type="lineaire" name="typeGraphique" checked>
            <label for="radioLineaire">Linéaire </label>
        </div>
        <div>
            <input id="radioLogarithnmique" type="radio" data-type="logarithmique" name="typeGraphique">
            <label for="radioLogarithnmique">Logarithmique </label>
        </div>
        <div>
            <input id="radioCroissance" type="radio" data-type="croissance" name="typeGraphique">
            <label for="radioCroissance">Croissance hebdo.</label>
        </div>
    </div>

    <p align="center">
        <div class="row charts lineaire">
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journ.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journ.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journ.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journ.jpeg" width="100%">
                </a>
            </div>
        </div>

        <div id="resumeLog" class="row charts logarithmique hidden">
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journlog.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journlog.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journlog.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journlog.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journlog.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journlog.jpeg" width="100%">
                </a>
            </div>
            <div class="col-md-6">
                <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journlog.jpeg" target="_blank" rel="noopener noreferrer">
                    <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journlog.jpeg" width="100%">
                </a>
            </div>
        </div>

    <div id="resumeCroissance" class="row charts croissance hidden">
        <div class="col-md-6">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journ_croissance.jpeg" target="_blank" rel="noopener noreferrer">
                <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journ_croissance.jpeg" width="100%">
            </a>
        </div>
        <div class="col-md-6">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ_croissance.jpeg" target="_blank" rel="noopener noreferrer">
                <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ_croissance.jpeg" width="100%">
            </a>
        </div>
        <div class="col-md-6">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ_croissance.jpeg" target="_blank" rel="noopener noreferrer">
                <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ_croissance.jpeg" width="100%">
            </a>
        </div>
        <div class="col-md-6">
            <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journ_croissance.jpeg" target="_blank" rel="noopener noreferrer">
                <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journ_croissance.jpeg" width="100%">
            </a>
        </div>
    </div>

    <!--    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dashboard_jour.jpeg" target="_blank" rel="noopener noreferrer">-->
    <!--        <img id="imageTab" src="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dashboard_jour.jpeg" width="100%">-->
    <!--    </a>-->
    </p>

    <script>
        jQuery(document).ready(function($){
            function affichageTypeGraphique()
            {
                $('#resume .charts').addClass('hidden');
                type = $('#echelleResume input:checked').data('type');
                $('#resume .charts.'+type).removeClass('hidden');
            }

            $('#echelleResume input').click(function(){
                affichageTypeGraphique();
            });

            affichageTypeGraphique();
        });
    </script>


    <b>Cas : </b>
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/cas_journ.html" target="_blank" rel="noreferrer noopener">Graphique interactif</a> —
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/cas_journ.jpeg" target="_blank" rel="noreferrer noopener">Image</a><br>

    <b>Hospitalisations : </b><br>
    Occupation :
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/hosp_journ.html" target="_blank" rel="noreferrer noopener">Graphique interactif</a> —
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ.jpeg" target="_blank" rel="noreferrer noopener">Image</a><br>
    Admissions :
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/hosp_journ_adm.html" target="_blank" rel="noreferrer noopener">Graphique
        interactif</a> -
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/hosp_journ_adm.jpeg" target="_blank" rel="noreferrer noopener">Image</a><br>

    <b>Réanimations : </b><br>
    Occupation :
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/rea_journ.html" target="_blank" rel="noreferrer noopener">Graphique interactif</a> —
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ.jpeg" target="_blank" rel="noreferrer noopener">Image</a><br>
    Admissions :
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/rea_journ_adm.html" target="_blank" rel="noreferrer noopener">Graphique interactif</a>
    -
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/rea_journ_adm.jpeg" target="_blank" rel="noreferrer noopener">Image</a><br>

    <b>Décès : </b>
    <a href="https://htmlpreview.github.io/?https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/html_exports/france/dc_journ.html" target="_blank" rel="noreferrer noopener">Graphique interactif</a> —
    <a href="https://raw.githubusercontent.com/rozierguillaume/covid-19/master/images/charts/france/dc_journ.jpeg" target="_blank" rel="noreferrer noopener">Image</a>
</div>

