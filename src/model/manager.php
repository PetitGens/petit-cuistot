<?php

declare(strict_types=1);

require_once 'src/lib/database.php';

/**
 * Classe abtraite pour gérer les entités de base de données (CRUD).
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
abstract class Manager{
    protected PDO $bdd;

    /**
     * Constructeur de la classe.
     * Instancie l'objet PDO en utilisant un singleton.
     * 
     * @see ConnectionBdd
     */
    public function __construct(){
        $this->bdd = ConnectionBdd::getInstance();
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Exécute la requête de projection donnée en paramètre et 
     * renvoie le résultat sous forme de tableau qui contient 
     * toutes les lignes retournées par la requête.
     * @param string $requete la requête de projection à exécuter
     * @return array
     */
    public function projectionBdd(string $requete): array{
        $lignes = [];

        $statement =  $this->bdd->query($requete);

        while($ligne = $statement->fetch()){
            $lignes[] = $ligne;
        }

        return $lignes;
    }

    /**
     * Exécute la requête préparée donnée en paramètre.
     * @param string $requete la requête à exécutée, 
     * formattée comme requête préparée
     * @param array $parametres les paramètres (string) de la requête préparée
     * @return int le nombres de lignes affectées par la requête.
     */
    public function requetePrepare(string $requete, array $parametres): int{
        $statement = $this->bdd->prepare($requete);
        $statement->execute($parametres);

        return $statement->rowCount();
    }
}