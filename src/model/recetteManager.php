<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/recette.php';
require_once 'src/model/recetteModifiee.php';
require_once 'src/model/tag.php';
require_once 'src/model/ingredient.php';
require_once 'src/model/categorieManager.php';

/**
 * Classe utilitaire permettant de gérer les recettes de la base (CRUD).
 * 
 * @see Recette
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>,
 * Guilhem Saint Gaudin <guilhem.saint-gaudin@etu.unicaen.fr>
 */
class RecetteManager extends Manager {

    private function recetteFromLigne(array $ligne): Recette {
        $id = strval($ligne['REC_ID']);
        $titre = $ligne['REC_TITRE'];
        $resume = $ligne['REC_RESUME'];
        $contenu = $ligne['REC_CONTENU'];
        $image = $ligne['REC_IMAGE'];
        $date_creation = $ligne['REC_DATE_CREATION'];
        $statut = $ligne['REC_STATUT'];
        $categorie = $ligne['CAT_INTITULE'];
        $idAuteur = strval($ligne['UTIL_ID']);
        $pseudoAuteur = $ligne['UTIL_PSEUDO'];

        $date_modification = $ligne['REC_DATE_MODIFICATION'];
        if(is_null($date_modification)){
            $date_modification = '';
        }

        return new Recette($titre, $contenu, $resume, $image, $statut, $idAuteur, $categorie, $id, $pseudoAuteur, $date_creation, $date_modification);
    }

    private function recetteModifieeFromLigne(array $ligne): RecetteModifiee{
        $id = strval($ligne['REC_ID']);
        $titre = $ligne['REC_MOD_TITRE'];
        $resume = $ligne['REC_MOD_RESUME'];
        $contenu = $ligne['REC_MOD_CONTENU'];
        $image = $ligne['REC_MOD_IMAGE'];
        $date_creation = $ligne['REC_DATE_CREATION'];
        $statut = 'M';
        $categorie = $ligne['CAT_INTITULE'];
        $idAuteur = strval($ligne['UTIL_ID']);
        $pseudoAuteur = $ligne['UTIL_PSEUDO'];

        $date_modification = $ligne['REC_MOD_DATE_MODIFICATION'];
        if(is_null($date_modification)){
            $date_modification = '';
        }

        return new RecetteModifiee($titre, $contenu, $resume, $image, $statut, $idAuteur, $categorie, $id, $pseudoAuteur, $date_creation, $date_modification);
    }

    /**
     * Renvoie une recette en fonction de son id.
     * @param string $id
     * @return ?Recette
     */
    public function getRecette(string $id) : ?Recette{
        $requete = 
        "SELECT * FROM CUI_RECETTE 
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        WHERE rec_id='$id'";
        $resultat = self::projectionBdd($requete);
        
        if(! isset($resultat[0])) {
            return null;
        }

        $ligne = $resultat[0];

        return self::recetteFromLigne($ligne);
    }

    /**
     * Renvoie la version modifiée d'une recette si elle existe
     * @param string $id l'id de la recette
     * @return ?RecetteModifiee
     */
    public function getRecetteModifiee(string $id) : ?RecetteModifiee{
        $requete = 
        "SELECT REC_ID, REC_MOD_TITRE, REC_MOD_CONTENU, REC_MOD_RESUME, REC_MOD_IMAGE, REC_MOD_DATE_MODIFICATION,
        CUI_RECETTE_MODIFIEE.CAT_CODE CAT_CODE, UTIL_ID
        FROM CUI_RECETTE_MODIFIEE
        JOIN CUI_RECETTE USING(REC_ID)
        JOIN CUI_CATEGORIE ON CUI_CATEGORIE.CAT_CODE = CUI_RECETTE_MODIFIEE.CAT_CODE
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        WHERE rec_id='1'";
        $resultat = self::projectionBdd($requete);
        
        if(! isset($resultat[0])) {
            return null;
        }

        $ligne = $resultat[0];

        return self::recetteModifieeFromLigne($ligne);
    }

    /**
     * Renvoie toutes les recettes.
     * @return array un tableau d'objets Recette
     */
    public function getRecettes(): array{
        $requete = 
        "SELECT * FROM CUI_RECETTE
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        ORDER BY REC_DATE_CREATION DESC";

        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = self::recetteFromLigne($ligne);
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
        $requete = 
        "SELECT * FROM CUI_RECETTE 
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        ORDER BY REC_DATE_CREATION DESC LIMIT $nombre";

        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = self::recetteFromLigne($ligne);
        }

