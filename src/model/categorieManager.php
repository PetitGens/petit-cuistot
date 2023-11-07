<?php

declare(strict_types=1);

require_once 'src/model/manager.php';

/**
 * Classe utilitaire permettant de gérer les catégories de recettes.
 * Les catégories sont manipulés directement en un string 
 * qui contient le nom de la catégorie.
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class CategorieManager extends Manager{    
    /**
     * Renvoie toutes les catégories en base.
     *
     * @return array un tableau contenant les noms de catégorie (string)
     */
    public function getCategories(): array{
        $requete = "SELECT CAT_INTITULE FROM CUI_CATEGORIE";
        $resultat = self::projectionBdd($requete);

        $categories = [];

        foreach($resultat as $ligne){
            $categories[] = $ligne['CAT_INTITULE'];
        }

        return $categories;
    }

    public function getCodeCategorie(string $intitule): ?string {
        $requete = 
        "SELECT CAT_CODE FROM CUI_CATEGORIE
        WHERE lower(CAT_INTITULE) = lower('$intitule')";

        $resultat = self::projectionBdd($requete);
        
        if(count($resultat) === 0){
            return null;
        }

        return $resultat[0]["CAT_CODE"];
    }
}