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
        throw new Exception('not implemented yet');
    }

        
    /**
     * Insert le tag donné en paramètre dans la base de données.
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
     * @param Tag $tag le tag à ajouter
     * @param string $idRecette l'id de la recette
     */
    public function ajouterTagARecette(Tag $tag, string $idRecette){
        throw new Exception("not implemented yet");
    }

    /**
     * Retire un tag d'une recette.
     * @param Tag $tag le tag à enlever
     * @param string $idRecette l'id de la recette
     */
    public function supprimerTagDeRecette(Tag $tag, string $idRecette){
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