<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class FixturesApiClient
 *
 * Represents a client for interacting with the standing API.
 */
class FixturesApiClient extends ApiClient
{
    /**
    * Fetch data from the API.
    *
    * @param int $league  The league number.
    * @param int $season  The season number.
    * @return array|false The data if successful, false on failure.
    */
    public function fetchApiData(int $league, int $season, $startDate, $endDate): array|false
    {
        $queryParams = [
            'timezone' => 'Europe/Oslo',
            'league' => $league,
            'season' => $season,
            'from' => $startDate,
            'to' => $endDate,
        ];

        return parent::fetchData($queryParams);
    }
}
