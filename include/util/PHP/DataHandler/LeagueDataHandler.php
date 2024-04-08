<?php

namespace Infoball\util\PHP\DataHandler;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Database\DatabaseManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class LeagueDataHandler
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

    public function getLeagueData(string $name, string $country): array
    {
        $dataHandler = new DataHandler($this->parser, $this->databaseManager);
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
