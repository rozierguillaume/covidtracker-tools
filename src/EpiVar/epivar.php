
<style>
.btn-actif{
    border: 1px solid black;
    padding: 6px;
    border-radius: 5px;
    color:black;
}
.btn-inactif{
    border: 1px solid white;
    padding: 6px;
    border-radius: 5px;
    color:black;
}

.btn-inactif:hover{
    border: 1px solid black;
    background-color: lightgrey;
    padding: 6px;
    border-radius: 5px;
    color:white;
}


.shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        background: #ffffff;
        margin-top: 10px;
    }
    
p {
    font-size: 17px;
}
.wrap {
        display: flex;
        margin-top: 0px;
        flex-wrap: wrap;
    }
.wrap>* {
    flex: 1 1 200px;
}
.boxshadow {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        margin-right: 15px;
        max-width: 500px;
        text-align: left;
        /*box-shadow: 6px 4px 25px #c3d19d;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100%;
        background: #ffffff;
    }

.boxshadow-wide {
    border: 0px solid black;
    margin-top: 20px;
    padding: 10px 10px 10px 10px;
    border-radius: 7px;
    margin-right: 15px;
    max-width: 800px;
    text-align: left;
    /*box-shadow: 6px 4px 25px #c3d19d;*/
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    width: 100%;
    background: #ffffff;
}
.title_h2 {
    margin-top: 80px;
    margin-bottom: 10px;
}
.title {
    margin-top: 50px;
}
</style>

<body>

    <p><b>Cette page présente les résultats de EpiVar, un modèle autoregressif (VARX) appliqué à l'épidémie de Covid19.</b> Ce modèle n'est pas un modèle épidémiologique. Il est souvent utilisé en macro-économie, et réputé donner de bons résultats pour une projection de certains indicateurs à court-terme.
    <strong>Il ne faut en aucun cas considérer les résultats de ce modèle comme des prévisions fiables, mais plutôt comme des projections possibles. </strong></p>
    <p>Notons que ce modèle est meilleur pour projeter les admissions à l'hôpital, en soins critiques, et les décès que les cas positifs, car ces variables dépendent en partie des cas passés (ceux-ci étant certains, car déjà observés). Par ailleurs, en l'absence de choc particulier, le modèle aura tendance à stabiliser les cas : par exemple en période de hausse épidémique, il aura tendance à projeter un pic de cas un peu plus tôt, ou un peu plus bas que ce qui devrait se réaliser.</p>
    <p>Par ailleurs, ces modélisations ne prennent en compte aucun événement ou donnée autres que l'évolution passée de l'épidémie, et la vaccination. Ainsi, l'effet des conditions météo, de certains événements (fêtes de fin d'année, rassemblements, voyages…), mesures et restrictions etc. sont ignorés.</p>
    <p>La zone bleue correspond à l'intervalle de confiance de la projection : le collier bleu le plus foncé et étroit est associé à une confiance de 75 %, et celui le plus clair et large une confiance de 97 %.</p>
    <br>
    <h2>Résultats du modèle</h2>

    <div style="border-radius: 15px; border: 1px solid grey; padding: 5px; max-width: 950px;"><img src="https://raw.githubusercontent.com/CovidTrackerFr/forecast/main/output/model_booster_fit.png" style="max-width: 900px;"/></div>
    <br>
    <h2>Résultats de la semaine dernière</h2>
    <p>Ci-dessous les résultats produits par le modèle il y a 7 jours, comparés aux valeurs réelles observées. Cela permet de mesurer la justesse du modèle.</p>
    <div style="border-radius: 15px; border: 1px solid grey; padding: 5px; max-width: 950px;"><img src="https://raw.githubusercontent.com/CovidTrackerFr/forecast/main/output/model_booster_lastweek_fit.png" style="max-width: 900px;"/></div>
    <br>
    <p><strong>Auteurs et sources.</strong> Ce modèle a été initialement développé par Pierre Aldama, puis adapté par Guillaume Rozier. Les données proviennent de Santé Publique france et le Ministère de la Santé. Il est réactualisé quotidiennement. Les projections s'étalent sur les 14 prochains jours.</p>        
    <br>
    <?php include(__DIR__ . '/menuBasPage.php'); ?>
    <br>
    <br>
</body>