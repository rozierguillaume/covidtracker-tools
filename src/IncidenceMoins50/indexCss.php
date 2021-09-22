<style>

    .shadow {
        border: 0px solid black;
        padding: 12px;
        border-radius: 7px;
        text-align: left;
        box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
        width: 100% !important;
        background: #ffffff;
        /*margin-left: 10px;*/
        margin-top: 10px;
    }

    #listeRegions {
        width: 100%;
    }

    #map {
        max-width: 100%;
        height: auto;
    }

    #map path:hover {
        fill-opacity: 0.6;
        transition: fill-opacity 2s, fill 0.2s, stroke 0.3s;
        cursor: pointer;
    }

    #carte text, #carte text tspan {
        cursor: pointer;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #000000;
        stroke-width: 0.4;
        transition: fill-opacity 2s, fill 0.2s, stroke 0.3s;
        z-index: 1000;
        /*transition: fill 2s;*/
        fill-opacity: 1;
    }

    #map.animated path.selected {
        /*.animated*stroke: #000000;*/
        /*stroke-width: 1.5;*/
        transition: fill 0.2s, stroke 0.3s;
        z-index: 9000;
        fill-opacity: 0.6;
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            stroke-width: 1;
            fill-opacity: 0.2;
        }
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

    #region-graphique-detail {
        display: none;
    }

</style>