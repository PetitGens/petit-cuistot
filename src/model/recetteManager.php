<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/recette.php';
require_once 'src/model/tag.php';
require_once 'src/model/ingredient.php';


/**
 * Classe utilitaire permettant de gérer les recettes de la base (CRUD).
 * 
 * @see Recette
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class RecetteManager extends Manager {

    /**
     * Renvoie une recette en fonction de son id.
     * @param string $id
     * @return ?Recette
     */
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

    /**
     * Renvoie toutes les recettes.
     * @return array un tableau d'objets Recette
     */
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

    /**
     * Renvoie un certain nombre de recettes triés par ordre chronologiques.
     * Par exemple, appelées avec la valeur 5, cette méthode 
     * renvoie les 5 dernières recettes.
     * @param int $nombre le nombre de recettes à renvoyer
     * @return array un tableau d'objets Recette
     */
    public function getDernieresRecettes(int $nombre): array{
        throw new Exception('not implemented yet');
    }

    /**
     * Renvoie les recettes soumise pour validation pour la vue 
     * administrateur.
     * @return array un tableau d'objets Recette
     */
    public function getRecettesNonValidees(): array{
        throw new Exception('not implemented yet');
    }

    /**
     * Renvoie les recettes appartenant à la catégorie donnée en paramètre.
     * @param string $categorie le nom de la catégorie
     * @return array un tableau d'objets Recette
     */
    public function getParCategorie(string $categorie): array{
        throw new Exception('not implemented yet');
    }

    /**
     * Renvoie les recettes contenant tous les ingrédients 
     * du tableau donné en paramètre.
     * @param array $ingredients un tableau d'objets Ingredient
     * @return array un tableau d'objets Recette
     * @see Ingredient
     */
    public function getParIngredients(array $ingredients): array{
        throw new Exception('not implemented yet');
    }

    /**
     * Renvoie toutes les recettes d'un utilisateur.
     * @param string $idUtilisateur l'id (pas identifiant) de l'utilisateur
     * @return array un tableau d'objets Recette
     * @see Utilisateur
     */
    public function getParUtilisateur(string $idUtilisateur): array{
        throw new Exception('not implemented yet');
    }

    /**
     * Insert une recette dans la base de données.
     * @param Recette $recette
     * @return void
     */
    public function creerRecette(Recette $recette): void{
        throw new Exception('not implemented yet');
    }

    /**
     * Met à jour une recette existante à partir de l'objet
     * donné en paramètre.
     * N.B. : pour une modification par un éditeur, celle-ci doit être
     * validé par un administrateur ; 
     * utiliser la méthode "soumettreModification" dans ce cas
     * @param Recette $recette
     * @return void
     */
    public function majRecette(Recette $recette): void{
        throw new Exception('not implemented yet');
    }

    /**
     * Supprime une recette de la base.
     * @param Recette $recette la recette à supprimer
     */
    public function supprimerRecette(Recette $recette): void{
        throw new Exception('not implemented yet');
    }

    /**
     * Soumet une recette modifiée à validation pour un administrateur.
     * La recette modifiée sera stocké dans une autre table en attendant d'être validé,
     * elle remplacera alors l'ancienne version dans la table principale.
     * @param Recette $recette la recette modifiée
     * @return void
     */
    public function soumettreModification(Recette $recette): void{
        throw new Exception('not implemented yet');
    }

    /**
     * Valide une recette crée par un éditeur.
     * Elle sera alors visible par tous les internautes.
     * @param Recette $recette la recette à valider
     * @return void
     */
    public function validerRecette(Recette $recette): void{
        throw new Exception('not implemented yet');
    }

    /**
     * Valide une modification de recette.
     * @param Recette $recette la recette à valider
     */
    public function validerModification(Recette $recette): void{
        throw new Exception('not implemented yet');
    }
}