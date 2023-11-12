<?php

require_once 'src/controllers/controleur.php';
require_once 'src/model/recetteManager.php';
require_once 'src/controllers/connexion.php';



class SupprimerRecetteControleur extends Controleur{

    private $idRecette;

    public function __construct($idRecette){
        $this->idRecette = $idRecette;
    }
    
    public function executer(){
        $utilisateur = ConnexionController::estConnecte();
        $estAdmin = $utilisateur && $utilisateur->estAdministrateur();
        if($utilisateur === false){
            return new Exception("Veuillez-vous connecter!");
        }
        $recette = (new RecetteManager)->getRecette($this->idRecette);
        if($estAdmin || $recette->getIdAuteur() === $utilisateur->getId()){
            (new RecetteManager)->supprimerRecette($recette);
        }
    }

}