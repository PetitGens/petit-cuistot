<?php

// Ceci est un contrôleur, il se charge de récupérer les données depuis le modèle pour les fournir à la vue (en gros).
// C'est également des contrôleurs qu'on utilise pour valider les formulaires.

require_once 'src/controllers/controleur.php';

require_once 'src/model/recetteManager.php';
require_once 'templates/accueil.php';

class AccueilControleur extends Controleur {
    public function executer(){
        $recettes = (new RecetteManager)->getDernieresRecettes(3);
        afficherPageAccueil($recettes);
    }
}