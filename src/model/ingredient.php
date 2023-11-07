<?php

declare(strict_types=1);

/**
 * Classe contenant les données d'un ingrédient.
 * 
 * @see IngredientManager
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class Ingredient{
    private string $id;
    private string $intitule;
    private string $description;

        
    /**
     * Constructeur paramétré de la classe Ingredient.
     *
     * @param string $intitule intitulé (nom) de l'ingredient
     * @param string $id id de l'ingredient (lecture seulement)
     * @param string $description description de l'ingredient (facultatif)
     */
    public function __construct(string $intitule, string $id = "",  string $description = ""){$this->id = $id;$this->intitule = $intitule;$this->description = $description;}

        
    /**
     * Renvoie l'id de l'ingredient.
     * @return string
     */
    public function getId(): string {return $this->id;}

    /**
     * Renvoie l'intitulé (nom) de l'ingredient.
     * @return string
     */
	public function getIntitule(): string {return $this->intitule;}

    /**
     * Renvoie la description de l'ingredient.
     * @return string
     */
	public function getDescription(): string {return $this->description;}
  	
	/**
	 * Modifie l'intitulé (nom) de l'ingredient.
	 * @param string $intitule
	 * @return void
	 */
	public function setIntitule(string $intitule): void {$this->intitule = $intitule;}

    /**
	 * Modifie la description de l'ingredient.
	 * @param string $description
	 * @return void
	 */
	public function setDescription(string $description): void {$this->description = $description;}

	
}