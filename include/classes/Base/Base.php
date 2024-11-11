<?php

namespace Infoball\classes\Base;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/vendor/autoload.php';

use Infoball\util\Twig\TwigEngine;
use Infoball\classes\SessionManager\SessionManager;

/**
 * Class Base
 *
 * Base class for other classes in the Alcompare application.
 */
class Base
{
    /**
     * @var TwigEngine Instance of the TwigEngine for rendering templates.
     */
    private $twig;

    /**
     * @var SessionManager Instance of the SessionManager for managing sessions.
     */
    protected $sessionManager;

    /**
     * Constructs a new Base object.
     */
    public function __construct()
    {
        $this->twig = TwigEngine::getInstance();
        $this->sessionManager = new SessionManager();

        $userId = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null;
        $username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

        $this->twig->addGlobalVariable("isUserLoggedIn", $userId);
        $this->twig->addGlobalVariable("username", $username);
    }

    /**
     * Renders the twig template with the specified name.
     *
     * @param  string $name The name of the template to render.
     * @param  array $context Optional. The context data to pass to the template.
     * @return string The rendered template content.
     */
    public function render(string $name, array $context = array()): string
    {
        return $this->twig->render($name, $context);
    }
}
