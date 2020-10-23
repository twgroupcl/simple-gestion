<?php

namespace App\Services;

use GuzzleHttp\Client;

class ChilexpressService
{
	private $client;
	private $sandboxUrl = 'https://testservices.wschilexpress.com/rating/api/v1.0/rates/courier';

	public function __construct()
	{
		$this->client = new Client();
	}

	public function calculate($input)
	{
		try {
			$response = $this->client->post($this->sandboxUrl, [
				'json' => $input,
				'headers' => [
					'Content-Type' => 'application/json',
					'Cache-Control' => 'no-cache',
					'Ocp-Apim-Subscription-Key' => 'f767358f953f4feb8020e44deee43b6b',
				],
			]);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
        }

		return json_decode($response->getBody()->getContents());
	}

	public function coverage($regionCode)
	{
		$response = $this->client->get('https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas?RegionCode='.$regionCode.'&type=0');

		return json_decode($response->getBody()->getContents());
    }

    public function getRegions()
	{
		$response = $this->client->get('https://testservices.wschilexpress.com/georeference/api/v1.0/regions');
		return json_decode($response->getBody()->getContents());
	}
}
