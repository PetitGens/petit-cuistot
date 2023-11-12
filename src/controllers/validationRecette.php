<?php

declare(strict_types=1);

require_once 'src/controllers/controleur.php';
require_once 'src/controllers/connexion.php';

require_once 'src/model/recetteManager.php';

class ValidationRecetteControleur extends Controleur{
    private Recette $recette;

    public function __construct(string $idRecette){
        $utilisateur = ConnexionController::estConnecte();

        if(! $utilisateur || ! $utilisateur->estAdministrateur()){
            throw new Exception('accès refusé');
        }

        $this->recette = (new RecetteManager)->getRecette($idRecette);
    }

    public function executer(){
        $recetteManager = new RecetteManager;
        $recetteModifiee = $recetteManager->getRecetteModifiee($this->recette->getId());

        if($recetteModifiee){
            $recetteManager->validerModification($recetteModifiee);
        } else {
            $recetteManager->validerRecette($this->recette);
        }

        header('Location: .?action=recettesAdmin');
        exit;
    }
}