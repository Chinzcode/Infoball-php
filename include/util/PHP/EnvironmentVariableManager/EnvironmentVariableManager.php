<?php

namespace Infoball\util\PHP\EnvironmentVariableManager;

use Dotenv\Dotenv;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class EnvironmentVariableManager
{
    public static function fetchApiKey()
    {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();

        // Fetch API key and base URL from environment variables
        $apiKey = $_ENV['API_KEY'];
        return $apiKey;
    }
}
