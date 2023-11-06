<?php

declare(strict_types=1);

/**
 * Charge les variables d'environnement d'un fichier ".env".
 * @param string $path chemin du fichier .env
 * @return void
 */
function chargerDotenv($path)
{
    $lignes = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lignes as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

/**
 * Classe utilitaire pour se connecter à la base de données.
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
abstract class ConnectionBdd {
    private static ?PDO $instance = null;

    /**
     * Renvoie une connection de base de données avec 
     * les paramètres fournis dans le ".env".
     * La classe utilisant un singleton, plusieurs appels successifs ne créeront qu'un seul objet PDO.
     * @return PDO
     */
    public static function getInstance(): PDO{
        if (self::$instance === null) {
            self::$instance = self::connecterBdd();
        }

        return self::$instance;
    }

    private static function connecterBdd(): PDO{
        chargerDotenv('.env');

        $type = getenv('DB_TYPE');
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASS');
        $db_name = getenv('DB_NAME');
        $charset = "utf8";

        return new PDO("$type:host=$host;port=$port;dbname=$db_name;charset=$charset", $user, $password);
    }
}