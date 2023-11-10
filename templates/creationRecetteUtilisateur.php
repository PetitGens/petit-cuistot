<?php

include_once 'src/controllers/creationRecetteUtilisateur.php';

$titre = 'nouvelle recette';

$script = '<script src="assets/js/listeRecette.js"></script>';

// ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
ob_start();

$ingredients = array();

    ?>

<div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Création de recette</h2>
                    <p class="w-lg-50">À votre tour! insérez votre recette ici.</p>
                </div>
            </div>

            <form method="post">

                <div>
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre">
                </div>
                <div>
                    <label for="resume">Résumé :</label>
                    <textarea id="resume" style="width:100%; height:100px"></textarea>
                </div>
                <div>
                    <label for="recette">Recette :</label>
                    <textarea id="recette"style="width:100%; height:400px"></textarea>
                </div>
                <div>
                    <label for="image">Lien vers l'image :</label>
                    <input type="text" id="image">
                </div>

                <div>
                    <label for="ingredients">ingredients (séparez les par des virgules) :</label>
                    <input type="text" id="ingredients">
                </div>

                <button type="submit" id="boutonvalider">Enregistrer</button>

            </form>



        </div>
        <?php
        include_once 'assets/js/creationRecette.js'
        ?>

<?php

$controleurcreationrecette = new creerRecette();

if(isset($_POST['titre']) and isset($_POST['resume']) and isset($_POST['recette']) and isset($_POST['image']) and isset($_POST['ingredients'])){
    
    $titre = $_POST['titre'];
    $resume = $_POST['resume'];
    $recette = $_POST['recette'];
    $image = $_POST['image'];
    $ingredients = $_POST['ingredients'];

    $controleurcreationrecette->insererRecette($titre, $resume, $recette, $image, $ingredients);

}


// On peut récupérer le contenu du buffer comme ça :
$contenu = ob_get_clean();

require 'templates/layout.php';