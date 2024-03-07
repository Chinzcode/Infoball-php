<?php

namespace Infoball\util\PHP\ErrorHandler;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\util\PHP\User\UserDatabaseQueries;
use PDO;

/**
 * Class ErrorHandler
 *
 * Handles error checks related to user input and authentication.
 */
class ErrorHandler
{
    /**
     * Checks if any of the input fields are empty.
     *
     * @param string $username The username input.
     * @param string $pwd The password input.
     * @param string $email The email input.
     * @return bool True if any input field is empty, false otherwise.
     */
    public function isInputEmpty(string $username, string $pwd, string $email): bool
    {
        return empty($username) || empty($pwd) || empty($email);
    }

    /**
     * Checks if the email is invalid.
     *
     * @param string $email The email input.
     * @return bool True if the email is invalid, false otherwise.
     */
    public function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if the username is already taken.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username input.
     * @return bool True if the username is already taken, false otherwise.
     */
    public function isUsernameTaken(PDO $pdo, string $username): bool
    {
        $result = UserDatabaseQueries::getUsername($pdo, $username);
        return !empty($result);
    }

    /**
     * Checks if the email is already registered.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $email The email input.
     * @return bool True if the email is already registered, false otherwise.
     */
    public function isEmailRegistered(PDO $pdo, string $email): bool
    {
        $result = UserDatabaseQueries::getEmail($pdo, $email);
        return !empty($result);
    }

    /**
     * Checks if the login input fields are empty.
     *
     * @param string $username The username input.
     * @param string $pwd The password input.
     * @return bool True if any login input field is empty, false otherwise.
     */
    public function isLoginInputEmpty(string $username, string $pwd): bool
    {
        return empty($username) || empty($pwd);
    }

    /**
     * Checks if the username or password is invalid.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username input.
     * @param string $pwd The password input.
     * @return bool True if the username or password is invalid, false otherwise.
     */
    public function isUserCredentialsInvalid(PDO $pdo, string $username, string $pwd): bool
    {
        $user = UserDatabaseQueries::getUser($pdo, $username);
        if (!$user) {
            return true;
        }
        $hashedPwd = $user->getPwd();
        return !password_verify($pwd, $hashedPwd);
    }
}
