<?php

declare(strict_types=1);

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

abstract class ConnectionBdd {
    private static ?PDO $instance = null;

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