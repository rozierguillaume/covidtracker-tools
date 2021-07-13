<?php include(dirname(__DIR__) . '/message_erreur.php') ?>

<div id="menu" class="row">
    <div class="col-md-4 col-md-push-7" style="padding-top: 20px;">
        <p>
            Retrouvez les graphiques CovidTracker pour les départements de votre choix :
        <ul>
            <li>évolution des cas positifs, des hospitalisations, des personnes en réanimation et des décès
                quotidiens,
            </li>
            <li>heatmap des taux d'incidence,</li>
            <li>évolution du taux d'occupation en réanimation.</li>
        </ul>
        <p>
            Sélectionnez les départements que vous souhaitez consulter à l'aide du menu déroulant ou en cliquant
            directement
            sur la carte de France métropolitaine.
        </p>
        <div class="text-center">
            <?php include(dirname(__FILE__) . '/selectDepartements.php'); ?>
            <div style="margin-top: 20px; margin-bottom: 20px;">
                <btn class="btn btn-primary" id="selectAll">Tout sélectionner</btn>
                <btn class="btn btn-primary" id="unselectAll">
                    Tout désélectionner
                </btn>
            </div>
        </div>
    </div>
    <div class="col-md-8 text-center col-md-pull-5">
        <div class="row">
            <div class="col-xs-12">
                <div id="choixTypeCarte" class="btn-group" role="group">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle selected" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Cas <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li data-carte="incidence-cas">
                                <a href="#" class="selected">Taux d'incidence (4 couleurs)</a>
                            </li>
                            <li data-carte="incidence-cas-12-couleurs">
                                <a href="#" class="">Taux d'incidence (13 couleurs)</a>
                            </li>
                            <li data-carte="var_c1">
                                <a href="#" class="">Variant Delta</a>
                            </li>
                            <li data-carte="evolution-cas"><a href="#">Évolution du taux d'incidence</a></li>
                            <li data-carte="taux-positivite-restreint"><a href="#">Taux de positivité</a></li>
                            <!--<li data-carte="taux-positivite"><a href="#">Taux de positivité (13 couleurs)</a></li> --> 
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Vaccinations <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li data-carte="n_dose1_cumsum_pop"><a href="#">Proportion partiellement vaccinés</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Hospitalisations <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li data-carte="incidence-hospitalisations"><a href="#">Admissions</a></li>
                            <li data-carte="lits-hospitalisations"><a href="#">Occupation</a></li>
                            <li data-carte="evolution-lits-hospitalisations"><a href="#">Évolution de l'occupation</a>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Réanimations <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li data-carte="incidence-reanimations"><a href="#">Admissions</a></li>
                            <li data-carte="saturation-reanimations"><a href="#">Taux d'occupation</a></li>
                            <li data-carte="lits-reanimations"><a href="#">Occupation</a></li>
                            <li data-carte="evolution-lits-reanimations"><a href="#">Évolution de l'occupation</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Décès <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li data-carte="incidence-deces"><a href="#">Taux d'incidence</a></li>
                            <li data-carte="evolution-deces"><a href="#">Évolution du taux d'incidence</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <span id="titreCarte"></span>
            
            <span id="descriptionCarte"></span> au 
            <span id="dateCarte">--/--</span>
            <br>
            <img
                src="https://files.covidtracker.fr/covidtracker_vect.svg"
                alt="un triangle aux trois côtés égaux"
                height="87px"
                width="130px" 
            />
            <br>
            <br>
            <div class="col-xs-10">
                <div id="carte">
                    <?php include(__DIR__ . '/carteDepartements.php'); ?>
                </div>
                CovidTracker.fr - Données : Santé publique France
                <div id="droitsCarte" style="font-size: 8px; font-style: italic; margin-top: 30px; ">
                    Carte adaptée à partir d'une création <a target="_blank"
                                                             href="https://fr.wikipedia.org/wiki/Fichier:Carte_vierge_d%C3%A9partements_fran%C3%A7ais_avec_DOM.svg">Wikipedia</a>
                </div>
            </div>
            <div id="legendeCarte" class="col-xs-2">
            </div>
        </div>
    </div>
</div>