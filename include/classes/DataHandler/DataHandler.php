<?php

namespace Infoball\classes\DataHandler;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Api\StandingsApiClient;
use Infoball\classes\Api\TopscorerApiClient;
use Infoball\classes\Database\DatabaseManager;
use Infoball\classes\Entity\League\League;
use Infoball\classes\Entity\Standing\Standing;
use Infoball\classes\Entity\Topscorer\Topscorer;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class DataHandler
{
    protected ApiParser $parser;
    protected DatabaseManager $databaseManager;

    public function __construct(ApiParser $parser, DatabaseManager $databaseManager)
    {
        $this->parser = $parser;
        $this->databaseManager = $databaseManager;
    }

    public function handleTopscorerDataFetchingAndStoring(TopscorerApiClient $topscorerApiClient, int $league, int $season, string $name)
    {
        $apiClient = $topscorerApiClient;
        $apiResponse = $apiClient->fetchTopscorerData($league, $season);
        $parsedTopscorer = $this->parser->parseTopscorerApiResponse($apiResponse);
        $this->databaseManager->deleteTopscorerData($league, $season, $name);

        foreach ($parsedTopscorer as $data) {
            $topscorer = new Topscorer(
                $data['playerId'],
                $data['name'],
                $data['firstname'],
                $data['lastname'],
                $data['photo'],
                $data['teamName'],
                $data['teamLogo'],
                $data['goals'],
                $data['penaltyGoals'],
            );

            $this->databaseManager->insertTopscorerData($topscorer, $league, $season, $name);
        }
    }

    public function handleRetrievingTopscorerDataFromDb(int $league, int $season, string $tableName)
    {
        return $this->databaseManager->getTopscorer($league, $season, $tableName);
    }

    public function handleStandingsDataFetchingAndStoring(StandingsApiClient $standingsApiClient, int $league, int $season)
    {
        $apiClient = $standingsApiClient;

        $apiResponse = $apiClient->fetchStandingData($league, $season);

        $parsedStandings = $this->parser->parseStandingsApiResponse($apiResponse);

        $this->databaseManager->deleteStanding($league, $season);

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
