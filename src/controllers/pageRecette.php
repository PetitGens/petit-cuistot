<?php

declare(strict_types=1);

require_once 'src/controllers/controleur.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';

require_once 'templates/pageRecette.php';

class PageRecetteControleur extends Controleur {
    private Recette $recette;

    public function __construct(string $idRecette){
        $this->recette = (new RecetteManager)->getRecette($idRecette);
        if(! $this->recette){
            throw new Exception("cette recette n'existe pas");
        }
    }

    public function executer() {
        afficherPageRecette($this->recette);
    }
}