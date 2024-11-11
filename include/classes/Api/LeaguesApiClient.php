<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class LeaguesApiClient
 *
 * Represents a client for interacting with the leagues API.
 */
class LeaguesApiClient extends ApiClient
{
    /**
    * Fetch league data from the API.
    *
    * @param string $name    The name of the league.
    * @param string $country The country of the league.
    * @return array|false    The league data if successful, false on failure.
    */
    public function fetchLeagueData(string $name, string $country): array|false
    {
        $queryParams = [
            'name' => $name,
            'country' => $country,
        ];

        return parent::fetchData($queryParams);
    }
}
