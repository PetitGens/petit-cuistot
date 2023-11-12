<?php

declare(strict_types=1);

require_once 'src/controllers/controleur.php';
require_once 'src/controllers/connexion.php';

require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';

require_once 'templates/pageRecette.php';

class PageRecetteControleur extends Controleur {
    private Recette $recette;
    private bool $admin;

    public function __construct(string $idRecette, bool $admin = false){
        $this->admin = $admin;

        $this->recette = (new RecetteManager)->getRecette($idRecette);
        if(! $this->recette){
            throw new Exception("cette recette n'existe pas");
        }

        if(! $admin){
            return;
        }

        $utilisateur = ConnexionController::estConnecte();
        if(! $utilisateur || ! $utilisateur->estAdministrateur()){
            throw new Exception('accès refusé');
        }
    }

    public function executer() {
        afficherPageRecette($this->recette, $this->admin);
    }
}