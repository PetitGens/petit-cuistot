<?php

declare(strict_types=1);

require_once 'src/lib/database.php';

abstract class Manager{
    protected PDO $bdd;

    public function __construct(){
        $this->bdd = ConnectionBdd::getInstance();
    }

    public function projectionBdd(string $requete): array{
        $lignes = [];

        $statement =  $this->bdd->query($requete);

        var_dump($statement);

        while($ligne = $statement->fetch()){
            $lignes[] = $ligne;
        }

        return $lignes;
    }

    public function requetePrepare(string $requete, array $parametres): int{
        $statement = $this->bdd->prepare($requete);
        $statement->execute($parametres);

        return $statement->rowCount();
    }
}