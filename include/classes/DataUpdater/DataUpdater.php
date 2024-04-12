<?php

namespace Infoball\classes\DataUpdater;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Api\StandardParamApiClient;
use Infoball\classes\DataHandler\DataHandler;
use Infoball\classes\Database\DatabaseManager;
use Infoball\util\PHP\EnvironmentVariableManager\EnvironmentVariableManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class DataUpdater
{
    protected string $url;
    protected string $apiKey;
    protected StandardParamApiClient $standardParamApiClient;
    protected ApiParser $apiParser;
    protected DatabaseManager $databaseManager;
    protected DataHandler $dataHandler;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->apiKey = EnvironmentVariableManager::fetchApiKey();
        $this->standardParamApiClient = new StandardParamApiClient($this->apiKey, $this->url);
        $this->apiParser = new ApiParser();
        $this->databaseManager = new DatabaseManager();
        $this->dataHandler = new DataHandler($this->apiParser, $this->databaseManager);
    }

    public function updateStandingsData(int $league, int $season) //league = 39, season = 2023
    {
        $this->dataHandler->handleStandingsDataFetchingAndStoring($this->standardParamApiClient, $league, $season);
    }

    public function updateTopscorerData(int $league, int $season, string $name) //league = 39, season = 2023, name = topscorer
    {
        $this->dataHandler->handleTopscorerDataFetchingAndStoring($this->standardParamApiClient, $league, $season, $name);
    }
}

// $updateData = new DataUpdater('https://v3.football.api-sports.io/standings');
// $updateData->updateStandingsData(39, 2023);

// $updateData = new DataUpdater('https://v3.football.api-sports.io/players/topscorers');
// $updateData->updateTopscorerData(39, 2023, 'topscorer');
