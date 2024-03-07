<?php

namespace Infoball\classes\Signup;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\util\PHP\User\User;
use Infoball\classes\Database\Database;

/**
 * Class SignupManager
 *
 * Manages user signup operations.
 */
class SignupManager
{
    /**
     * @var SignupManager|null The singleton instance of SignupManager.
     */
    protected static $instance = null;

    /**
     * Get the singleton instance of SignupManager.
     *
     * @return SignupManager The SignupManager instance.
     */
    public static function getInstance(): SignupManager
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Create a new user with the provided username, password, and email.
     *
     * @param string $username The username of the new user.
     * @param string $pwd The password of the new user.
     * @param string $email The email of the new user.
     * @return User The created User object.
     */
    public function createUser(string $username, string $pwd, string $email): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPwd($pwd);
        $user->setEmail($email);
        $this->saveUserToDb($user);
        return $user;
    }

    /**
     * Save the user to the database.
     *
     * @param User $user The User object to be saved.
     * @return void
     */
    private function saveUserToDb(User $user): void
    {
        $db = Database::getDb();
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
        $stmt = $db->prepare($query);

        $options = [
            "cost" => 12
        ];

        $hashedPwd = password_hash($user->getPwd(), PASSWORD_BCRYPT, $options);

        $stmt->bindValue(":username", $user->getUsername());
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindValue(":email", $user->getEmail());
        $stmt->execute();
    }
}
