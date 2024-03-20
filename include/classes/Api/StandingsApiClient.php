<?php

namespace Infoball\classes\Api;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class StandingsApiClient
 *
 * Represents a client for interacting with the leagues API.
 */
class StandingsApiClient
{
    /**
     * @var Client The Guzzle HTTP client.
     */
    protected Client $client;

    /**
     * @var Logger The logger instance.
     */
    protected Logger $logger;

    /**
     * @var string The API key for accessing the API.
     */
    protected string $apiKey;

    /**
     * @var string The base URL of the API.
     */
    protected string $baseUrl;

    /**
     * Constructs a new StandingsApiClient object.
     *
     * @param string $apiKey The API key for accessing the API.
     * @param string $baseUrl The base URL of the API.
     */
    public function __construct(string $apiKey, string $baseUrl)
    {
        $this->client = new Client();
        $this->logger = new Logger('StandingsApiClient');
        $this->logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/logs/api.log', Logger::DEBUG));
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    /**
    * Fetch league data from the API.
    *
    * @param int $league  The league number.
    * @param int $season  The season number.
    * @return array|false The league data if successful, false on failure.
    */
    public function fetchLeagueData(int $league, int $season): array|false
    {
        if (empty($league) || empty($season)) {
            $this->logger->error('Invalid input parameters provided.');
            return false;
        }

        try {
            $queryParams = http_build_query([
                'league' => $league,
                'season' => $season,
            ]);
            $url = $this->baseUrl . '?' . $queryParams;

            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'x-apisports-key' => $this->apiKey,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                $this->logger->error('API request failed with status code: ' . $statusCode);
                return false;
            }

            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['response'])) {
                $this->logger->error('Unexpected response format');
                return false;
            }

            return $data['response'];
        } catch (ClientException | ServerException | ConnectException | RequestException $e) {
            $this->logger->error('Error: ' . $e->getMessage() . PHP_EOL . 'Trace: ' . $e->getTraceAsString());
            return false;
        }
    }
}
