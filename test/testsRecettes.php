<?php

require_once 'src/lib/assertion.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';

testRecettes();
function testRecettes() {
    $manager = new RecetteManager();

    $recettes = [];
    $recettes[] = new Recette('Pain au chocolat', 'lorem ipsum dolor sic amet', 'amet sic dolor ipsum lorem', '', 'A', '2', 'Goûter');
    $manager->creerRecette($recettes[0]);

    $recetteBis = $manager->getDernieresRecettes(1)[0];

    assertEquals('Pain au chocolat', $recetteBis->getTitre());
    assertEquals('test', $recetteBis->getAuteur()->getPseudo());

    $manager->supprimerRecette($recetteBis);
}