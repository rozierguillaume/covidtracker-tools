<style>
    .btn-group{
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    }
    .btn{
        color: black;
        
    }
    .btn.active{
        background-color: black;
        color: white;
        
    }
    #choixCarte button{
        margin: 0px;
    }

    .tableau-div{
        width: 50vh;
        height: 50vh;
    }

    @media screen and (max-width: 700px){
        .tableau-div{
            width: 100vh;
            height: 100vh;
        }
    }

    .wrap {
        display: flex;
        margin-top: 0px;
        flex-wrap: wrap;
    }
    .wrap>* {
        flex: 1 1 200px;
    }

    .one {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        margin-right: 15px;
        max-width: 400px;
        text-align: left;
        /*box-shadow: 6px 4px 25px #c3d19d;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100%;
        background: #ffffff;
    }

    .two {
        border: 0px solid black;
        margin-top: 20px;
        padding: 10px 10px 10px 10px;
        border-radius: 7px;
        max-width: 400px;
        text-align: left;
        /*  box-shadow: 6px 4px 25px #ffa29c;*/
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        background: #ffffff;
        width: 100%;

    }

    p{
        font-size: 120%;
    }

    .shadow-btn {
        border: 0px solid black;
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: #ffffff;

    }

    .shadow-btn-green {
        border: 0px solid black;
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 10px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(0, 128, 0, 0.317);
        max-width: 350px;
        background: #ffffff;
        min-height: 300px;

    }

    .shadow-btn-orange {
        border: 0px solid black;
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(128, 115, 0, 0.317);
        max-width: 350px;
        background: #ffffff;
    }

    .shadow-btn-red {
        border: 0px solid black;
        padding: 12px;
        font-size: 100%;
        border-radius: 7px;
        margin-right: 5px;
        margin-bottom: 10px;
        margin-top: 2px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px rgba(128, 0, 0, 0.317);
        max-width: 350px;
        background: #ffffff;
        min-height: 300px;
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

    .btn-shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 450px;
        background: #ffffff;
        margin-top: 3px;
    }

    table, tr, td {
        border: 1px solid white;
    }

    body {
        font-size: 16px;
    }

    td {
        width: 1%;
        height: 1%;
    }

    .green {
        background-color: rgb(45, 189, 84);
    }

    .darkgreen {
        background-color: rgb(31, 128, 57);
    }

    .red {
        background-color: rgb(237, 88, 88);
    }

    .grey {
        background-color: rgb(207, 169, 169);
    }

    .animation-seconde-dose {
        background-color: rgb(45, 189, 84);
        animation: seconde-dose 3s ease infinite;
        animation-delay: 2s;
    }

    .animation-premiere-dose {
        background-color: rgb(237, 88, 88);
        animation: premiere-dose 3s ease infinite;
        animation-delay: 2s;
    }

    @keyframes premiere-dose {
      /*from {background-color: rgb(237, 88, 88);}*/
      50% {background-color: rgb(45, 189, 84);}
    }

    @keyframes seconde-dose {
      /*from {background-color: rgb(45, 189, 84);}*/
      50% {background-color: rgb(31, 128, 57);}
    }


    .subtableVaccin, .subtableVaccin tr, .subtableVaccin td {
        border: none;
    }

    .subtableVaccin {
        width: 100%;
        height: 100%;
    }

    .subtableVaccin tr {
        height: 10%;
    }

    
     div[shadow] {
         border: 0px solid black;
         padding: 10px 20px;
         border-radius: 7px;
         text-align: center;
         box-shadow: 6px 4px 25px #d6d6d6;
     }

    button {
        border: 1px solid;
        margin: 10px;
        padding: 15px;
        font-size : 16px;
        transition-duration: 0.4s;
        background-color: #ffffff;
        border-radius: 15px;

    }

    card {
        border: 1px solid;
        margin: 10px;
        padding: 15px;
        font-size : 16px;
        transition-duration: 0.4s;
        background-color: #ffffff;
        border-radius: 15px;

    }

    /* the flex container without mediaquerie */

    div[class_perso] {
        display: flex;
        min-height: 12vh;
        flex-wrap: wrap;


        /* needed to stack children once to big */
    }

    div[class_perso] div {
        flex: 1;
        min-width: 200px;
        min-height: 7vh;
        /* 2 children + margin and borders makes a break point at around 620px */
        /*background: lightblue;*/

    }

    /*div div {*/
    /*    !*border: solid;*!*/
    /*    margin: 3px;*/
    /*background: tomato;*/
    /*}*/

    .videoWrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        padding-top: 25px;
        height: 0;
    }

    .videoWrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* remove the grid system at about 620px */

    @media screen and (max-width: 621px) {
        div[class_persos] {
            min-height: 30vh;
            /* has a meaning with a grid system */
        }

    }
</style>

<h2 style="margin-top: 40px;">Menu</h2>
<div shadow="" style="margin-bottom: 5px;">
    <div class_perso="">
        <div>
            <center><h3>Dashboards</h3><br></center>
            <p>Ces tableaux de bord permettent de suivre et mieux comprendre l'évolution de l'épidémie.</p><br>
            <center>
                <a href="https://covidtracker.fr" style="color:black">
                    <button>🏠 <b>Accueil</b></button>
                </a>
                <a href="https://covidtracker.fr/france/" style="color:black">
                    <button>🇫🇷 France</button>
                </a>
                <a href="https://covidtracker.fr/dashboard-regions/" style="color:black">
                    <button>📍 Régions</button>
                </a>
                <a href="https://covidtracker.fr/dashboard-departements/" style="color:black">
                    <button>🏡 Départements</button>
                </a><br>
                <a href="https://covidtracker.fr/covidtracker-world/" style="color:black">
                    <button>🌍 World</button>
                </a>
            </center>
        </div>

        <div>
            <center>
                <h3>Outils</h3><br></center>
            <p>Ces outils permettent de comparer les deux vagues, de calculer le risque de présence d'un cas de covid19,
                et d'estimer la durée du confinement en cours.</p>
            <center>
                <a href="https://covidtracker.fr/vaximpact/" style="color:black"><button>🆕 <b>VaxImpact</b></button></a>
                <a href="https://covidtracker.fr/covidexplorer/" style="color:black"><button>🔎 <b>CovidExplorer</b></button></a>
                <a href="https://covidtracker.fr/vaccintracker/" style="color:black">
                    <button>💉 <b>VaccinTracker</b></button>
                </a>
                <a href="https://covidtracker.fr/deconfitracker/" style="color:black">
                    <button>🔥 DéconfiTracker</button>
                </a><a href="https://covidtracker.fr/covidep/" style="color:black">
                    <button>🆕 CoviDep</button>
                </a>
                <a href="https://covidtracker.fr/calculateur-risque-covid/" style="color:black">
                    <button>🔢 CoviRisque</button>
                </a>
                <a href="https://covidtracker.fr/archives/" style="color:black"><br><i>Outils archivés</i></a>
            </center>
        </div>
    </div>
</div>