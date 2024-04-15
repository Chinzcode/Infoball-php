<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class ApiParser
{
    public function parsePlayerstatsApiResponse(array $apiResponse): array
    {
        $playerstatsData = [];

        foreach($apiResponse as $data) {
            if (isset($data['player'])) {
                $player = $data['player'];
                $statistics = reset($data['statistics']);

                $playerstatsData[] = [
                    'playerId' => $player['id'],
                    'name' => $player['name'],
                    'firstname' => $player['firstname'],
                    'lastname' => $player['lastname'],
                    'photo' => $player['photo'],
                    'teamName' => $statistics['team']['name'],
                    'teamLogo' => $statistics['team']['logo'],
                    'goals' => $statistics['goals']['total'],
                    'penaltyGoals' => $statistics['penalty']['scored'],
                    'assists' => $statistics['goals']['assists'],
                    'yellowCard' => $statistics['cards']['yellow'],
                    'redCard' => $statistics['cards']['red'],
                ];
            }
        }

        return $playerstatsData;
    }

    public function parseStandingsApiResponse(array $apiResponse): array
    {
        $parsedStandings = [];
        $leagueData = reset($apiResponse)['league'];

        foreach ($leagueData['standings'] as $standings) {
            foreach ($standings as $standing) {
                $parsedStandings[] = [
                    'rank' => $standing['rank'],
                    'teamId' => $standing['team']['id'],
                    'name' => $standing['team']['name'],
                    'logo' => $standing['team']['logo'],
                    'points' => $standing['points'],
                    'goalsDiff' => $standing['goalsDiff'],
                    'form' => $standing['form'],
                    'played' => $standing['all']['played'],
                    'win' => $standing['all']['win'],
                    'draw' => $standing['all']['draw'],
                    'lose' => $standing['all']['lose'],
                    'goalsFor' => $standing['all']['goals']['for'],
                    'goalsAgainst' => $standing['all']['goals']['against']
                ];
            }
        }

        return $parsedStandings;
    }

    public function parseLeagueApiResponse(array $apiResponse): array
    {
        // Extract the relevant data from the API response
        $leagueData = reset($apiResponse)['league'];
        $countryData = reset($apiResponse)['country'];
        $leagueSeasons = reset($apiResponse)['seasons'];

        $leagueId = $leagueData['id'];
        $leagueName = $leagueData['name'];
        $leagueLogo = $leagueData['logo'];
        $countryName = $countryData['name'];

        $leagueSeasonsYear = [];

        foreach ($leagueSeasons as $season) {
            $leagueSeasonsYear[] = $season['year'];
        }

        // Return the parsed data
        return [
            'id' => $leagueId,
            'name' => $leagueName,
            'logo' => $leagueLogo,
            'country' => $countryName,
            'seasons' => $leagueSeasonsYear,
        ];
    }
}
