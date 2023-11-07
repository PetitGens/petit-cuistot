<?php

declare(strict_types=1);

require_once 'src/model/tag.php';
require_once 'src/model/tagManager.php';
require_once 'src/model/ingredient.php';
require_once 'src/model/ingredientManager.php';
require_once 'src/model/recette.php';

class RecetteModifiee extends Recette {
    /**
	 * Renvoie tous les tags de la recette.
	 * @return array un tableau d'objets Tag
	 * @see Tag
	 */
	public function getTags(): array{
		return (new TagManager)->getParRecetteModifiee($this->id);
	}

	public function ajouterTag(Tag $tag){
		(new TagManager)->ajouterTagARecetteModifiee($tag, $this->id);
	}

	public function supprimerTag(Tag $tag){
		(new TagManager)->supprimerTagDeRecetteModifiee($tag, $this->id);
	}

	public function getIngredients(): array{
		return (new IngredientManager)->getParRecetteModifiee($this->id);
	}

	public function ajouterIngredient(Ingredient $ingredient){
		(new IngredientManager)->ajouterIngredientARecetteModifiee($ingredient, $this->id);
	}

	public function supprimerIngredient(Ingredient $ingredient){
		(new IngredientManager)->supprimerIngredientDeRecetteModifiee($ingredient, $this->id);
	}
}