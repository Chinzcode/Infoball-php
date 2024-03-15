<?php

namespace Infoball\util\PHP\DataHandler;

use Infoball\util\PHP\League\League;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\util\PHP\League\LeagueParser;
use Infoball\classes\Database\DatabaseManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class DataHandler
{
    protected LeaguesApiClient $apiClient;
    protected LeagueParser $parser;
    protected DatabaseManager $databaseManager;

    public function __construct(LeaguesApiClient $apiClient, LeagueParser $parser, DatabaseManager $databaseManager)
    {
        $this->apiClient = $apiClient;
        $this->parser = $parser;
        $this->databaseManager = $databaseManager;
    }

    public function handleDataFetchingAndStoring(string $name, string $country)
    {
        $apiResponse = $this->apiClient->fetchLeagueData($name, $country);

        $parsedData = $this->parser->parseApiResponse($apiResponse);

        $league = new League($parsedData['id'], $parsedData['name'], $parsedData['logo'], $parsedData['country'], $parsedData['seasons']);

        $this->databaseManager->insertLeague($league);
    }

    public function handleRetrievingDataFromDb(string $name, string $country)
    {
        $dbReponse = $this->databaseManager->getLeague($name, $country);

        $league = new League($dbReponse['id'], $dbReponse['name'], $dbReponse['logo'], $dbReponse['country'], $dbReponse['seasons']);

        return $league;
    }
}
