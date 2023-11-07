<?php

require_once 'src/controllers/controleur.php';
require_once 'templates/connexion.php';

class PageConnexionControleur extends Controleur { 
    private $loginIncorrect;

    public function __construct($loginIncorrect = false) {
        $this->loginIncorrect = $loginIncorrect;
    }

    public function executer(){
        afficherPageConnexion($this->loginIncorrect);
    }
}