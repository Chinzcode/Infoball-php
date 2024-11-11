<?php

namespace Infoball\classes\DataHandler;

use Infoball\classes\Api\ApiParser;
use Infoball\classes\Api\LeaguesApiClient;
use Infoball\classes\Entity\League\League;
use Infoball\classes\Api\FixturesApiClient;
use Infoball\classes\Entity\Fixture\Fixture;
use Infoball\classes\Database\DatabaseManager;
use Infoball\classes\Entity\Standing\Standing;
use Infoball\classes\Api\StandardParamApiClient;
use Infoball\classes\Entity\Playerstats\Playerstats;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

class DataHandler
{
    protected ApiParser $parser;
    protected DatabaseManager $databaseManager;

    public function __construct(ApiParser $parser, DatabaseManager $databaseManager)
    {
        $this->parser = $parser;
        $this->databaseManager = $databaseManager;
    }

    public function handleFixturesDataFetchingAndStoring(FixturesApiClient $fixturesApiClient, int $league, int $season, string $name, string $startDate, string $endDate)
    {
        $apiClient = $fixturesApiClient;
        $apiResponse = $apiClient->fetchApiData($league, $season, $startDate, $endDate);
        $parsedFixtures = $this->parser->parseFixturesApiResponse($apiResponse);
        $this->databaseManager->deleteFixturesData($league, $season, $name);

        foreach ($parsedFixtures as $data) {
            $fixture = new Fixture(
                $data['fixtureId'],
                $data['leagueId'],
                $data['leagueName'],
                $data['leagueCountry'],
                $data['leagueLogo'],
                $data['leagueRound'],
                $data['homeTeamId'],
                $data['homeTeamName'],
                $data['homeTeamLogo'],
                $data['awayTeamId'],
                $data['awayTeamName'],
                $data['awayTeamLogo'],
                $data['referee'],
                $data['timezone'],
                $data['fixtureDate'],
                $data['fixtureTimestamp'],
                $data['venueId'],
                $data['venueName'],
                $data['venueCity'],
                $data['statusLong'],
                $data['statusShort'],
                $data['statusElapsed'],
                $data['goalsHome'],
                $data['goalsAway'],
                $data['scoreHalftimeHome'],
                $data['scoreHalftimeAway'],
                $data['scoreFulltimeHome'],
                $data['scoreFulltimeAway'],
                $data['scoreExtratimeHome'],
                $data['scoreExtratimeAway'],
                $data['scorePenaltyHome'],
                $data['scorePenaltyAway']
            );

            $this->databaseManager->insertFixturesData($fixture, $league, $season, $name);
        }
    }

    public function handleRetrievingFixturesDataFromDb(int $league, int $season, string $tableName)
    {
        return $this->databaseManager->getFixtures($league, $season, $tableName);
    }

    public function handlePlayerstatsDataFetchingAndStoring(StandardParamApiClient $standardParamApiClient, int $league, int $season, string $name)
    {
        $apiClient = $standardParamApiClient;
        $apiResponse = $apiClient->fetchApiData($league, $season);
        $parsedPlayerstats = $this->parser->parsePlayerstatsApiResponse($apiResponse);
        $this->databaseManager->deletePlayerstatsData($league, $season, $name);

        foreach ($parsedPlayerstats as $data) {
            $assists = isset($data['assists']) ? $data['assists'] : 0;
            $playerstats = new Playerstats(
                $data['playerId'],
                $data['name'],
                $data['firstname'],
                $data['lastname'],
                $data['photo'],
                $data['teamName'],
                $data['teamLogo'],
                $data['goals'],
                $data['penaltyGoals'],
                $assists,
                $data['yellowCard'],
                $data['redCard']
            );

            $this->databaseManager->insertPlayerstatsData($playerstats, $league, $season, $name);
        }
    }

    public function handleRetrievingPlayerstatsDataFromDb(int $league, int $season, string $tableName)
    {
        return $this->databaseManager->getPlayerstats($league, $season, $tableName);
    }

    public function handleStandingsDataFetchingAndStoring(StandardParamApiClient $standardParamApiClient, int $league, int $season)
    {
        $apiClient = $standardParamApiClient;
        $apiResponse = $apiClient->fetchApiData($league, $season);
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
