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

            <form method="post">

                <div>
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre">
                </div>

                <label for="categorie">Categorie :</label> 
                    <select name="categorie" id="categorie"> 
                        <?php
                        foreach((new CategorieManager)->getCategories() as $categorie){
                            ?>
                            <option value="<?=$categorie?>"><?=$categorie?></option>
                            <?php
                        }
                        ?>
                    </select>
                    
                <br>
                <div>
                    <label for="resume">Résumé :</label>
                    <textarea id="resume" name="resume" style="width:100%; height:100px"></textarea>
                </div>
                <div>
                    <label for="recette">Recette :</label>
                    <textarea id="recette" name="recette" style="width:100%; height:400px"></textarea>
                </div>
                <div>
                    <label for="image">Lien vers l'image :</label>
                    <input type="text" id="image" name="image">
                </div>
                
                <div>
                    <label for="tags">tags (séparez les par des virgules) :</label>
                    <input type="text" id="tags" name="tags">
                </div>

                <div>
                    <label for="ingredients">ingredients (séparez les par des virgules) :</label>
                    <input type="text" id="ingredients" name="ingredients">
                </div>

                <button type="submit" id="boutonvalider">Enregistrer</button>

            </form>

        </div>

<?php




if(isset($_POST['titre']) and isset($_POST['categorie']) and isset($_POST['resume']) and isset($_POST['recette']) and isset($_POST['image']) and  isset($_POST['ingredients']) and isset($_POST['tags'])){
    
    $controleurcreationrecette = new CreationRecetteUtilisateurControleur();

    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $resume = $_POST['resume'];
    $recette = $_POST['recette'];
    $image = $_POST['image'];
    $ingredients = $_POST['ingredients'];
    $tags = $_POST['tags'];

    $controleurcreationrecette->insererRecette($titre, $categorie, $resume, $recette, $image, $ingredients, $tags);

}


// On peut récupérer le contenu du buffer comme ça :
$contenu = ob_get_clean();

require 'templates/layout.php';