<?php

namespace Infoball\util\PHP\EnvironmentVariableManager;

use Dotenv\Dotenv;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

class EnvironmentVariableManager
{
    public static function fetchApiKey()
    {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Infoball');
        $dotenv->load();

        // Fetch API key and base URL from environment variables
        $apiKey = $_ENV['API_KEY'];
        return $apiKey;
    }

    public static function fetchDbVariables(): array {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/Infoball');
        $dotenv->load();

        return [
            'DB_HOST' => $_ENV['DB_HOST'],
            'DB_NAME' => $_ENV['DB_NAME'],
            'DB_USERNAME' => $_ENV['DB_USERNAME'],
            'DB_PASSWORD' => $_ENV['DB_PASSWORD']
        ];
    }
}
