<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class apiParser
{
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
