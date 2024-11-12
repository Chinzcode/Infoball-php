<?php

namespace Infoball\classes\Login;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

use Exception;
use PDOException;
use Infoball\classes\Database\Database;
use Infoball\classes\User\UserDatabaseQueries;
use Infoball\classes\ErrorHandler\ErrorHandler;
use Infoball\classes\SessionManager\SessionManager;

/**
 * Class LoginAction
 *
 * Represents the action taken during user login.
 */
class LoginAction
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
     * @var string The username provided during login.
     */
    protected string $username;

    /**
     * @var string The password provided during login.
     */
    protected string $pwd;

    /**
     * Constructs a new LoginAction object.
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
    }

    /**
     * Handles the user login process.
     *
     * @return void
     */
    public function handleLogin(): void
    {
        $errors = [];

        try {
            $errors = $this->validateInput();

            if (empty($errors)) {
                $db = Database::getDb();
                $user = UserDatabaseQueries::getUser($db, $this->username);

                if ($user) {
                    $this->sessionManager->setUser($user);

                    header("Location: /Infoball/pages/Home.php?login=success");
                    exit;
                } else {
                    $errors["loginIncorrect"] = "Incorrect login info!";
                    $_SESSION["errorsLogin"] = $errors;
                    header("location: /Infoball/pages/Login.php?login=error");
                    exit;
                }
            } else {
                $_SESSION["errorsLogin"] = $errors;
                header("location: /Infoball/pages/Login.php?login=error");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage());
            header("Location: /Infoball/pages/Login.php");
            exit;
        } catch (Exception $e) {
            error_log("Unexpected error: " . $e->getMessage());
            header("Location: /Infoball/pages/error.php");
            exit;
        }
    }

    /**
     * Validates the user input during login.
     *
     * @return array An array of validation errors, if any.
     */
    public function validateInput(): array
    {
        $errors = [];
        $db = Database::getDb();

        if ($this->errorHandler->isLoginInputEmpty($this->username, $this->pwd)) {
            $errors["emptyInput"] = "Please fill in all required fields.";
        }
        if ($this->errorHandler->isUserCredentialsInvalid($db, $this->username, $this->pwd)) {
            $errors["invalidCredentials"] = "Invalid username or password.";
        }

        return $errors;
    }
}
