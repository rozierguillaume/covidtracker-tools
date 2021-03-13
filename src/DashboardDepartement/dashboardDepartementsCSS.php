<style>
    .btn{
        background-color: white !important;
        color: black;
        border: 1px grey;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 2px 2px 10px #d6d6d6;
    }


    button.btn.btn-primary.dropdown-toggle{
        color: black;
    }

    .dropdown-menu > li > a.selected{
        background-color: black !important;
        color: white;
    }
    
    .btn.selected{
        background-color: black !important;
        color: black;
        border: 0px;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    }

    table, td {
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
        /*max-width: 350px;*/
        background: #ffffff;
        /*margin-left: 10px;*/
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


    @media screen and (max-width: 500px) {
        #carte{
            margin-top: -80px;
            margin-bottom: -80px;
        }
    }

    @media screen and (max-width: 450px) {
        #carte{
            margin-top: -100px;
            margin-bottom: -100px;
        }
    }

    @media screen and (max-width: 400px) {
        #carte{
            margin-top: -120px;
            margin-bottom: -120px;
        }
    }

    @media screen and (max-width: 370px) {
        #carte{
            margin-top: -140px;
            margin-bottom: -140px;
        }
    }


</style>