<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Api\ApiParser;
use Infoball\classes\Database\DatabaseManager;
use Infoball\classes\DataHandler\LeagueDataHandler;
use Infoball\classes\DataHandler\StandingDataHandler;
use Infoball\classes\DataHandler\TopscorerDataHandler;
use Infoball\util\PHP\EnvironmentVariableManager\EnvironmentVariableManager;

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
            $apiParser = new ApiParser();
            $databaseManager = new DatabaseManager();
            $apiKey = EnvironmentVariableManager::fetchApiKey();

            $leagueDataHandler = new LeagueDataHandler($apiParser, $databaseManager, $apiKey, 'https://v3.football.api-sports.io/leagues');
            $standingDataHandler = new StandingDataHandler($apiParser, $databaseManager, $apiKey, 'https://v3.football.api-sports.io/standings');
            $topscorerDataHandler = new TopscorerDataHandler($apiParser, $databaseManager, $apiKey, 'https://v3.football.api-sports.io/players/topscorers');

            $leagueData = $leagueDataHandler->getLeagueData('Premier League', 'England');
            $standingData = $standingDataHandler->getStandingData(39, 2023);
            $topscorerData = $topscorerDataHandler->getTopscorerData(39, 2023, 'topscorer');

            echo $this->render("/classes/PremierLeague/PremierLeague.html.twig", [
                "leagueData" => $leagueData,
                "standingData" => $standingData,
                "topscorerData" => $topscorerData,
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }
}

new PremierLeague();
