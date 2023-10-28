<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/tag.php';

/**
 * Classe utilitaire permettant de gérer les tags de la base (CRUD).
 * 
 * @see Tag
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class TagManager extends Manager{

    /**
     * Renvoie un tag en fonction de son id.
     *
     * @param string $id
     * @return ?Tag
     */
    public function getTag(string $id): ?Tag{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Renvoie tous les tags.
     *
     * @return array
     */
    public function getTags(): array{
        throw new Exception('not implemented yet');
    }
    
    /**
     * Renvoie tous les tags d'une recette.
     *
     * @param string $idRecette id de la recette
     * @return array
     */
    public function getParRecette(string $idRecette): array{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Insert le tag donné en paramètre dans la base de données.
     *
     * @param Tag $tag
     * @return void
     */
    public function creerTag(Tag $tag): void{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Supprime le tag de la base de données.
     *
     * @param Tag $tag
     * @return void
     */
    public function supprimerTag(Tag $tag): void{
        throw new Exception('not implemented yet');
    }
}