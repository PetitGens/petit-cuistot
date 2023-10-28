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

    /**
     * Renvoie le texte de l'édito
     *
     * @return string
     */
    public function getEdito(): string{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Modifie le texte de l'édito.
     *
     * @param string $edito
     * @return void
     */
    public function setEdito(string $edito){
        throw new Exception('not implemented yet');
    }
}