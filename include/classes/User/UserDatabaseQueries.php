<?php

namespace Infoball\classes\User;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

use PDO;
use Infoball\classes\User\User;

/**
 * Class UserDatabaseQueries
 *
 * Provides database queries related to user operations.
 */
class UserDatabaseQueries
{
    /**
     * Retrieves a username from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username to retrieve.
     * @return array|false The fetched username data as an associative array, or false if no username found.
     */
    public static function getUsername(PDO $pdo, string $username): array|false
    {
        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieves an email from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $email The email to retrieve.
     * @return array|false The fetched email data as an associative array, or false if no email found.
     */
    public static function getEmail(PDO $pdo, string $email): array|false
    {
        $query = "SELECT username FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieves a user from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username of the user to retrieve.
     * @return User|null The fetched user object, or null if no user found.
     */
    public static function getUser(PDO $pdo, string $username): ?User
    {
        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = new User();
            $user->setId($result['id']);
            $user->setUsername($result['username']);
            $user->setPwd($result['pwd']);
            $user->setEmail($result['email']);
            return $user;
        } else {
            return null;
        }
    }
}
