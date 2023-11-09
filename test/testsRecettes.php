<?php

require_once 'src/lib/assertion.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteModifiee.php';
require_once 'src/model/recetteManager.php';

testRecettes();
testRecettesModifiees();

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

function testRecettesModifiees(){
    $manager = new RecetteManager();

    $idAuteur = (new UtilisateurManager)->connecter('test', 'test')->getId();

    $recette = new Recette('Poulet cury', "J'ai la flemme d'écrire le contenu...", "Du poulet avec du curry (OMG)", "", "A", $idAuteur, 'Plat');
    $manager->creerRecette($recette);

    $recetteEnBase = $manager->getRecettes()[0];

    assertEquals('Poulet cury', $recetteEnBase->getTitre());

    $recetteEnBase->ajouterTag(new Tag('volaille'));
    $recetteEnBase->ajouterIngredient(new Ingredient('poulet'));
    $recetteEnBase->ajouterIngredient(new Ingredient('curry'));
    $recetteEnBase->ajouterIngredient(new Ingredient('onions'));

    assertFalse($recetteEnBase->estValide());
    $manager->validerRecette($recetteEnBase);
    $recetteEnBase = $manager->getRecette($recetteEnBase->getId());
    assertTrue($recetteEnBase->estValide());

    $recetteModifiee = RecetteModifiee::getInstanceFromRecette($recetteEnBase);

    $recetteModifiee->setTitre('Poulet curry');
    $manager->soumettreModification($recetteModifiee);
    $recetteEnBase = $manager->getRecette($recetteEnBase->getId());
    assertTrue($recetteEnBase->estValide());
    assertEquals('Poulet cury', $recetteEnBase->getTitre());

    //$recetteModifiee = $manager->getRecetteModifiee($recetteEnBase->getId());
    // finalement, je n'aime pas trop les onions...
    $recetteModifiee->supprimerIngredient(new Ingredient('onions'));

    $manager->validerModification($recetteModifiee);

    $recetteEnBase = $manager->getRecette($recetteEnBase->getId());
    assertEquals('Poulet curry', $recetteEnBase->getTitre());

    $exception = false;
    try{
        $recetteEnBase->supprimerIngredient(new Ingredient('onions'));
        $exception = true;
    }
    catch(Exception $e){}

    if($exception){
        throw new AssertionFailedException("expected exception to be thrown");
    }

    assertFalse($manager->getRecetteModifiee($recetteEnBase->getId()));

    $manager->soumettreModification(RecetteModifiee::getInstanceFromRecette($recetteEnBase));
    $manager->supprimerRecette($recetteEnBase);
}