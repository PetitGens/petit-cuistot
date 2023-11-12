<?php

include_once 'src/model/recetteManager.php';
include_once 'src/model/recette.php';
include_once 'src/controllers/connexion.php';

class CreationRecetteUtilisateurControleur{

    public function executer() {
        require_once 'templates/creationRecetteUtilisateur.php';
    }

    public function insererRecette($titre, $categorie, $resume, $recette, $image, $ingredients, $tags) {

        $recetteManager = new recetteManager();
        $connexionManager = new ConnexionController();
        
        $listeingredients = explode(',', $ingredients);
        $listetags = explode(',', $tags);

        $recette = new Recette($titre, $recette, $resume, $image, 'A',$connexionManager->estConnecte()->getId() , $categorie);

        $recetteManager->creerRecette($recette);

        $recette = $recetteManager->getDerniereRecetteCree((new ConnexionController)->estConnecte());

        foreach($listeingredients as $ingredient){
            (new IngredientManager)->ajouterIngredientARecette(new Ingredient($ingredient), $recette->getId());
        }
        foreach($listetags as $tag){
            (new TagManager)->ajouterTagARecette(new Tag($tag), $recette->getId());
        }

    }

}