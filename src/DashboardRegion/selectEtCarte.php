<div id="menu" class="row">
    <div class="col-md-6 col-md-push-6" style="padding-top: 20px;">
        <p>
            Retrouvez les graphiques CovidTracker pour les régions de votre choix :
        <ul>
            <li>évolution des cas positifs, des hospitalisations, des personnes en réanimation et des décès quotidiens,</li>
            <li>évolution du taux d'occupation en réanimation.</li>
        </ul>
        Sélectionnez les régions que vous souhaitez consulter à l'aide du menu déroulant ci-dessous
        ou en cliquant directement sur la carte de France métropolitaine.
        </p>
        <div class="text-center">
            <select multiple="multiple" name="regions_list_choice" id="listeRegions" class="select2">
                <option data-num="84" value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
                <option data-num="27" value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
                <option data-num="53" value="Bretagne">Bretagne</option>
                <option data-num="24" value="Centre">Centre</option>
                <option data-num="94" value="Corse">Corse</option>
                <option data-num="44" value="Grand Est">Grand Est</option>
                <option data-num="01" value="Guadeloupe">Guadeloupe</option>
                <option data-num="03" value="Guyane">Guyane</option>
                <option data-num="32" value="Hauts-de-France">Hauts-de-France</option>
                <option data-num="11" value="Ile-de-France">Ile-de-France</option>
                <option data-num="04" value="La Réunion">La Réunion</option>
                <option data-num="02" value="Martinique">Martinique</option>
                <option data-num="06" value="Mayotte">Mayotte</option>
                <option data-num="28" value="Normandie">Normandie</option>
                <option data-num="75" value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                <option data-num="76" value="Occitanie">Occitanie</option>
                <option data-num="52" value="Pays de la Loire">Pays de la Loire</option>
                <option data-num="93" value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
            </select>
            <br>
            <br>
            <btn class="btn btn-primary" id="selectAll">
                Tout sélectionner
            </btn>
            <btn class="btn btn-primary" id="unselectAll">
                Tout désélectionner
            </btn>
            <br>
        </div>
    </div>

    <div class="col-md-6 col-md-pull-6" style="padding-top: 20px;">
        <div class="row">
            <div class="col-xs-10">
                <div id="carte">
                    <?php include(__DIR__ . '/dashboardRegionCarteSvg.php');?>
                </div>
            </div>
            <div class="col-xs-2">
                <div id="legendeCarte"></div>
            </div>
        </div>
    </div>


</div>

<script id="legendTemplatePre" type="text/template">
    <table>
        <tbody>
</script>

<script id="legendTemplateMid" type="text/template">
    <tr>
        <td style="text-align: center; background-color: colorBg; color: white; font-size: 50%; padding: 5px;">valeur
        </td>
    </tr>
</script>

<script id="legendTemplatePost" type="text/template">
    </tbody>
    </table>
</script>