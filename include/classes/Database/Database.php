<?php

namespace Infoball\classes\Database;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

use PDO;
use PDOException;

/**
 * Class Database
 *
 * Represents a database connection.
 */
class Database
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "Infoball";
    private const DB_USERNAME = "root";
    private const DB_PASSWORD = "123";

    /**
     * Get a PDO database connection.
     *
     * @return PDO The PDO database connection object.
     */
    public static function getDb(): PDO
    {
        try {
            $pdo = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed:" . $e->getMessage());
        }
    }
}
