<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class StandardParamApiClient
 *
 * Represents a client for interacting with the standing API.
 */
class StandardParamApiClient extends ApiClient
{
    /**
    * Fetch data from the API.
    *
    * @param int $league  The league number.
    * @param int $season  The season number.
    * @return array|false The data if successful, false on failure.
    */
    public function fetchApiData(int $league, int $season): array|false
    {
        $queryParams = [
            'league' => $league,
            'season' => $season,
        ];

        return parent::fetchData($queryParams);
    }
}
