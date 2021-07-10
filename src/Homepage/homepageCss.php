<style>

    .taux_croissance_stable {
        color: black;
        background-color: #ededed;
        border-radius: 7px;
        padding: 3px;
        margin-right: 5px;
        margin-left: 5px;
    }

    .taux_croissance_hausse {
        color: black;
        background-color: #ffdee3;
        border-radius: 7px;
        padding: 3px;
        margin-right: 5px;
        margin-left: 5px;
    }

    .taux_croissance_baisse {
        color: black;
        background-color: #e2f5e1;
        border-radius: 7px;
        padding: 3px;
        margin-right: 5px;
        margin-left: 5px;
    }

    table,
    td {
        border: 0px solid #333;
        color: black;
        background-color: red;
    }


    .shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: #ffffff;
        margin-left: 10px;
        margin-top: 10px;
    }

    #listeDepartements {
        width: 100%;
    }

    #map {
        max-width: 100%;
        max-height: 100%;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
        z-index: 1000;
        transition: fill 2s;
        fill-opacity: 1;
    }

    #map.animated path.selected {
        transition: fill 0.2s, stroke 0.3s;
        z-index: 9000;
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            stroke-width: 2;
            fill-opacity: 0.5;
        }
    }

    #map path:hover {
        stroke-width: 2.6;
    }

    #map path.selected:hover {
        stroke-width: 0.6;
    }

    #map .separator {
        stroke: #ccc;
        fill: none !important;
        stroke-width: 1.5;
    }

    #titreCarte {
        font-size: 16px;
        font-weight: bold;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none !important;
    }

    .btn-primary {
        background-color: #86AAE0;
        border-color: #86AAE0;
    }

    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus {
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

    .dropdown-menu > li > a.selected {
        background-color: #a1d1ff;
    }

    #choixTypeCarte, #choixTypeDonnee {
        margin-bottom: 20px;
    }

    #choixTypeCarte button.selected {
        font-weight: bold;
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

    @media screen and (max-width: 5000px) {
        #carte{
            margin-top: 0px;
            margin-bottom: 0px;
        }
    }

    @media screen and (max-width: 700px) {
        #carte{
            margin-top: -30px;
            margin-bottom: -30px;
        }
    }

    @media screen and (max-width: 450px) {
        #carte{
            margin-top: -60px;
            margin-bottom: -60px;
        }
    }

    @media screen and (max-width: 400px) {
        #carte{
            margin-top: -80px;
            margin-bottom: -80px;
        }
    }

    @media screen and (max-width: 370px) {
        #carte{
            margin-top: -100px;
            margin-bottom: -100px;
        }
    }


    div[shadow] {
        border: 0px solid black;
        padding: 10px 20px;
        border-radius: 7px;
        text-align: center;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        background: #ffffff;
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

    button:hover {
        background-color: black; /* Green */
        color: white;
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


    table,
    td {
        border: 0px solid #333;
        color: black;
        background-color: red;
    }

    .sib-form{
        padding: 0px 0px !important;
    }

    .shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        max-width: 350px;
        background: #ffffff;
        margin-left: 10px;
        margin-top: 10px;
    }

    #listeDepartements {
        width: 100%;
    }

    #map {
        max-width: 100%;
        max-height: 100%;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #FFFFFF;
        stroke-width: 0.6;
        transition: fill 0.2s, stroke 0.3s;
        z-index: 1000;
        transition: fill 2s;
        fill-opacity: 1;
    }

    #map.animated path.selected {
        transition: fill 0.2s, stroke 0.3s;
        z-index: 9000;
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            stroke-width: 2;
            fill-opacity: 0.5;
        }
    }

    #map path:hover {
        stroke-width: 2.6;
    }

    #map path.selected:hover {
        stroke-width: 0.6;
    }

    #map .separator {
        stroke: #ccc;
        fill: none !important;
        stroke-width: 1.5;
    }

    #titreCarte {
        font-size: 16px;
        font-weight: bold;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none !important;
    }

    .btn-primary {
        background-color: #86AAE0;
        border-color: #86AAE0;
    }

    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus {
        background: #547096;
        border-color: #547096;
        color: #fff;
    }

    .dropdown-menu > li > a.selected {
        background-color: #a1d1ff;
    }

    #choixTypeCarte, #choixTypeDonnee {
        margin-bottom: 20px;
    }

    #choixTypeCarte button.selected {
        font-weight: bold;
        background: #547096;
        border-color: #547096;
        color: #fff;
    }


    .myDiv {
        background-color: white;
        border: 0px solid black;
        padding: 10px 30px;
        border-radius: 7px;
        max-width: 800px;
        text-align: left;
        box-shadow: 6px 4px 25px #d6d6d6;
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
        margin-top: 0px;
        padding: 5px 10px;
        border-radius: 7px;

        max-width: 1200px;
        text-align: left;
        /*box-shadow: 6px 4px 25px #c3d19d;*/
        /*box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;*/
        width: 20%;
        background: #ffffff;
    }

    .two {
        border: 0px solid black;
        margin-top: 0px;
        padding: 5px 10px;
        border-radius: 7px;
        max-width: 1200px;
        text-align: left;
        /*  box-shadow: 6px 4px 25px #ffa29c;*/
        /*box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;*/
        background: #ffffff;

        width: 20%;

    }

    .three {
        border: 0px solid black;
        margin-top: 0px;
        padding: 5px 10px;
        border-radius: 7px;
        max-width: 1200px;
        text-align: left;
        /*  box-shadow: 6px 4px 25px #ffa29c;*/
        /*box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;*/
        background: #ffffff;

        width: 20%;
    }



    @media screen and (max-width: 5000px) {
        #carte{
            margin-top: 0px;
            margin-bottom: 0px;
        }
    }

    @media screen and (max-width: 700px) {
        #carte{
            margin-top: -30px;
            margin-bottom: -30px;
        }
    }

    @media screen and (max-width: 450px) {
        #carte{
            margin-top: -60px;
            margin-bottom: -60px;
        }
    }

    @media screen and (max-width: 400px) {
        #carte{
            margin-top: -80px;
            margin-bottom: -80px;
        }
    }

    @media screen and (max-width: 370px) {
        #carte{
            margin-top: -100px;
            margin-bottom: -100px;
        }
    }



    /* remove the grid system at about 620px */

    @media screen and (max-width: 621px) {
        div[class_persos] {
            min-height: 30vh;
            /* has a meaning with a grid system */
        }

    }

    a {
        cursor: pointer;
    }

    .btn{
        background-color: white !important;
        color: black;
        border: solid 1px grey;
        
    }


    button.btn.btn-primary.dropdown-toggle{
        color: black;
    }
    .dropdown-menu > li > a.selected{
        background-color: black !important;
        color: white;
    }

    
</style>
