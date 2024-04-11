<?php

namespace Infoball\classes\SessionManager;

use Infoball\classes\User\User;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class SessionManager
 *
 * Manages the PHP session.
 */
class SessionManager
{
    /**
     * SessionManager constructor.
     * Initializes the SessionManager by setting ini settings, cookie parameters, starting the session, and checking/regenerating session based on user ID.
     */
    public function __construct()
    {
        $this->setIniSetting();
        $this->setCookieParams();
        $this->startSession();
        $this->checkAndRegenerateSessionBasedOnUserId();
    }

    /**
     * Sets the PHP ini settings for session configuration.
     *
     * @return void
     */
    public function setIniSetting(): void
    {
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_strict_mode', 1);
    }

    /**
     * Sets the cookie parameters for the session.
     *
     * @return void
     */
    public function setCookieParams(): void
    {
        session_set_cookie_params([
            'lifetime' => 1800,
            'domain' => 'localhost',
            'path' => '/',
            'secure' => true,
            'httponly' => true
        ]);
    }

    /**
     * Starts the session if it hasn't already been started.
     *
     * @return void
     */
    public function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Checks if the session user ID is set and regenerates the session if needed.
     *
     * @return void
     */
    public function checkAndRegenerateSessionBasedOnUserId(): void
    {
        if (isset($_SESSION["userId"])) {
            $this->checkAndRegenerateSessionIfExpired('regenerateSessionIdLoggedin');
        } else {
            $this->checkAndRegenerateSessionIfExpired('regenerateSessionId');
        }
    }

    /**
     * Checks if the session needs to be regenerated and calls the appropriate function.
     *
     * @param string $regenerateFunc Name of the function to call for session regeneration
     * @return void
     */
    public function checkAndRegenerateSessionIfExpired(string $regenerateFunc): void
    {
        if (!isset($_SESSION["lastRegeneration"])) {
            $this->$regenerateFunc();
        } else {
            $interval = 60 * 30; // 30 minutes
            if (time() - $_SESSION["lastRegeneration"] >= $interval) {
                $this->regenerateSessionIdIfLoggedIn();
            }
        }
    }

    /**
     * Regenerates the session ID if the user is logged in.
     *
     * @return void
     */
    public function regenerateSessionIdIfLoggedIn(): void
    {
        session_regenerate_id(true);
        $userId = $_SESSION["userId"];
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $userId;
        session_id($sessionId);
        $_SESSION["lastRegeneration"] = time();
    }

    /**
     * Regenerates the session ID.
     *
     * @return void
     */
    public function regenerateSessionId(): void
    {
        session_regenerate_id(true);
        $_SESSION["lastRegeneration"] = time();
    }

    /**
     * Sets the user information in the session upon successful login.
     *
     * @param User $user User object containing the user information to be stored in the session
     * @return void
     */
    public function setUser(User $user): void
    {
        $_SESSION["userId"] = $user->getId();
        $_SESSION["username"] = htmlspecialchars($user->getUsername());
        $_SESSION["lastRegeneration"] = time();
    }
}
