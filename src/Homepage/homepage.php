<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js" integrity="sha512-9hzM/Gfa9KP1hSBlq3/zyNF/dfbcjAYwUTBWYX+xi8fzfAPHL3ILwS1ci0CTVeuXTGkRAWgRMZZwtSNV7P+nfw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred@1"></script>


<?php include(dirname(__FILE__) . '/homepageCss.php') ?>
<?php include(dirname(__FILE__) . '/homepageJs.php') ?>

<!-- wp:paragraph {"fontSize":"normal"} -->
<p class="has-normal-font-size"><strong>
        CovidTracker est un outil permettant de suivre l'évolution
        de l'épidémie à Coronavirus en France et dans le monde.
    </strong>
    Pour des analyses quotidiennes des chiffres, vous pouvez suivre
    <a href="https://twitter.com/guillaumerozier" target="_blank" rel="noopener noreferrer">@guillaumerozier</a>
    sur Twitter, ainsi que <a href="https://twitter.com/covidtracker_fr">@covidtracker_fr</a>.
</p>
<!-- /wp:paragraph -->

<?php include(dirname(__FILE__) . '/enUnCoupDOeil.php') ?>
<?php include(dirname(__FILE__) . '/carte.php') ?>
<?php include(dirname(__FILE__) . '/enDetail.php') ?>
<?php include(dirname(__FILE__) . '/news.php') ?>