        return $recettes;
    }

    /**
     * Renvoie les recettes soumise pour validation pour la vue 
     * administrateur.
     * @return array un tableau d'objets Recette
     */
    public function getRecettesNonValidees(): array{

        $requete = 
        "SELECT * FROM CUI_RECETTE
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        WHERE REC_STATUT != 'V'";
        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = self::recetteFromLigne($ligne);
        }

        return $recettes;

    }

    /**
     * Renvoie les recettes appartenant à la catégorie donnée en paramètre.
     * @param string $categorie le nom de la catégorie
     * @return array un tableau d'objets Recette
     */
    public function getParCategorie(string $categorie): array{
        $requete = "SELECT * FROM CUI_RECETTE 
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        WHERE CAT_INTITULE = '$categorie'";

        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = self::recetteFromLigne($ligne);
        }

        return $recettes;

    }

    /**
     * Renvoie les recettes contenant tous les ingrédients 
     * du tableau donné en paramètre.
     * @param array $ingredients un tableau d'objets Ingredient
     * @return array un tableau d'objets Recette
     * @see Ingredient
     */
    public function getParIngredients(array $ingredients): array{
        /*TODO
        $requete = "SELECT * FROM CUI_RECETTE WHERE CAT_INTITULE = '$categorie'";
        $list = [];
        
        for(int $i = 1; i<=count($ingredients); $i++){
            $list[] = self::projectionBdd($requete);
        }      */  
        
        throw new Exception('not implemented yet');
    }

    /**
     * Renvoie toutes les recettes d'un utilisateur.
     * @param string $idUtilisateur l'id (pas identifiant) de l'utilisateur
     * @return array un tableau d'objets Recette
     * @see Utilisateur
     */
    public function getParUtilisateur(string $idUtilisateur): array{

        $requete = "SELECT * FROM CUI_RECETTE
        JOIN CUI_CATEGORIE USING (CAT_CODE)
        JOIN CUI_UTILISATEUR USING (UTIL_ID)
        WHERE UTIL_ID = '$idUtilisateur'";
        $resultat = self::projectionBdd($requete);
        $recettes = [];

        foreach($resultat as $ligne){
            $recettes[] = self::recetteFromLigne($ligne);
        }

        return $recettes;

    }

    /**
     * Insère une recette dans la base de données.
     * @param Recette $recette
     * @return void
     */
    public function creerRecette(Recette $recette): void{
        $categorie = (new CategorieManager)->getCodeCategorie($recette->getCategorie());

        if(is_null($categorie)){
            throw new InvalidArgumentException("Cette catégorie n'existe pas : ".$recette->getCategorie());
        }

        $requete = 
        "INSERT INTO CUI_RECETTE (REC_TITRE, REC_CONTENU, REC_RESUME, 
        REC_IMAGE, REC_DATE_CREATION, REC_STATUT, CAT_CODE, UTIL_ID)
        VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";

        $parametres[0] = $recette->getTitre();
        $parametres[1] = $recette->getContenu();
        $parametres[2] = $recette->getResume();
        $parametres[3] = $recette->getImage();
        $parametres[4] = $recette->estValide() ? 'V' : 'A';
        $parametres[5] = $categorie;
        $parametres[6] = $recette->getIdAuteur();

        if(self::requetePrepare($requete, $parametres) != 1){
            throw new Exception("Échec pendant la création de recette.");
        }
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
        //TODO écrire la méthode
        throw new Exception('not implemented yet');
    }

    /**
     * Supprime une recette de la base.
     * @param Recette $recette la recette à supprimer
     */
    public function supprimerRecette(Recette $recette): void{
        //TODO supprimer les tags et ingrédients de la recette modifiée
        
        $recetteModifiee = self::getRecetteModifiee($recette->getId());

        if($recetteModifiee){
            // Suppression des tags et des ingrédients
            foreach($recetteModifiee->getTags() as $tag){
                $recetteModifiee->supprimerTag($tag);
            }

            foreach($recetteModifiee->getIngredients() as $ingredient){
                $recetteModifiee->supprimerIngredient($ingredient);
            }

            // Suppression de la recette modifiée
            $requete = "DELETE FROM CUI_RECETTE_MODIFIEE WHERE REC_ID = ?";
            if(self::requetePrepare($requete, [$recette->getId()]) != 1){
                throw new Exception("Échec de la suppression de la recette.");
            }
        }

        // Suppression des tags et des ingrédients
        foreach($recette->getTags() as $tag){
            $recette->supprimerTag($tag);
        }

        foreach($recette->getIngredients() as $ingredient){
            $recette->supprimerIngredient($ingredient);
        }

        $requete = "DELETE FROM CUI_RECETTE WHERE REC_ID = ?";

        if(self::requetePrepare($requete, [$recette->getId()]) != 1){
            throw new Exception("Échec de la suppression de recette.");
        }
    }

    /**
     * Soumet une recette modifiée à validation pour un administrateur.
     * La recette modifiée sera stocké dans une autre table en attendant d'être validé,
     * elle remplacera alors l'ancienne version dans la table principale.
     * @param Recette $recette la recette modifiée
     * @return void
     */
    public function soumettreModification(Recette $recette): void{
        //TODO écrire la méthode
        throw new Exception('not implemented yet');
    }

    /**
     * Valide une recette crée par un éditeur.
     * Elle sera alors visible par tous les internautes.
     * @param Recette $recette la recette à valider
     * @return void
     */
    public function validerRecette(Recette $recette): void{
        //TODO écrire la méthode
        throw new Exception('not implemented yet');
    }

    /**
     * Valide une modification de recette.
     * @param Recette $recette la recette à valider
     */
    public function validerModification(Recette $recette): void{
        //TODO écrire la méthode
        throw new Exception('not implemented yet');
    }
}