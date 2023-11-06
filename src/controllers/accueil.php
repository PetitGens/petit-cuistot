<?php

// Ceci est un contrôleur, il se charge de récupérer les données depuis le modèle pour les fournir à la vue (en gros).
// C'est également des contrôleurs qu'on utilise pour valider les formulaires.

require_once 'src/controllers/controleur.php';
require_once 'src/model/recetteManager.php';



class AccueilControleur extends Controleur {
    public function executer(){
        $recettesManager = new RecetteManager();
        $recettes = $recettesManager->getDernieresRecettes(3);
        require 'templates/accueil.php';
    }
}