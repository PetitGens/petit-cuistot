<?php

$titre = 'nouvelle recette';

// ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
ob_start();


    ?>

<div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Création de recette</h2>
                    <p class="w-lg-50">À votre tour! insérez votre recette ici.</p>
                </div>
            </div>

            <form>

                <div>
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre">
                </div>
                <div>
                    <label for="resume">Résumé :</label>
                    <input type="text" id="resume">
                </div>
                <div>
                    <label for="recette">Recette :</label>
                    <input type="text" id="recette">
                </div>
                <div>
                    <input type="file" id="image">
                </div>
            </form>



        </div>

<?php




// On peut récupérer le contenu du buffer comme ça :
$contenu = ob_get_clean();

require 'templates/layout.php';