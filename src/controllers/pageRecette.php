<?php

require_once 'src/controllers/controleur.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';

require_once 'templates/pageRecette.php';

class PageRecetteControleur extends Controleur {
    public function executer() {
        $recette = (new RecetteManager)->getRecette('1');

        afficherPageRecette($recette);
    }
}