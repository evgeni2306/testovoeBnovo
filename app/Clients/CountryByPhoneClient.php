<?php

declare(strict_types=1);

namespace App\Clients;

use App\Exceptions\CountryByPhoneApiException;
use App\Interfaces\CountryByPhoneInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;
use JsonException;

class CountryByPhoneClient implements CountryByPhoneInterface
{
    private const logChannel = 'countrybyphoneapi';

    public function __construct(
        private readonly string $url,
        private readonly string $apiKey,
        private readonly string $charset = 'utf-8',
        private readonly string $responseFormat = 'json',
        private readonly ClientInterface $client = new Client(),
    )
    {
    }

    /**
     * @throws CountryByPhoneApiException
     * @throws GuzzleException
     * @throws JsonException
     */
    public function send(string $address, string $method = 'GET'): array
    {
        return $this->request($method, $address);
    }

    /**
     * @param string $method
     * @param string $phone
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws CountryByPhoneApiException
     */
    public function request(string $method, string $phone): array
    {

        try {
            Log::channel(self::logChannel)->info('request url:' . $this->url . ', method:' . $method . ', query:' . $phone);
            $urlWithQuery = $this->url . "?$this->responseFormat" . "&charset=$this->charset"
                . "&telcod=$phone" . "&api_key=$this->apiKey";

            $response = $this->client->request($method, $urlWithQuery);
            $content = $response->getBody()->getContents();
        } catch (ClientException|ServerException $exception) {
            Log::channel(self::logChannel)->info($exception->getResponse()->getBody()->getContents());
            throw new CountryByPhoneApiException('Connect Error', $exception->getCode(), $exception);
        }

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }
}
