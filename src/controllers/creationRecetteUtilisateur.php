<?php

require_once 'src/controllers/controleur.php';


class CreationRecetteUtilisateurControleur extends Controleur{

    public function executer() {
        require_once 'templates/creationRecetteUtilisateur.php';
    }
}