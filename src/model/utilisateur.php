<?php

declare(strict_types=1);

/**
 * Classe du modèle contenant les données des utilisateurs (éditeurs et administrateurs).
 * 
 * @see UtilisateurManager
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class Utilisateur {
    // Champs obligatoires
    private string $pseudo;
    private string $email;

    // Champs définitifs
    private string $type;

    // Champs facultatifs
    private string $nom;
    private string $prenom;

    // Champs en lecture seule
    private string $id;
    private string $dateInscription;
    private string $statut;
    
    /**
     * Constructeur paramétré de la classe Utilisateur 
     * (certains paramètres sont facultatifs).
     *
     * @param string $pseudo pseudo de l'utilisateur
     * @param string $email adresse email de l'utilisateur
     * @param string $type type de l'utilisateur 
     * ("E" pour éditeur, "A" pour administrateur)
     * @param string $nom nom de l'utilisateur (facultatif)
     * @param string $prenom prénom de l'utilisateur (facultatif)
     * @param string $statut statut de l'utilisateur
     * ("A" pour actif, "S" pour suspendu, "D" pour supprimé) 
     * (lecture seule, des méthodes existent dans UtilisateurManager 
     * pour suspendre ou supprimer un compte utilisateur).
     * @param string $id id de l'utilisateur (lecture seule)
     * @param string $dateInscription date d'inscription (lecture seule)
     */
    public function __construct(string $pseudo, string $email, string $type, string $statut = "A", string $id = "", string $nom = "", string $prenom = "", string $dateInscription = ""){$this->pseudo = $pseudo;$this->email = $email;$this->type = $type;$this->nom = $nom;$this->prenom = $prenom;$this->statut = $statut;$this->id = $id;$this->dateInscription = $dateInscription;}

    /**
     * Renvoie le pseudo de l'utilisateur.
     * @return string
     */
    public function getPseudo(): string {return $this->pseudo;}

    /**
     * Renvoie l'adresse email de l'utilisateur.
     * @return string
     */
	public function getEmail(): string {return $this->email;}

    /**
     * Renvoie le nom de l'utilisateur.
     * @return string
     */
	public function getNom(): string {return $this->nom;}

    /**
     * Renvoie le prénom de l'utilisateur.
     * @return string
     */
	public function getPrenom(): string {return $this->prenom;}

    /**
     * Renvoie l'id de l'utilisateur.
     * @return string
     */
	public function getId(): string {return $this->id;}

    /**
     * Renvoie la date d'inscription (string) de l'utilisateur.
     * @return string
     */
	public function getDateInscription(): string {return $this->dateInscription;}

    /**
     * Renvoie true si l'utilisateur est un administrateur, 
     * false si c'est un éditeur.
     * @return string
     */
    public function estAdministrateur(): bool {return $this->type === "A";}

    	
	/**
	 * Renvoie le statut de l'utilisateur
     * ("A" pour actif, "S" pour suspendu, "D" pour supprimé).
	 * @return string
	 */
	public function getStatut(): string {return $this->statut;}

    /**
     * Renvoie true si l'utilisateur est actif (ni suspendu ni supprimé), 
     * sinon renvoie false.
     * @return string
     */
    public function estActif(): bool {return $this->statut === "A";}

        
    /**
     * Change le pseudo de l'utilisateur.
     * @param string $pseudo
     * @return void
     */
    public function setPseudo(string $pseudo): void {$this->pseudo = $pseudo;}

    /**
     * Change l'adresse email de l'utilisateur.
     * @param string $email
     * @return void
     */
	public function setEmail(string $email): void {$this->email = $email;}

    /**
     * Change le nom de l'utilisateur.
     * @param string $nom
     * @return void
     */
	public function setNom(string $nom): void {$this->nom = $nom;}

    /**
     * Change le prénom de l'utilisateur.
     * @param string $prenom
     * @return void
     */
	public function setPrenom(string $prenom): void {$this->prenom = $prenom;}
}