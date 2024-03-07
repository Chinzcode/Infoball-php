<?php

namespace Infoball\util\Twig;

use Exception;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigEngine
{
    protected static $instance = null;
    private FilesystemLoader $loader;
    private Environment $environment;
    private array $addedGlobalFunctions;
    private array $addedGlobalFilters;

    /**
     * Reset any instance and static properties on this object.
     */
    public static function resetClass()
    {
        self::$instance = null;
    }

    public function __construct(Environment $twig)
    {
        $this->environment = $twig;
    }

    /**
     * Must return an instance of the template engine
     *
     * @return TwigEngine
     * @see TwigEngine::getInstance()
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            $loader = self::getDefaultTwigLoader();
            $twig = new Environment($loader, ["debug" => true]);
            $twig->addExtension(new DebugExtension());

            self::$instance = new self($twig);
        }

        return self::$instance;
    }

    /**
     * Renders the twig template with the specified name
     *
     * @param string $name
     * @param array $context
     * @return string
     */
    public function render(string $name, array $context = array())
    {
        return $this->environment->render($name, $context);
    }

    /**
     * Returns the twig environment instance in the engine.
     *
     * @return Twig\Environment
     */
    public function getTwigEnvironment(): Environment
    {
        return $this->environment;
    }

    /**
     * Returns the configured twig loader
     *
     * @return LoaderInterface
     */
    public function getTwigLoader(): LoaderInterface
    {
        return $this->loader;
    }

    /**
     * Adds a function to the global Twig function context, making it available to all Twig templates.
     *
     * @param string $name The name of the function.
     * @param callable $function The function to add.
     */
    public function addGlobalFunction(string $name, callable $function): TwigEngine
    {
        // If current function/filter already added, just return
        // without as twig will print error message if funtions already added
        if (in_array($name, $this->addedGlobalFunctions)) {
            throw new Exception(
                sprintf('A global twig function named %s already exists, not adding the function', $name)
            );
        }

        $environment = $this->getTwigEnvironment();
        if ($environment instanceof Environment) {
            $environment->addFunction(new TwigFunction($name, $function));
        } else {
            throw new Exception("Could not find the Twig_Environment class");
        }

        $this->addedGlobalFunctions[] = $name;
        return $this;
    }

    /**
     * Adds a function to the global Twig filter context, making it available to all Twig templates.
     *
     * @param string $name The name of the filter function.
     * @param callable $filter The filter function to add.
     */
    public function addGlobalFilter(string $name, callable $filter): TwigEngine
    {
        if (in_array($name, $this->addedGlobalFilters)) {
            throw new Exception(
                sprintf('A global twig filter named %s already exists, not adding the filter', $name)
            );
        }

        $environment = $this->getTwigEnvironment();
        if ($environment instanceof Environment) {
            $environment->addFilter(new TwigFilter($name, $filter));
        } else {
            throw new Exception("Could not find the Twig_Environment class");
        }

        $this->addedGlobalFilters[] = $name;
        return $this;
    }

    /**
     * Adds a variable to the global Twig context, making it available to all Twig templates.
     *
     * If a global variable with given name already exists it will get overrided.
     *
     * @param string $name The name of the global variable.
     * @param mixed|string $value The global value to add.
     * @return TwigEngine
     */
    public function addGlobalVariable(string $name, $value): TwigEngine
    {
        // No need for checking if global variable added as twig will
        // just override any existing globals with new value, and it is okey.
        $environment = $this->getTwigEnvironment();
        if ($environment instanceof Environment) {
            $environment->addGlobal($name, $value);
        } else {
            throw new Exception("Could not find the Twig_Environment class");
        }
        return $this;
    }

    /**
     * Returns the twig file loader.
     *
     * @return FilesystemLoader
     */
    protected static function getDefaultTwigLoader(): FilesystemLoader
    {
        return new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . "/include");
    }
}
