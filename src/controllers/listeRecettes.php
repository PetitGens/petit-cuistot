<?php

require_once 'src/model/recetteManager.php';
require_once 'src/controllers/controleur.php';

require_once 'templates/carteRecette.php';
require_once 'templates/nosRecettes.php';

class ListeRecettesControleur extends Controleur{

    public function executer() {
        $recettes = (new RecetteManager)->getRecettes();
        afficherListeRecettes($recettes);
    }
}