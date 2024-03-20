<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Dotenv\Dotenv;
use Infoball\classes\Base\Base;
use Infoball\classes\Api\apiParser;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Api\StandingsApiClient;
use Infoball\classes\Database\DatabaseManager;
use Infoball\util\PHP\DataHandler\DataHandler;

/**
 * Class PremierLeague
 *
 * Represents the PremierLeague page of the website.
 */
class PremierLeague extends Base
{
    /**
     * Constructs a new PremierLeague object.
     */
    public function __construct()
    {
        parent::__construct();

        // Render the PremierLeague page.
        if (isset($_SESSION["userId"])) {
            echo $this->render("/classes/PremierLeague/PremierLeague.html.twig", [
                "data" => $this->getLeagueData(),
                "standingsData" => $this->getStandingData(),
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }

    private function getStandingData()
    {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        // Fetch API key and base URL from environment variables
        $apiKey = $_ENV['API_KEY'];
        $baseUrl = 'https://v3.football.api-sports.io/standings';

        $standingsApiClient = new StandingsApiClient($apiKey, $baseUrl);
        $apiParser = new apiParser();
        $databaseManager = new DatabaseManager();

        $dataHandler = new DataHandler($apiParser, $databaseManager);

        $league = 39;
        $season = 2023;

        // $dataHandler->handleStandingsDataFetchingAndStoring($standingsApiClient, $league, $season);
        $standingsData = $dataHandler->handleRetrievingStandingsDataFromDb($league, $season);

        return $standingsData;
    }

    private function getLeagueData()
    {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        // Fetch API key and base URL from environment variables
        $apiKey = $_ENV['API_KEY'];
        $baseUrl = 'https://v3.football.api-sports.io/leagues';

        $leaguesApiClient = new LeaguesApiClient($apiKey, $baseUrl);
        $apiParser = new apiParser();
        $databaseManager = new DatabaseManager();

        $dataHandler = new DataHandler($apiParser, $databaseManager);

        $name = 'Premier League';
        $country = 'England';
        // $dataHandler-> handleLeaguesDataFetchingAndStoring($name, $country);
        $leagueData = $dataHandler->handleRetrievingLeaguesDataFromDb($name, $country);

        return [
            'id' => $leagueData->getId(),
            'name' => $leagueData->getName(),
            'logo' => $leagueData->getLogo(),
            'country' => $leagueData->getCountry(),
            'seasons' => $leagueData->getSeasons(),
        ];
    }
}

new PremierLeague();
