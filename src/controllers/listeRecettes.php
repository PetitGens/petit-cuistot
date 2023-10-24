<?php

require_once 'src/model/recetteManager.php';
require_once 'src/controllers/controleur.php';

class ListeRecettesControleur extends Controleur{
    public function executer() {
        $recettes = (new RecetteManager)->getRecettes();
        
    }
}