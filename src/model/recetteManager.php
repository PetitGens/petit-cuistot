<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/recette.php';

class RecetteManager extends Manager {
    public function getRecette(string $id) : ?Recette{
        $requete = "SELECT * FROM CUI_RECETTE WHERE rec_id='$id'";
        $resultat = self::projectionBdd($requete);
        
        if(! isset($resultat[0])) {
            return null;
        }

        $ligne = $resultat[0];

        var_dump($ligne);

        return new Recette($ligne['REC_ID'], $ligne['REC_TITRE'], $ligne['REC_CONTENU'], $ligne['REC_RESUME'], $ligne['REC_IMAGE'],
            $ligne['REC_DATE_CREATION'], $ligne['REC_DATE_MODIFICATION'], $ligne['REC_STATUT'], $ligne['UTIL_ID'], $ligne['CAT_CODE']);
    }

    public function getRecettes(): array{
        $requete = "SELECT * FROM CUI_RECETTE ORDER BY REC_DATE_CREATION DESC";
        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = new Recette($ligne['REC_ID'], $ligne['REC_TITRE'], $ligne['REC_CONTENU'], $ligne['REC_RESUME'], $ligne['REC_IMAGE'],
                $ligne['REC_DATE_CREATION'], $ligne['REC_DATE_MODIFICATION'], $ligne['REC_STATUT'], $ligne['UTIL_ID'], $ligne['CAT_CODE']);
        }

        return $recettes;
    }
    public function getRecettesFiltre(string $Filtre,string $VALUE): array{
        switch($Filtre) {
            default: throw(new Exception);
            break;
            case tag: $requete = "SELECT * FROM CUI_RECETTE WHERE CUI_RECETTE.REC_ID IN(SELECT REC_ID FROM CUI_ETIQUETTAGE WHERE CUI_ETIQUETTAGE.TAG_ID IN (SELECT TAG_ID FROM CUI_TAG WHERE CUI_TAG.TAG_INTITULE='{$VALUE}'))";
            break;
            case ingredient : "SELECT * FROM CUI_RECETTE WHERE CUI_RECETTE.REC_ID IN(SELECT REC_ID FROM CUI_INGREDIENT WHERE ING_ID IN (SELECT ING_ID FROM CUI_INGREDIENT WHERE ING_INTITULE='{$VALUE}'))";
            break;
            case nom : "SELECT * FROM CUI_RECETTE WHERE REC_TITRE LIKE ('%{$VALUE}%')";
        }
        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = new Recette($ligne['REC_ID'], $ligne['REC_TITRE'], $ligne['REC_CONTENU'], $ligne['REC_RESUME'], $ligne['REC_IMAGE'],
                $ligne['REC_DATE_CREATION'], $ligne['REC_DATE_MODIFICATION'], $ligne['REC_STATUT'], $ligne['UTIL_ID'], $ligne['CAT_CODE']);
        }

        return $recettes;
    }
}