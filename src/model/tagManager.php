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

    private function tagFromLigne(array $ligne): Tag{
        $id = strval($ligne['TAG_ID']);
        $intitule = $ligne['TAG_INTITULE'];
        $description = $ligne['TAG_DESCRIPTION'];
        if(is_null($description)){
            $description = '';
        }

        return new Tag($intitule, $id, $description);
    }

    /**
     * Renvoie un tag en fonction de son id.
     *
     * @param string $id
     * @return ?Tag
     */
    public function getTag(string $id): ?Tag{
        $resultat = $this->projectionBdd("select TAG_ID, TAG_INTITULE, TAG_DESCRIPTION from CUI_TAG where tag_id = '$id'");
        if(empty($resultat)){
            return null;
        }

        $ligne = $resultat[0];
        return $this->tagFromLigne($ligne);
    }

    public function getTagParNom(string $nom): ?Tag{
        $resultat = $this->projectionBdd("select TAG_ID, TAG_INTITULE, TAG_DESCRIPTION from CUI_TAG where lower(TAG_INTITULE) = '$nom'");
        if(empty($resultat)){
            return null;
        }

        $ligne = $resultat[0];
        return $this->tagFromLigne($ligne);
    }
        
    /**
     * Renvoie tous les tags.
     *
     * @return array
     */
    public function getTags(): array{
        $tags = [];
        $resultat = $this->projectionBdd("select TAG_ID, TAG_INTITULE, TAG_DESCRIPTION from CUI_TAG");
        foreach($resultat as $ligne){
            $tags[] = $this->tagFromLigne($ligne);
        }
        return $tags;
    }
    
    /**
     * Renvoie tous les tags d'une recette.
     *
     * @param string $idRecette id de la recette
     * @return array
     */
    public function getParRecette(string $idRecette): array{
        $requete =
        "SELECT * FROM CUI_TAG
        where TAG_ID in(
            select TAG_ID FROM CUI_ETIQUETTAGE
            WHERE REC_ID = '$idRecette'
        )";

        $resultat = self::projectionBdd($requete);
        $tags = [];

        foreach($resultat as $ligne){
            $tags[] = $this->tagFromLigne($ligne);
        }

        return $tags;
    }

    /**
     * Renvoie tous les tags d'une recette modifiée.
     *
     * @param string $idRecette id de la recette
     * @return array
     * @see RecetteModifiee
     */
    public function getParRecetteModifiee(string $idRecette): array{
        $requete =
        "SELECT * FROM CUI_TAG
        where TAG_ID in(
            select TAG_ID FROM CUI_ETIQUETTAGE_MOD
            WHERE REC_ID = '$idRecette'
        )";

        $resultat = self::projectionBdd($requete);
        $tags = [];

        foreach($resultat as $ligne){
            $tags[] = $this->tagFromLigne($ligne);
        }

        return $tags;
    }
        
    /**
     * Insère le tag donné en paramètre dans la base de données.
     *
     * @param Tag $tag
     * @return void
     */
    public function creerTag(Tag $tag): void{
        $requete = 
        "insert into CUI_TAG(TAG_INTITULE, TAG_DESCRIPTION)
        values (?, NULLIF(?, ''))";

        if(! $this->requetePrepare($requete, [$tag->getIntitule(), $tag->getDescription()])){
            throw new Exception("échec de l'insertion du tag en base de données");
        }
    }

    /**
     * Ajoute un tag à une recette.
     * Si le tag, n'est pas présent dans la base, l'insère.
     * @param Tag $tag le tag à ajouter
     * @param string $idRecette l'id de la recette
     */
    public function ajouterTagARecette(Tag $tag, string $idRecette){
        $tagEnBase = self::getTagParNom($tag->getIntitule());
        if(! $tagEnBase){
            self::creerTag($tag);
            $tagEnBase = self::getTagParNom($tag->getIntitule());
        }

        $requete = 
        "INSERT INTO CUI_ETIQUETTAGE (REC_ID, TAG_ID)
        VALUES (?, ?)";

        if(! self::requetePrepare($requete, [$idRecette, $tagEnBase->getId()])){
            throw new Exception("échec de l'ajout de tag");
        }
    }

    /**
     * Ajoute un tag à une recette modifiée.
     * Si le tag, n'est pas présent dans la base, l'insère.
     * @param Tag $tag le tag à ajouter
     * @param string $idRecette l'id de la recette
     * @see RecetteModifiee
     */
    public function ajouterTagARecetteModifiee(Tag $tag, string $idRecette){
        //TODO écrire la méthode
        throw new Exception("not implemented yet");
    }

    /**
     * Retire un tag d'une recette.
     * @param Tag $tag le tag à enlever
     * @param string $idRecette l'id de la recette
     */
    public function supprimerTagDeRecette(Tag $tag, string $idRecette){
        $tagEnBase = self::getTagParNom($tag->getIntitule());
        if(! $tagEnBase){
            self::creerTag($tag);
            $tagEnBase = self::getTagParNom($tag->getIntitule());
        }

        $requete = 
        "DELETE FROM CUI_ETIQUETTAGE 
        WHERE REC_ID = ? AND TAG_ID = ?";

        if(! self::requetePrepare($requete, [$idRecette, $tagEnBase->getId()])){
            throw new Exception("échec de la suppression du tag de la recette");
        }
    }

    /**
     * Retire un tag d'une recette modifiée.
     * @param Tag $tag le tag à enlever
     * @param string $idRecette l'id de la recette
     * @see RecetteModifiee
     */
    public function supprimerTagDeRecetteModifiee(Tag $tag, string $idRecette){
        //TODO écrire la méthode
        throw new Exception("not implemented yet");
    }
        
    /**
     * Supprime le tag de la base de données.
     *
     * @param Tag $tag
     * @return void
     */
    public function supprimerTag(Tag $tag): void{
        $requete = 
        "delete from CUI_TAG where TAG_ID = ?";

        if(! $this->requetePrepare($requete, [$tag->getId()])){
            throw new Exception("échec de la suppression du tag");
        }
    }
}