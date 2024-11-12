<?php

namespace Infoball\classes\Database;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

use Infoball\util\PHP\EnvironmentVariableManager\EnvironmentVariableManager;
use PDO;
use PDOException;

/**
 * Class Database
 *
 * Represents a database connection.
 */
class Database {
    /**
     * Get a PDO database connection.
     *
     * @return PDO The PDO database connection object.
     */
    public static function getDb(): PDO {
        $data = EnvironmentVariableManager::fetchDbVariables();
        try {
            $pdo = new PDO(
                "mysql:host=" . $data['DB_HOST'] . ";dbname=" . $data['DB_NAME'],
                $data['DB_USERNAME'],
                $data['DB_PASSWORD']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed:" . $e->getMessage());
        }
    }
}
