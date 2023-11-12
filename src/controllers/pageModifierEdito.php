<?php

require_once 'src/controllers/controleur.php';
require_once 'src/controllers/connexion.php';

require_once 'templates/edito.php';

class ModifierEditoControleur extends Controleur {
    public function executer() {
        $utilisateur = ConnexionController::estConnecte();

        if(! $utilisateur || ! $utilisateur->estAdministrateur()){
            throw new Exception('accès refusé');
        }

        afficherPageEdito();
    }
}