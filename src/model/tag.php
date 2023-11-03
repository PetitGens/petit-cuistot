<?php

declare(strict_types=1);

/**
 * Classe contenant les données d'un tag de recettes.
 * 
 * @see TagManager
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class Tag{
    private string $id;
    private string $intitule;
    private string $description;

        
    /**
     * Constructeur paramétré de la classe Tag.
     *
     * @param string $intitule intitulé (nom) du tag
     * @param string $id id du tag (lecture seulement)
     * @param string $description description du tag (facultatif)
     */
    public function __construct(string $intitule, string $id = "",  string $description = ""){$this->id = $id;$this->intitule = $intitule;$this->description = $description;}
        
    /** 
     * Renvoie l'id du tag.
     * @return string
     */
    public function getId(): string {return $this->id;}

    /**
     * Renvoie l'intitulé (nom) du tag.
     * @return string
     */
	public function getIntitule(): string {return $this->intitule;}

    /**
     * Renvoie la description du tag.
     * @return string
     */
	public function getDescription(): string {return $this->description;}
  	
	/**
	 * Modifie l'intitulé (nom) du tag.
	 * @param string $intitule
	 * @return void
	 */
	public function setIntitule(string $intitule): void {$this->intitule = $intitule;}

    /**
	 * Modifie la description du tag.
	 * @param string $description
	 * @return void
	 */
	public function setDescription(string $description): void {$this->description = $description;}

	
}