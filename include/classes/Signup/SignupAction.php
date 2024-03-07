<?php

namespace Infoball\classes\Signup;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use PDOException;
use Infoball\classes\Database\Database;
use Infoball\classes\Signup\SignupManager;
use Infoball\util\PHP\ErrorHandler\ErrorHandler;
use Infoball\util\PHP\SessionManager\SessionManager;
use Exception;

/**
 * Class SignupAction
 *
 * Represents the action taken during user signup.
 */
class SignupAction
{
    /**
     * @var ErrorHandler The error handler instance.
     */
    protected ErrorHandler $errorHandler;

    /**
     * @var SessionManager The session manager instance.
     */
    protected SessionManager $sessionManager;

    /**
     * @var string The username provided during signup.
     */
    protected string $username;

    /**
     * @var string The password provided during signup.
     */
    protected string $pwd;

    /**
     * @var string The email provided during signup.
     */
    protected string $email;

    /**
     * Constructs a new SignupAction object.
     *
     * @param ErrorHandler $errorHandler The error handler instance.
     * @param SessionManager $sessionManager The session manager instance.
     */
    public function __construct(ErrorHandler $errorHandler, SessionManager $sessionManager)
    {
        $this->errorHandler = $errorHandler;
        $this->sessionManager = $sessionManager;
        $this->username = $_POST["username"];
        $this->pwd = $_POST["pwd"];
        $this->email = $_POST["email"];
    }

    /**
     * Handles the user signup process.
     *
     * @return void
     */
    public function handleSignup(): void
    {
        $errors = [];

        try {
            $errors = $this->validateInput();

            if (empty($errors)) {
                $loginManager = SignupManager::getInstance();
                $loginManager->createUser($this->username, $this->pwd, $this->email);
                header("location: /pages/Login.php?signup=success");
                exit;
            } else {
                header("location: /pages/Signup.php?signup=error");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage());
            header("Location: /pages/Signup.php");
            exit;
        } catch (Exception $e) {
            error_log("Unexpected error: " . $e->getMessage());
            header("Location: /pages/error.php");
            exit;
        }
    }

    /**
     * Validates the user input during signup.
     *
     * @return array An array of validation errors, if any.
     */
    public function validateInput(): array
    {
        $errors = [];
        $db = Database::getDb();

        if ($this->errorHandler->isInputEmpty($this->username, $this->pwd, $this->email)) {
            $errors["emptyInput"] = "Please fill in all required fields.";
        }
        if ($this->errorHandler->isEmailInvalid($this->email)) {
            $errors["invalidEmail"] = "Invalid email used.";
        }
        if ($this->errorHandler->isUsernameTaken($db, $this->username)) {
            $errors["usernameTaken"] = "Username already taken.";
        }
        if ($this->errorHandler->isEmailRegistered($db, $this->email)) {
            $errors["emailUsed"] = "Email already registered.";
        }

        return $errors;
    }
}
