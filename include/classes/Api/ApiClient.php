<?php

namespace Infoball\classes\Api;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class ApiClient
 *
 * Represents a generic client for interacting with any API endpoint.
 */
class ApiClient
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
     * Constructs a new ApiClient object.
     *
     * @param string $apiKey The API key for accessing the API.
     * @param string $baseUrl The base URL of the API.
     */
    public function __construct(string $apiKey, string $baseUrl)
    {
        $this->client = new Client();
        $this->logger = new Logger('ApiClient');
        $this->logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/logs/api.log', Logger::DEBUG));
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    /**
    * Fetch data from the API.
    *
    * @param array $queryParams The query parameters for the API request.
    * @return array|false The API response data if successful, false on failure.
    */
    public function fetchData(array $queryParams): array|false
    {
        try {
            $url = $this->baseUrl . '?' . http_build_query($queryParams);

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
