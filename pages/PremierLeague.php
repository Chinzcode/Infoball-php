<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Api\apiParser;
use Infoball\util\PHP\DataHandler\DataHandler;
use Infoball\classes\Database\DatabaseManager;

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
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }

    private function getLeagueData()
    {
        // Fetch API key and base URL from environment variables
        $apiKey = getenv('API_KEY');
        $baseUrl = getenv('BASE_URL');

        $leaguesApiClient = new LeaguesApiClient($apiKey, $baseUrl);
        $apiParser = new apiParser();
        $databaseManager = new DatabaseManager();

        $dataHandler = new DataHandler($leaguesApiClient, $apiParser, $databaseManager);

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
