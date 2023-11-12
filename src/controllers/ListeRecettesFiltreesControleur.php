<?php
require_once 'src/model/recetteManager.php';
require_once 'src/controllers/controleur.php';

require_once 'templates/carteRecette.php';
require_once 'templates/nosRecettes.php';


class ListeRecettesFiltreesControleur extends Controleur
{
    private String $Filtre;
    private String $ID;
    public function __construct($Filtre , $ID)
    {
        $this->Filtre=$Filtre;
        $this->ID=$ID;
    }

    /**
     * @throws Exception
     */
    public function executer()
    {
        $recettes = (new RecetteManager)->getRecettesFiltre($this->Filtre,$this->ID);
        afficherListeRecettes($recettes);
    }
}