<?php

namespace Infoball\classes\LogoutHandler;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class LogoutHandler
 *
 * Handles user logout functionality.
 */
class LogoutHandler
{
    /**
     * Constructs a new LogoutHandler object.
     */
    public function __construct()
    {
        $this->handleLogout();
    }

    /**
     * Handles the user logout process.
     *
     * Unsets and destroys the session, then redirects the user to the login page.
     *
     * @return void
     */
    public function handleLogout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header("location: /Infoball/pages/Login.php");
        die();
    }
}

new LogoutHandler();
