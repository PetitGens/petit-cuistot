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
}