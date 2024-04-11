<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Login\LoginAction;
use Infoball\classes\ErrorHandler\ErrorHandler;

/**
 * Class Login
 *
 * Represents the page for user login.
 */
class Login extends Base
{
    /**
     * Constructs a new Login object.
     */
    public function __construct()
    {
        parent::__construct();

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginAction = new LoginAction(new ErrorHandler(), $this->sessionManager);
            $errors = $loginAction->validateInput();
            if (empty($errors)) {
                $loginAction->handleLogin();
            }
        }

        // Render the login page.
        echo $this->render("/classes/Login/Login.html.twig", [
            "page" => "Log in",
            "errors" => $errors,
        ]);

        $errors = [];
    }
}

new Login();
