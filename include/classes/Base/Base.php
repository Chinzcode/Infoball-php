<?php

namespace Infoball\classes\Base;

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Infoball\util\Twig\TwigEngine;

class Base
{
    private $twig;

    public function __construct()
    {
        $this->twig = TwigEngine::getInstance();
    }
    public function render(string $name, array $context = array())
    {
        return $this->twig->render($name, $context);
    }
}
