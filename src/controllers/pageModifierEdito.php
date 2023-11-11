<?php

require_once 'src/controllers/controleur.php';

require_once 'templates/edito.php';

class ModifierEditoControleur extends Controleur {
    public function executer() {
        afficherPageEdito();
    }
}