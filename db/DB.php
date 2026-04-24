<?php

class DB
{
    public static ?PDO $pdo = null;

    public static function connect(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $db   = getenv('DB_NAME') ?: '';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            return self::$pdo;
        } catch (PDOException $e) {
            die("Savienojums neizdevās: " . $e->getMessage());
        }
    }

    public static function query(string $sqlQuery): PDOStatement
    {
        if (self::$pdo === null) {
            self::connect();
        }
        return self::$pdo->query($sqlQuery);
    }
}