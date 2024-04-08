<?php

namespace Infoball\util\PHP\DataHandler;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Database\DatabaseManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class StandingDataHandler
{
    protected ApiParser $parser;
    protected DatabaseManager $databaseManager;
    protected string $apiKey;
    protected string $url;

    public function __construct(ApiParser $parser, DatabaseManager $databaseManager, string $apiKey, string $url)
    {
        $this->parser = $parser;
        $this->databaseManager = $databaseManager;
        $this->apiKey = $apiKey;
        $this->url = $url;
    }

    public function getStandingData(int $league, int $season): array
    {
        $dataHandler = new DataHandler($this->parser, $this->databaseManager);
        $standingsData = $dataHandler->handleRetrievingStandingsDataFromDb($league, $season);

        return $standingsData;
    }
}
