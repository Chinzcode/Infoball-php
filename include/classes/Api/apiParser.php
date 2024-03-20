<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class apiParser
{
    public function parseStandingsApiResponse(array $apiResponse): array
    {
        $parsedStandings = [];

        $leagueData = $apiResponse[0]['league'];

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
        $leagueData = $apiResponse[0]['league'];
        $countryData = $apiResponse[0]['country'];
        $leagueSeasons = $apiResponse[0]['seasons'];

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
