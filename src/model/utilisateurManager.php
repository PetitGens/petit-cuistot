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
    
        
    /**
     * Renvoie un utilisateur en fonction de son id.
     * @param string $id l'id de l'utilisateur (pas son identifiant de connexion)
     * @return ?Utilisateur
     */
    public function getUtilisateur(string $id): ?Utilisateur{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Renvoie tous les utilisateurs, sauf ceux qui ont été supprimés.
     *
     * @return array un tableau d'Utilisateurs
     */
    public function getUtilisateurs(): array{
        throw new Exception('not implemented yet');
    }
    
    /**
     * Tente de connecter un utilisateur.
     * Renvoie l'Utilisateur si la connexion a réussi, sinon renvoie null.
     * @param string $identifiant le pseudo ou l'adresse email de l'utilisateur.
     * @param string $hashMdp le mot de passe hashé de l'utilisateur
     * @return ?Utilisateur
     */
    public function connecter(string $identifiant, string $hashMdp): ?Utilisateur{
        throw new Exception('not implemented yet');
    }

        
    /**
     * Suspends un utilisateur (change son statut).
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function suspendreUtilisateur(Utilisateur $utilisateur){
        throw new Exception('not implemented yet');
    }
    
    /**
     * Rends à nouveau actif un utilisateur qui était suspendu.
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function leverSuspension(Utilisateur $utilisateur){
        throw new Exception('not implemented yet');
    }

        
    /**
     * Supprime un utilisateur du site.
     * Ne le supprimera pas de la base, 
     * mais lui donnera un statut qui le rendra invisible sur le site.
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function supprimerUtilisateur(Utilisateur $utilisateur){
        throw new Exception('not implemented yet');
    }
}