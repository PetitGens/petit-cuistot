<?php
// Ceci est une vue bidon
// Une vue se contente de récupérer les variables qu'on lui donne est de formatter la page html

// Le code HTML sera placé en énorme majorité dans les vues et le layout

require_once 'templates/carteRecette.php';
require_once 'src/model/recette.php';

function afficherListeRecettes($recettes){
    $titre = 'Nos Recettes';

    // ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
    ob_start();
    ?>

    <div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Nos recettes</h2>
                    <p class="w-lg-50">Les recettes pour vos p'tits gloutons, certifiées savoureux par notre équipe de cuistots du dimanche</p>
                </div>
            </div>
            <div class="row gy-4 row-cols-1 row-cols-md-2">
                <?php
                foreach($recettes as $recette){
                    if($recette->estValide()){
                        afficher($recette);
                    }
                }
                ?>
            </div>
        </div>
        <div class="container py-4 py-xl-5"><button class="btn btn-primary" type="button" style="width: 3em;height: 3em;border-radius: 50%;font-size: 34px;padding-bottom: 10px;margin: auto;display: block;">+</button></div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
        <script src="assets/js/Simple-Slider.js"></script>
    <?php

    $contenu = ob_get_clean();
    require 'templates/layout.php';
}