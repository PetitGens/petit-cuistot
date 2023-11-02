<?php

declare(strict_types=1);

require_once 'src/model/tag.php';
require_once 'src/model/tagManager.php';
require_once 'src/model/ingredient.php';
require_once 'src/model/ingredientManager.php';
require_once 'src/model/utilisateur.php';
require_once 'src/model/utilisateurManager.php';

/**
 * Classe du modèle contenant les données d'une recette, 
 * soit les données de la table recette ainsi que le pseudo de l'auteur et le nom de la catégorie.
 * 
 * @see RecetteManager
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class Recette {
    private string $id;
    private string $titre;
    private string $contenu;
    private string $resume;
    private string $image;
    private string $date_creation;
    private string $date_modification;
    private string $statut;
    private string $idAuteur;
    private string $pseudoAuteur;
    private string $categorie;

    /**
     * Constructeur paramétré de la classe Recette
	 * (certains paramètres sont facultatifs)
     *
     * @param string $titre titre de la recette
     * @param string $contenu texte de la recette
     * @param string $resume résumé de la recette
     * @param string $image lien vers l'image de la recette
     * @param string $statut statut de la recette -> "V" pour validée (visible) ou "A" pour en attente de validation
     * @param string $idAuteur id de l'auteur de la recette (@see Utilisateur)
     * @param string $categorie intitulé de la catégorie de la recette
     * @param string $id id de la recette (seulement pour la lecture)
     * @param string $pseudoAuteur pseudo de l'auteur (seulement pour la lecture)
     * @param string $date_creation date de  création de la recettte (seulement pour la lecture)
     * @param string $date_modification date de la dernière modification (seulement pour la lecture)
     */
    public function __construct(string $titre, string $contenu, string $resume, string $image, string $statut, string $idAuteur, string $categorie, string $id = "", string $pseudoAuteur = "", string $date_creation = "", string $date_modification = ""){$this->id = $id;$this->titre = $titre;$this->contenu = $contenu;$this->resume = $resume;$this->image = $image;$this->date_creation = $date_creation;$this->date_modification = $date_modification;$this->statut = $statut;$this->idAuteur = $idAuteur;$this->pseudoAuteur = $pseudoAuteur;$this->categorie = $categorie;}
    
    /**
     * Renvoie l'id de la recette.
     * @return string
     */
    public function getId(): string {return $this->id;}
    	
	/**
	 * Renvoie le titre de la recette.
	 * @return string
	 */
	public function getTitre(): string {return $this->titre;}

    	
	/**
	 * Renvoie le contenu (corps) de la recette.
	 * @return string
	 */
	public function getContenu(): string {return $this->contenu;}

    	
	/**
	 * Renvoie le résumé de la recette.
	 * @return string
	 */
	public function getResume(): string {return $this->resume;}

    	
	/**
	 * Renvoie le lien (URL) de l'image.
	 * @return string
	 */
	public function getImage(): string {return $this->image;}

    	
	/**
	 * Renvoie la date de création (en string) de la recette.
	 * @return string
	 */
	public function getDateCreation(): string {return $this->date_creation;}
    	
	/**
	 * Renvoie la date de dernière modification (en string) de la recette.
	 * @return string
	 */
	public function getDateModification(): string {return $this->date_modification;}
    	
	/**
	 * Renvoie l'id de l'auteur de la recette.
	 * @return string
     * @see Utilisateur
	 */
	public function getIdAuteur(): string {return $this->idAuteur;}

    /**
	 * Renvoie le pseudo de l'auteur de la recette.
	 * @return string
     * @see Utilisateur
	 */
	public function getPseudoAuteur(): string {return $this->pseudoAuteur;}

    /**
	 * Renvoie le code de la catégorie de la recette.
	 * @return string
     * @see Categorie
	 */
	public function getCategorie(): string {return $this->categorie;}
        
    /**
     * Renvoie true si la recette est validée, false sinon.
     * @return bool
     */
    public function estValide(): bool{
        return $this->statut === "V";
    }

	/**
	 * Renvoie true si la recette est en attente de validation pour modification.
	 * Sinon, renvoie false.
	 */
	public function estModifiee(): bool {
		return $this->statut === "M";
	}
        
    /**
     * Renvoie l'auteur de la recette.
     * @return Utilisateur
     * @see Utilisateur
     */
    public function getAuteur(): Utilisateur{
        return (new UtilisateurManager)->getUtilisateur($this->idAuteur);
    }

	/**
	 * Renvoie tous les tags de la recette.
	 * @return array un tableau d'objets Tag
	 * @see Tag
	 */
	public function getTags(): array{
		return (new TagManager)->getParRecette($this->id);
	}

	public function ajouterTag(Tag $tag){
		(new TagManager)->ajouterTagARecette($tag, $this->id);
	}

	public function supprimerTag(Tag $tag){
		(new TagManager)->supprimerTagDeRecette($tag, $this->id);
	}

	public function getIngredients(): array{
		return (new IngredientManager)->getParRecette($this->id);
	}

	public function ajouterIngredient(Ingredient $ingredient){
		(new IngredientManager)->ajouterIngredientARecette($ingredient, $this->id);
	}

	public function supprimerIngredient(Ingredient $ingredient){
		(new IngredientManager)->supprimerIngredientDeRecette($ingredient, $this->id);
	}
    	
	/**
	 * Modifie le titre de la recette (en local, pas en bdd).
	 * @param string $titre
	 * @return void
	 */
	public function setTitre(string $titre): void {$this->titre = $titre;}

    /**
	 * Modifie le contenu de la recette (en local, pas en bdd).
	 * @param string $contenu
	 * @return void
	 */
	public function setContenu(string $contenu): void {$this->contenu = $contenu;}

    /**
	 * Modifie le résumé de la recette (en local, pas en bdd).
	 * @param string $resume
	 * @return void
	 */
	public function setResume(string $resume): void {$this->resume = $resume;}

    /**
	 * Modifie l'url de l'image (en local, pas en bdd).
	 * @param string $image
	 * @return void
	 */
	public function setImage(string $image): void {$this->image = $image;}

    /**
	 * Modifie le code de catégorie (en local, pas en bdd).
	 * @param string $codeCategorie
	 * @return void
	 */
	public function setCategorie(string $categorie): void {$this->categorie = $categorie;}
}