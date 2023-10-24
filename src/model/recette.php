<?php

declare(strict_types=1);

class Recette {
    private string $id;
    private string $titre;
    private string $contenu;
    private string $resume;
    private string $image;
    private string $date_creation;
    private ?string $date_modification;
    private string $statut;
    private string $auteur;
    private string $categorie;

    public function __construct(string $id, string $titre, string $contenu, string $resume, string $image, string $date_creation, 
    ?string $date_modification, string $statut, string $idAuteur, string $codeCategorie)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->resume = $resume;
        $this->image = $image;
        $this->date_creation = $date_creation;
        $this->date_modification = $date_modification;
        $this->statut = $statut;
        $this->auteur = $idAuteur;
        $this->categorie = $codeCategorie;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getTitre(): string{
        return $this->titre;
    }

    public function getContenu(): string{
        return $this->contenu;
    }

    public function getResume(): string{
        return $this->resume;
    }

    public function getUrlImage(): string{
        return $this->image;
    }

    public function getDateCreation(): string{
        return $this->date_creation;
    }

    public function getDateModification(): string{
        return $this->date_modification;
    }

    public function estValide(): bool{
        return $this->statut === "V";
    }

    public function getAuteur(){
        throw new Exception("not implemented yet");
    }
}