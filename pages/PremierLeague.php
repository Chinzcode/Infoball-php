<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\util\PHP\League\LeagueParser;
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
        $apiKey = 'cd49181cf69486c1ac135da582e54070';
        $baseUrl = 'https://v3.football.api-sports.io/leagues';
        $leaguesApiClient = new LeaguesApiClient($apiKey, $baseUrl);
        $leagueParser = new LeagueParser();
        $databaseManager = new DatabaseManager();

        $dataHandler = new DataHandler($leaguesApiClient, $leagueParser, $databaseManager);

        $name = 'Premier League';
        $country = 'England';
        // $dataHandler-> handleDataFetchingAndStoring($name, $country);
        $leagueData = $dataHandler->handleRetrievingDataFromDb($name, $country);

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
