<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/ingredient.php';

/**
 * Classe utilitaire permettant de gérer les ingredients de la base (CRUD).
 * 
 * @see Ingredient
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class IngredientManager extends Manager{

    /**
     * Renvoie un ingredient en fonction de son id.
     *
     * @param string $id
     * @return ?Ingredient
     */
    public function getIngredient(string $id): ?Ingredient{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Renvoie tous les ingredients.
     *
     * @return array
     */
    public function getIngredients(): array{
        throw new Exception('not implemented yet');
    }
    
    /**
     * Renvoie tous les ingredients d'une recette.
     *
     * @param string $idRecette id de la recette
     * @return array
     */
    public function getParRecette(string $idRecette): array{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Insert l'ingredient donné en paramètre dans la base de données.
     *
     * @param Ingredient $ingredient
     * @return void
     */
    public function creerIngredient(Ingredient $ingredient): void{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Supprime l'ingredient de la base de données.
     *
     * @param Ingredient $ingredient
     * @return void
     */
    public function supprimerIngredient(Ingredient $ingredient): void{
        throw new Exception('not implemented yet');
    }
}