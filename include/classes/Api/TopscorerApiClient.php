<?php

namespace Infoball\classes\Api;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class TopscorerApiClient
 *
 * Represents a client for interacting with the Top goal scorers API.
 */
class TopscorerApiClient extends ApiClient
{
    /**
    * Fetch top goal scorer data from the API.
    *
    * @param int $league  The league number.
    * @param int $season  The season number.
    * @return array|false The goal data if successful, false on failure.
    */
    public function fetchTopscorerData(int $league, int $season): array|false
    {
        $queryParams = [
            'league' => $league,
            'season' => $season,
        ];

        return parent::fetchData($queryParams);
    }
}
