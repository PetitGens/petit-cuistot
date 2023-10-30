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

    private function ingredientFromLigne(array $ligne): Ingredient{
        $id = $ligne['ING_ID'];
        $intitule = $ligne['ING_INTITULE'];
        $description = $ligne['ING_DESCRIPTION'];
        if(is_null($description)){
            $description = '';
        }
        return new Ingredient($intitule, $id, $description);
    }

    /**
     * Renvoie un ingredient en fonction de son id.
     *
     * @param string $id
     * @return ?Ingredient
     */
    public function getIngredient(string $id): ?Ingredient{
        $resultat = $this->projectionBdd("select ING_ID, ING_INTITULE, ING_DESCRIPTION from CUI_INGREDIENT where ing_id = '$id'");
        if(empty($resultat)){
            return null;
        }

        $ligne = $resultat[0];
        return $this->ingredientFromLigne($ligne);
    }
        
    /**
     * Renvoie tous les ingredients.
     *
     * @return array
     */
    public function getIngredients(): array{
        $ingredients = [];
        $resultat = $this->projectionBdd("select ING_ID, ING_INTITULE, ING_DESCRIPTION from CUI_INGREDIENT");
        foreach($resultat as $ligne){
            $ingredients[] = $this->ingredientFromLigne($ligne);
        }
        return $ingredients;
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
        $requete = 
        "insert into CUI_INGREDIENT(ING_INTITULE, ING_DESCRIPTION)
        values (?, NULLIF(?, ''))";

        if(! $this->requetePrepare($requete, [$ingredient->getIntitule(), $ingredient->getDescription()])){
            throw new Exception("échec de l'insertion du ingredient en base de données");
        }
    }

        
    /**
     * Supprime l'ingredient de la base de données.
     *
     * @param Ingredient $ingredient
     * @return void
     */
    public function supprimerIngredient(Ingredient $ingredient): void{
        $requete = 
        "delete from CUI_INGREDIENT where ING_ID = ?";

        if(! $this->requetePrepare($requete, [$ingredient->getId()])){
            throw new Exception("échec de la suppression du ingredient");
        }
    }
}