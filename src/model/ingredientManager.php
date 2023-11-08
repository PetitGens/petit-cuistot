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
        $id = strval($ligne['ING_ID']);
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

    public function getIngredientParNom(string $nom): ?Ingredient{
        $resultat = $this->projectionBdd("select ING_ID, ING_INTITULE, ING_DESCRIPTION from CUI_INGREDIENT where lower(ING_INTITULE) = '$nom'");
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
     * @param string $idRecette l'id de la recette 
     * @return array
     */
    public function getParRecette(string $idRecette): array{
        $requete =
        "SELECT * FROM CUI_INGREDIENT
        where ING_ID in(
            select ING_ID FROM CUI_COMPOSITION
            WHERE REC_ID = '$idRecette'
        )";

        $resultat = self::projectionBdd($requete);
        $ingredients = [];

        foreach($resultat as $ligne){
            $ingredients[] = $this->ingredientFromLigne($ligne);
        }

        return $ingredients;
    }

    /**
     * Renvoie tous les ingredients d'une recette modifiée.
     *
     * @param string $idRecette l'id de la recette
     * @return array
     * @see RecetteModifiee
     */
    public function getParRecetteModifiee(string $idRecette): array{
        $requete =
        "SELECT * FROM CUI_INGREDIENT
        where ING_ID in(
            select ING_ID FROM CUI_COMPOSITION_MOD
            WHERE REC_ID = '$idRecette'
        )";

        $resultat = self::projectionBdd($requete);
        $ingredients = [];

        foreach($resultat as $ligne){
            $ingredients[] = $this->ingredientFromLigne($ligne);
        }

        return $ingredients;
    }
        
    /**
     * Insère l'ingredient donné en paramètre dans la base de données.
     *
     * @param Ingredient $ingredient
     * @return void
     */
    public function creerIngredient(Ingredient $ingredient): void{
        $requete = 
        "insert into CUI_INGREDIENT(ING_INTITULE, ING_DESCRIPTION)
        values (?, NULLIF(?, ''))";

        if(! $this->requetePrepare($requete, [$ingredient->getIntitule(), $ingredient->getDescription()])){
            throw new Exception("échec de l'insertion de l'ingredient en base de données");
        }
    }

    /**
     * Ajoute un ingrédient à une recette.
     * @param Ingredient $ingredient l'ingrédient à ajouter
     * @param string $idRecette l'id de la recette
     */
    public function ajouterIngredientARecette(Ingredient $ingredient, string $idRecette){
        $ingredientEnBase = self::getIngredientParNom($ingredient->getIntitule());
        if(! $ingredientEnBase){
            self::creerIngredient($ingredient);
            $ingredientEnBase = self::getIngredientParNom($ingredient->getIntitule());
        }

        $requete = 
        "INSERT INTO CUI_COMPOSITION (REC_ID, ING_ID)
        VALUES (?, ?)";

        if(! self::requetePrepare($requete, [$idRecette, $ingredientEnBase->getId()])){
            throw new Exception("échec de l'ajout d'ingrédient");
        }
    }

    /**
     * Ajoute un ingrédient à une recette modifiée.
     * @param Ingredient $ingredient l'ingrédient à ajouter
     * @param string $idRecette l'id de la recette
     * @see RecetteModifiee
     */
    public function ajouterIngredientARecetteModifiee(Ingredient $ingredient, string $idRecette){
        //TODO écrire la méthode
        throw new Exception("not implemented yet");
    }

    /**
     * Retire un ingrédient d'une recette.
     * @param Ingredient $ingredient l'ingrédient à enlever
     * @param string $idRecette l'id de la recette
     */
    public function supprimerIngredientDeRecette(Ingredient $ingredient, string $idRecette){
        $ingredientEnBase = self::getIngredientParNom($ingredient->getIntitule());
        if(! $ingredientEnBase){
            self::creerIngredient($ingredient);
            $ingredientEnBase = self::getIngredientParNom($ingredient->getIntitule());
        }

        $requete = 
        "DELETE FROM CUI_COMPOSITION 
        WHERE REC_ID = ? AND ING_ID = ?";

        if(! self::requetePrepare($requete, [$idRecette, $ingredientEnBase->getId()])){
            throw new Exception("échec de la suppression de l'ingrédient de la recette");
        }
    }

    /**
     * Retire un ingrédient d'une recette modifiée.
     * @param Ingredient $ingredient l'ingrédient à enlever
     * @param string $idRecette l'id de la recette
     * @see RecetteModifiee
     */
    public function supprimerIngredientDeRecetteModifiee(Ingredient $ingredient, string $idRecette){
        //TODO écrire la méthode
        throw new Exception("not implemented yet");
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
            throw new Exception("échec de la suppression de l'ingredient");
        }
    }
}