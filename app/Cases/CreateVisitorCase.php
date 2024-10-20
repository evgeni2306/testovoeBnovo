<?php

declare(strict_types=1);

namespace App\Cases;

use App\Exceptions\CountryByPhoneApiException;
use App\Forms\CreateVisitorForm;
use App\Interfaces\CountryByPhoneInterface;
use App\Models\Visitor;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class CreateVisitorCase
{
    public function __construct(private CountryByPhoneInterface $client)
    {
    }

    /**
     * @param CreateVisitorForm $formData
     * @return int
     * @throws CountryByPhoneApiException
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle(CreateVisitorForm $formData): int
    {
        $data = $formData->toArray();

        if (!isset($data['country'])) {
            $data['country'] = $this->getCountryByPhone($data['phone']);
        }
        $visitor = new Visitor($data);
        $visitor->save();

        return $visitor->id;
    }

    /**
     * @param string $phone
     * @return string
     * @throws CountryByPhoneApiException
     * @throws GuzzleException
     * @throws JsonException
     */
    private function getCountryByPhone(string $phone): string
    {
        $responseData = $this->client->send($phone);

        return (string)$responseData['country']['iso'];
    }
}
