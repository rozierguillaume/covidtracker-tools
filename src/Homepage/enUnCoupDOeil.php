<h2>En un coup d'œil</h2>
Mise à jour : <span id="date_update_coup_doeil2">-/-</span>
<div style="text-align: center; width:100%; border-radius: 7px; padding: 0px 0px;"></div>

<div class="wrap" shadow="">
    <div class="one">
        <h2 id="taux_incidence">--</h2>
        <span id="taux_incidence_str" style="font-size: 60%;">-- ET --</span><br>
        <p><b>Taux d'incidence</b><br><span style="font-size: 85%">Nombre de cas par semaine pour 100k habitants. Le seuil d'alerte est 50.</span></p>
    </div>

    <div class="one">
        <h2 id="taux_positivite">--</h2>
        <span id="taux_positivite_str" style="font-size: 60%;">-- ET --</span><br>
        <p><b>Taux de positivité</b><br><span style="font-size: 85%">Proportion des tests qui sont positifs parmi l'ensemble des tests.</span></p>
    </div>

    <div class="two">
        <h2 id="reffectif">--</h2>
        <span id="reffectif_str" style="font-size: 60%;">-- ET --</span><br>
        <p><b>Taux de reproduction R</b><br><span style="font-size: 85%">Nombre de personnes contaminées par 1 malade. Au-dessus de R=1, l'épidémie progresse.</span></p>
    </div>

    <div class="three">
        <h2 id="sat_rea">--%</h2>
        <span id="sat_rea_str" style="font-size: 60%;">-- ET --</span><br>
        <p><b>Tension hospitalière</b><br><span style="font-size: 85%">Nombre de lits de réanimation occupés par les patients Covid19 par rapport au nombre de lits fin 2018.</span></p>
    </div>
</div>
<br>

<div class="container" style="text-align: center; width:100%; border-radius: 7px; padding: 0px 0px;">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-6">
            <div style="text-align: left; margin-top:5px;" shadow="">
                <div class="row flex-nowrap">
                        <div class="col-xs-7" style="">
                            <centering><h3>Cas positifs</h3></centering>
                        </div>

                        <div class="col-xs-5" style="text-align: right;">
                        <div id="choixDonneesCas" class="btn-group" role="group" style="margin-top: 5px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle selected" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Plus
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li data-carte="cas-btn" onclick="dataSelectedCas('cas')">
                                        <a id="cas-btn" class="selected">En date de prélèvement</a>
                                    </li>
                                    <li data-carte="cas_spf-btn" onclick="dataSelectedCas('cas_spf')">
                                        <a id="cas_spf-btn" class="">En date de remontée</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <p><span id="cas_p1"></span> <b>
                        <span id="cas_moyen_quotidien">--</span> tests</b>
                    positifs au Covid19 <span id="cas_p2"></span>chaque jour,
                    <span id="croissance_cas">--</span>
                    par rapport à la semaine dernière <span id="type_jour"></span>.
                </p>

                <div>
                    <canvas id="lineCasChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
                <br>
                <span style="font-size: 100%">Derniers chiffres :
                <span id="cas_opencovid">--</span> tests positifs remontés le
                <span id="date_opencovid">-/-</span> (SpF),
                <span id="cas_sidep">--</span> tests positifs prélevés le
                <span id="date_sidep">-/-</span> (SI-DEP).
            </span>

            </div>
        </div>
        <div class="col-md-6">
            <div style="text-align: left; margin-top:5px;" shadow="">
                <div class="row flex-nowrap">
                    <div class="col-xs-7" style="">
                        <centering><h3 id='titreHospitDiv'>--</h3></centering>
                    </div>

                    <div class="col-xs-5" style="text-align: right;">
                        <div id="choixDonneesHospit" class="btn-group" role="group" style="margin-top: 5px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle selected" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Plus
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li data-carte="reanimations" onclick="dataSelected('rea')">
                                        <a id="rea-ligne" class="selected">Réanimations</a>
                                    </li>
                                    <li data-carte="hospitalisations" onclick="dataSelected('hosp')">
                                        <a id="hosp-ligne" class="">Hospitalisations</a>
                                    </li>
                                    <li data-carte="dc-hospitaliers" onclick="dataSelected('dc')">
                                        <a id="dc-ligne" class="">Décès hospitaliers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <p>Il y a actuellement <b><span id="reanimations">--</span>
                        personnes <span id="typePersonnes">en réanimation</span></b> pour Covid19,
                    <span id="croissance_rea">--</span> par rapport à la semaine dernière.<br><br>
                </p>
                <div>
                    <canvas id="barChart" style="margin-top:20px; max-height: 700px; max-width: 900px;"></canvas>
                </div>
                <br><br><br>
            </div>
            
        </div>
    </div>
        
    <!-- wp:spacer {"height":30} -->
    <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
    Plus d'informations sur le <a href="https://covidtracker.fr/covidtracker-france">Dashboard France</a> et <a href="https://covidtracker.fr/deconfitracker">DéconfiTracker</a>. Mise à jour : <span id="date_update_coup_doeil">-/-</span>.
</div>

<!-- wp:spacer {"height":30} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

