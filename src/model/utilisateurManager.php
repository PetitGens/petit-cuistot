<?php

declare(strict_types=1);

require_once 'src/model/manager.php';
require_once 'src/model/utilisateur.php';

/**
 * Classe utilitaire permettant de gérer les utilisateurs de la base (CRUD).
 * 
 * @see Utilisateur
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class UtilisateurManager extends Manager{

    private function utilisateurFromLigne(array $ligne): Utilisateur{
        $pseudo = $ligne['UTIL_PSEUDO'];
        $email = $ligne['UTIL_EMAIL'];
        $type = $ligne['UTIL_TYPE'];
        $nom = $ligne['UTIL_NOM'];
        $prenom = $ligne['UTIL_PRENOM'];
        $statut = $ligne['UTIL_STATUT'];
        $id = strval($ligne['UTIL_ID']);
        $dateInscription = $ligne['UTIL_DATE_INSCRIPTION'];

        return new Utilisateur($pseudo, $email, $type, $statut, $id, $nom, $prenom, $dateInscription);
    }
        
    /**
     * Renvoie un utilisateur en fonction de son id.
     * @param string $id l'id de l'utilisateur (pas son identifiant de connexion)
     * @return ?Utilisateur
     */
    public function getUtilisateur(string $id): ?Utilisateur{
        $requete = 
        "select * from CUI_UTILISATEUR
        WHERE UTIL_ID = '$id'";

        $resultat = $this->projectionBdd($requete);

        if(count($resultat) === 0){
            return null;
        }

        return $this->utilisateurFromLigne($resultat[0]);
    }
        
    /**
     * Renvoie tous les utilisateurs, sauf ceux qui ont été supprimés.
     *
     * @return array un tableau d'Utilisateurs
     */
    public function getUtilisateurs(): array{
        $requete = "select * from CUI_UTILISATEUR WHERE UTIL_STATUT != 'D'";

        $resultat = $this->projectionBdd($requete);

        $utilisateurs = [];
        foreach($resultat as $ligne){
            $utilisateurs[] = $this->utilisateurFromLigne($ligne);
        }

        return $utilisateurs;
    }
    
    /**
     * Tente de connecter un utilisateur.
     * Renvoie l'Utilisateur si la connexion a réussi, sinon renvoie null.
     * @param string $identifiant le pseudo ou l'adresse email de l'utilisateur.
     * @param string $motDePasse le mot de passe de l'utilisateur
     * @return ?Utilisateur
     */
    public function connecter(string $identifiant, string $motDePasse): ?Utilisateur{
        $requete = 
        "select * from CUI_UTILISATEUR
        WHERE UTIL_STATUT = 'A'
        AND (UTIL_PSEUDO = '$identifiant' OR UTIL_EMAIL = '$identifiant')";

        $resultat = $this->projectionBdd($requete);

        if(count($resultat) > 1){
            throw new Exception("plusieurs utilisateurs ont été trouvés");
        }

        if(count($resultat) === 0){
            return null;
        }

        if(! password_verify($motDePasse, $resultat[0]["UTIL_MDP"])){
            return null;
        }

        return $this->utilisateurFromLigne($resultat[0]);
    }

    private function setStatut(Utilisateur $utilisateur, string $codeStatut): void{
        $requete = "UPDATE CUI_UTILISATEUR SET UTIL_STATUT = ? WHERE UTIL_ID = ?";
        $nbLignes = $this->requetePrepare($requete, [$codeStatut, $utilisateur->getId()]);
        if($nbLignes === 0){
            throw new Exception("échec du changement de statut");
        }
    }
        
    /**
     * Suspends un utilisateur (change son statut).
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function suspendreUtilisateur(Utilisateur $utilisateur){
        $this->setStatut($utilisateur, 'S');
    }
    
    /**
     * Rends à nouveau actif un utilisateur qui était suspendu.
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function leverSuspension(Utilisateur $utilisateur){
        $this->setStatut($utilisateur, 'A');
    }

        
    /**
     * Supprime un utilisateur du site.
     * Ne le supprimera pas de la base, 
     * mais lui donnera un statut qui le rendra invisible sur le site.
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function supprimerUtilisateur(Utilisateur $utilisateur){
        $this->setStatut($utilisateur, 'D');
    }
}