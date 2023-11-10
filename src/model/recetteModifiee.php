<?php

declare(strict_types=1);

require_once 'src/model/tag.php';
require_once 'src/model/tagManager.php';
require_once 'src/model/ingredient.php';
require_once 'src/model/ingredientManager.php';
require_once 'src/model/recette.php';

class RecetteModifiee extends Recette {

	public static function getInstanceFromRecette(Recette $recette): RecetteModifiee {
		return new RecetteModifiee($recette->getTitre(), $recette->getContenu(), 
		$recette->getResume(), $recette->getImage(), $recette->statut, $recette->getIdAuteur(),
		$recette->getCategorie(), $recette->getId(), $recette->getPseudoAuteur(), $recette->getDateCreation(),
		$recette->getDateModification());
	}

    /**
	 * Renvoie tous les tags de la recette.
	 * @return array un tableau d'objets Tag
	 * @see Tag
	 */
	public function getTags(): array{
		return (new TagManager)->getParRecetteModifiee($this->getId());
	}

	public function ajouterTag(Tag $tag){
		(new TagManager)->ajouterTagARecetteModifiee($tag, $this->getId());
	}

	public function supprimerTag(Tag $tag){
		(new TagManager)->supprimerTagDeRecetteModifiee($tag, $this->getId());
	}

	public function getIngredients(): array{
		return (new IngredientManager)->getParRecetteModifiee($this->getId());
	}

	public function ajouterIngredient(Ingredient $ingredient){
		(new IngredientManager)->ajouterIngredientARecetteModifiee($ingredient, $this->getId());
	}

	public function supprimerIngredient(Ingredient $ingredient){
		(new IngredientManager)->supprimerIngredientDeRecetteModifiee($ingredient, $this->getId());
	}
}