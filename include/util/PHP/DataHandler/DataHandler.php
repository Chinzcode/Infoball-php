<?php

namespace Infoball\util\PHP\DataHandler;

use Infoball\classes\Api\apiParser;
use Infoball\util\PHP\League\League;
use Infoball\util\PHP\Standing\Standing;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Api\StandingsApiClient;
use Infoball\classes\Database\DatabaseManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class DataHandler
{
    protected apiParser $parser;
    protected DatabaseManager $databaseManager;

    public function __construct(apiParser $parser, DatabaseManager $databaseManager)
    {
        $this->parser = $parser;
        $this->databaseManager = $databaseManager;
    }

    public function handleStandingsDataFetchingAndStoring(StandingsApiClient $standingsApiClient, int $league, int $season)
    {
        $apiClient = $standingsApiClient;

        $apiResponse = $apiClient->fetchLeagueData($league, $season);

        $parsedStandings = $this->parser->parseStandingsApiResponse($apiResponse);

        foreach ($parsedStandings as $data) {
            $standing = new Standing(
                $data['rank'],
                $data['teamId'],
                $data['name'],
                $data['logo'],
                $data['points'],
                $data['goalsDiff'],
                $data['form'],
                $data['played'],
                $data['win'],
                $data['draw'],
                $data['lose'],
                $data['goalsFor'],
                $data['goalsAgainst']
            );

            $this->databaseManager->insertStanding($standing, $league, $season);
        }
    }

    public function handleRetrievingStandingsDataFromDb(int $league, int $season)
    {
        return $this->databaseManager->getStanding($league, $season);
    }

    public function handleLeaguesDataFetchingAndStoring(LeaguesApiClient $leaguesApiClient, string $name, string $country)
    {
        $apiClient = $leaguesApiClient;

        $apiResponse = $apiClient->fetchLeagueData($name, $country);

        $parsedData = $this->parser->parseLeagueApiResponse($apiResponse);

        $league = new League($parsedData['id'], $parsedData['name'], $parsedData['logo'], $parsedData['country'], $parsedData['seasons']);

        $this->databaseManager->insertLeague($league);
    }

    public function handleRetrievingLeaguesDataFromDb(string $name, string $country)
    {
        $dbReponse = $this->databaseManager->getLeague($name, $country);

        $league = new League($dbReponse['id'], $dbReponse['name'], $dbReponse['logo'], $dbReponse['country'], $dbReponse['seasons']);

        return $league;
    }
}
