<?php

require_once 'src/lib/assertion.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';

testRecettes();
function testRecettes() {
    $manager = new RecetteManager();

    $recettes = [];
    $recettes[] = new Recette('Pain au chocolat', 'lorem ipsum dolor sic amet', 'amet sic dolor ipsum lorem', '', 'V', '2', 'Goûter');
    $manager->creerRecette($recettes[0]);

    $recetteBis = $manager->getDernieresRecettes(1)[0];

    assertEquals('Pain au chocolat', $recetteBis->getTitre());
    assertEquals('test', $recetteBis->getAuteur()->getPseudo());

    $recetteBis->ajouterIngredient(new Ingredient('chocolat'));

    $ingredients = $recetteBis->getIngredients();

    assertEquals(1, count($ingredients));
    assertEquals('chocolat', $ingredients[0]->getIntitule());

    $recetteBis->ajouterTag(new Tag('viennoiserie'));

    $tags = $recetteBis->getTags();

    assertEquals(1, count($tags));
    assertEquals('viennoiserie', $tags[0]->getIntitule());

    $manager->supprimerRecette($recetteBis);

    assertFalse($manager->getRecette($recetteBis->getId()));
}