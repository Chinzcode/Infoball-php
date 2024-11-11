<?php

namespace Infoball\classes\DataUpdater;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Api\FixturesApiClient;
use Infoball\classes\DataHandler\DataHandler;
use Infoball\classes\Database\DatabaseManager;
use Infoball\classes\Api\StandardParamApiClient;
use Infoball\util\PHP\EnvironmentVariableManager\EnvironmentVariableManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

class DataUpdater
{
    protected string $url;
    protected string $apiKey;
    protected StandardParamApiClient $standardParamApiClient;
    protected FixturesApiCLient $fixturesApiClient;
    protected ApiParser $apiParser;
    protected DatabaseManager $databaseManager;
    protected DataHandler $dataHandler;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->apiKey = EnvironmentVariableManager::fetchApiKey();
        $this->apiParser = new ApiParser();
        $this->databaseManager = new DatabaseManager();
        $this->dataHandler = new DataHandler($this->apiParser, $this->databaseManager);
    }

    public function updateStandingsData(int $league, int $season) //league = 39, season = 2023
    {
        $this->standardParamApiClient = new StandardParamApiClient($this->apiKey, $this->url);
        $this->dataHandler->handleStandingsDataFetchingAndStoring($this->standardParamApiClient, $league, $season);
    }

    public function updatePlayerstatsData(int $league, int $season, string $name) //league = 39, season = 2023, name = topscorer or topassists etc.
    {
        $this->standardParamApiClient = new StandardParamApiClient($this->apiKey, $this->url);
        $this->dataHandler->handlePlayerstatsDataFetchingAndStoring($this->standardParamApiClient, $league, $season, $name);
    }

    public function updateFixturesData(int $league, int $season, string $name, string $startDate, string $endDate)
    {
        $this->fixturesApiClient = new FixturesApiClient($this->apiKey, $this->url);
        $this->dataHandler->handleFixturesDataFetchingAndStoring($this->fixturesApiClient, $league, $season, $name, $startDate, $endDate);
    }
}
