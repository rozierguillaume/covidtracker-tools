<script>
    readJson()
    function readJson () {
        // http://localhost:8080
        fetch('https://raw.githubusercontent.com/CovidTrackerFr/covidtracker-data/master/data/france/stats/stats.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(json => {
                this.data = json;
                document.getElementById("rea").innerHTML = data["rea"]["valeur"];
                document.getElementById("hosp").innerHTML = data["hosp"]["valeur"];
                document.getElementById("dc_new").innerHTML = data["incid_dc"]["valeur"];
                document.getElementById("cas_last7").innerHTML = data["tests_last7"]["valeur"];
                document.getElementById("hosp_descr").innerHTML = document.getElementById("hosp_descr").innerHTML.replace("--/--", data["hosp"]["date"]);
                document.getElementById("hosp_descr").innerHTML = document.getElementById("hosp_descr").innerHTML.replace("---", data["hosp_new"]["valeur"]);
                document.getElementById("rea_descr").innerHTML = document.getElementById("rea_descr").innerHTML.replace("--/--", data["rea"]["date"]);
                document.getElementById("rea_descr").innerHTML = document.getElementById("rea_descr").innerHTML.replace("---", data["rea_new"]["valeur"]);
                document.getElementById("dc_new_descr").innerHTML = document.getElementById("dc_new_descr").innerHTML.replace("--/--", data["incid_dc"]["date"]);
                document.getElementById("cas_last7_descr").innerHTML = document.getElementById("cas_last7_descr").innerHTML.replace("--/--", data["tests_last7"]["date"]);
            })
            .catch(function () {
                this.dataError = true;
            })
    }

    $.fn.responsiveTabs = function() {
        this.addClass('responsive-tabs');
        this.append($('<span class="glyphicon glyphicon-triangle-bottom"></span>'));
        this.append($('<span class="glyphicon glyphicon-triangle-top"></span>'));

        this.on('click', 'li.active > a, span.glyphicon', function() {
            this.toggleClass('open');
        }.bind(this));

        this.on('click', 'li:not(.active) > a', function() {
            this.removeClass('open');
        }.bind(this));
    };

    $('.nav.nav-tabs').responsiveTabs();
</script>