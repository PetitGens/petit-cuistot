<?php

require_once 'src/model/recetteManager.php';
require_once 'src/controllers/controleur.php';
require_once 'src/controllers/connexion.php';
require_once 'src/model/utilisateur.php';

require_once 'templates/nosRecettes.php';

class RecettesAdminControleur extends Controleur{

    public function executer() {
        $utilisateur = ConnexionController::estConnecte();
        if(! $utilisateur || ! $utilisateur->estAdministrateur()){
            throw new Exception('accès refusé');
        }

        $recettes = (new RecetteManager)->getRecettesNonValidees();
        afficherListeRecettes($recettes, true);
    }
}