<?php

require_once 'src/model/ingredientManager.php';
require_once 'src/model/ingredient.php';

testIngredients();
function testIngredients(){
    $manager = new IngredientManager();
    $nombreIngredientsDebut = count($manager->getIngredients());

    $ingredientsCrees = [];
    $ingredientsCrees[] = new Ingredient('poudre de perlimpimpin');
    $ingredientsCrees[] = new Ingredient('racine de mangragore');
    $ingredientsCrees[] = new Ingredient('bave de crapaud');
    $ingredientsCrees[] = new Ingredient('potion bizarre');

    foreach($ingredientsCrees as $ingredient){
        $manager->creerIngredient($ingredient);
    }

    assertEquals(4, count($manager->getIngredients()) - $nombreIngredientsDebut);

    foreach($ingredientsCrees as $i => $ingredient){
        $ingredientsCrees[$i] = getIngredientNouvellementCree($ingredient);
        assertTrue($ingredientsCrees[$i] !== null);
        assertEquals($ingredient->getIntitule(), $manager->getIngredient($ingredientsCrees[$i]->getId())->getIntitule());
        $manager->supprimerIngredient($ingredientsCrees[$i]);
    }

    assertEquals($nombreIngredientsDebut, count($manager->getIngredients()));
}

function getIngredientNouvellementCree($ingredient){
    $manager = new IngredientManager();
    
    $ingredients = $manager->getIngredients();

    foreach($ingredients as $ingredientBase){
        if($ingredientBase->getIntitule() === $ingredient->getIntitule()){
            return $ingredientBase;
        }
    }
    return null;
}