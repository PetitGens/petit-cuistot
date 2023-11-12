<?php

require_once 'src/controllers/controleur.php';
require_once 'src/model/recetteManager.php';
require_once 'src/controllers/connexion.php';
require_once 'src/model/utilisateur.php';
require_once 'templates/nosRecettes.php';

class MesRecettesControleur extends Controleur{
    public function executer(){
        $utilisateur = ConnexionController::estConnecte();
        $recetteManager = new RecetteManager();
        $recette = $recetteManager->getParUtilisateur($utilisateur->getId());
        afficherListeRecettes($recette, false, true);
    }
}