<style>
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

    #listeRegions {
        width: 100%;
    }

    #map {
        max-width: 100%;
        height: auto;
    }

    #map path {
        fill: #c4c4cb;
        stroke: #000;
        stroke-width: 0.9;
        transition: fill 0.2s, stroke 0.3s;
        z-index: 1000;
        transition: fill 2s;
        fill-opacity: 1;
    }

    #map.animated path.selected, #map.animated g.selected path {
        transition: fill 0.2s;
        z-index: 9000;
        animation: blinker 1.5s ease-in-out infinite;
    }

    @keyframes blinker {
        50% {
            fill-opacity: 0.5;
        }
    }

    #map path:hover {
        stroke-width: 1.2;
        fill-opacity: 1;
    }

    #map .separator {
        stroke: #ccc;
        fill: none;
        stroke-width: 1.5;
    }

    #map .separator:hover {
        stroke: #ccc;
        fill: none;
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
</style>
