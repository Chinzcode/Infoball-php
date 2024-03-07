<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Signup\SignupAction;
use Infoball\util\PHP\ErrorHandler\ErrorHandler;

/**
 * Class Signup
 *
 * Represents the page for user signup.
 */
class Signup extends Base
{
    /**
     * Constructs a new Signup object.
     */
    public function __construct()
    {
        parent::__construct();

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $signupAction = new SignupAction(new ErrorHandler(), $this->sessionManager);
            $errors = $signupAction->validateInput();
            if (empty($errors)) {
                $signupAction->handleSignup();
            }
        }

        // Render the signup page.
        echo $this->render("/classes/Signup/Signup.html.twig", [
            "page" => "Sign up",
            "errors" => $errors,
        ]);

        $errors = [];
    }
}

new Signup();
