<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Api\ApiParser;
use Infoball\classes\DataHandler\DataHandler;
use Infoball\classes\Database\DatabaseManager;

/**
 * Class PremierLeague
 *
 * Represents the PremierLeague page of the website.
 */
class PremierLeague extends Base
{
    protected ApiParser $apiParser;
    protected DatabaseManager $databaseManager;
    protected DataHandler $dataHandler;

    /**
     * Constructs a new PremierLeague object.
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiParser = new ApiParser();
        $this->databaseManager = new DatabaseManager();
        $this->dataHandler = new DataHandler($this->apiParser, $this->databaseManager);

        if (isset($_SESSION['userId'])) {

            $leagueData = $this->dataHandler->handleRetrievingLeaguesDataFromDb('Premier League', 'England');
            $standingData = $this->dataHandler->handleRetrievingStandingsDataFromDb(39, 2023);
            $topscorerData = $this->dataHandler->handleRetrievingPlayerstatsDataFromDb(39, 2023, 'topscorer');
            $topassistsData = $this->dataHandler->handleRetrievingPlayerstatsDataFromDb(39, 2023, 'topassists');
            $yellowcardsData = $this->dataHandler->handleRetrievingPlayerstatsDataFromDb(39, 2023, 'topyellowcards');
            $redcardsData = $this->dataHandler->handleRetrievingPlayerstatsDataFromDb(39, 2023, 'topredcards');
            $fixturesData = $this->dataHandler->handleRetrievingFixturesDataFromDb(39, 2023, 'allFixtures');

            echo $this->render('/classes/PremierLeague/PremierLeague.html.twig', [
                'leagueData' => $leagueData,
                'standingData' => $standingData,
                'topscorerData' => $topscorerData,
                'topassistsData' => $topassistsData,
                'yellowcardsData' => $yellowcardsData,
                'redcardsData' => $redcardsData,
                'fixturesData' => $fixturesData,
            ]);
        } else {
            header('Location: /pages/Login.php');
        }
    }
}

new PremierLeague();
