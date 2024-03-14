<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;
use Infoball\classes\Api\LeaguesApiClient;

/**
 * Class PremierLeague
 *
 * Represents the PremierLeague page of the website.
 */
class PremierLeague extends Base
{
    /**
     * Constructs a new PremierLeague object.
     */
    public function __construct()
    {
        parent::__construct();

        // Render the PremierLeague page.
        if (isset($_SESSION["userId"])) {
            echo $this->render("/classes/PremierLeague/PremierLeague.html.twig", [
                "data" => $this->getData(),
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }

    private function getData()
    {
        $apiKey = 'cd49181cf69486c1ac135da582e54070';
        $baseUrl = 'https://v3.football.api-sports.io/leagues';
        $leaguesApiClient = new LeaguesApiClient($apiKey, $baseUrl);

        $paramName = 'Premier league';
        $paramCountry = 'England';
        $data = $leaguesApiClient->fetchLeagueData($paramName, $paramCountry);

        if ($data !== false) {
            $leagueData = $data[0]['league'];
            $name = $leagueData['name'];
            $logo = $leagueData['logo'];

            $country = $data[0]['country']['name'];

            $seasons = $data[0]['seasons'];

            return [
                'name' => $name,
                'logo' => $logo,
                'country' => $country,
                'seasons' => $seasons,
            ];
        } else {
            //Handle case where data retrieval fails
            return [];
        }
    }
}

new PremierLeague();
