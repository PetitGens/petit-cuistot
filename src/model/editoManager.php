<?php

declare(strict_types=1);

/**
 * Classe utilitaire permettant de gérer l'édito visible
 * sur la page d'accueil.
 * N'hérite pas de la classe Manager car l'édito n'est pas stocké
 * en base de données.
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class EditoManager{
    private string $cheminEdito;

    public function __construct($cheminEdito = "assets/edito.txt") {
        $this->cheminEdito = $cheminEdito;
    }

    /**
     * Renvoie le texte de l'édito
     *
     * @return string
     */
    public function getEdito(): string{
        $contenu = file_get_contents($this->cheminEdito);
        if(! $contenu){
            throw new Exception("Échec de la lecture dans le fichier");
        }

        return $contenu;
    }
        
    /**
     * Modifie le texte de l'édito.
     *
     * @param string $edito
     * @return void
     */
    public function setEdito(string $edito){
        if(! file_put_contents($this->cheminEdito, $edito)){
            throw new Exception("Échec de l'écriture dans le fichier");
        }
    }
}