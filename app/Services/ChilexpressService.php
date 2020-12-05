<?php

namespace App\Services;

use GuzzleHttp\Client;

class ChilexpressService
{
	private $client;
	private $sandboxUrl = 'https://qaservices.wschilexpress.com/rating/api/v1.0/rates/courier';

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
					'Ocp-Apim-Subscription-Key' => '058a8ce59e4b44888c35134e0b7a6245',
				],
			]);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
        }

		return json_decode($response->getBody()->getContents());
	}

	public function coverage($regionCode)
	{
		//$response = $this->client->get('https://qaservices.wschilexpress.com/georeference/api/v1.0/coverage-areas?RegionCode='.$regionCode.'&type=0');
		try {
			$response = $this->client->get('https://qaservices.wschilexpress.com/georeference/api/v1.0/coverage-areas?RegionCode='.$regionCode.'&type=0', [
				'headers' => [
					'Content-Type' => 'application/json',
					'Cache-Control' => 'no-cache',
					'Ocp-Apim-Subscription-Key' => 'd89a06bd90db4fd8a32c5d66d1fbd5fc',
				],
			]);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
		}
		
		return json_decode($response->getBody()->getContents());
    }

    public function getRegions()
	{
		//$response = $this->client->get('https://qaservices.wschilexpress.com/georeference/api/v1.0/regions');
		try {
			$response = $this->client->get('https://qaservices.wschilexpress.com/georeference/api/v1.0/regions', [
				'headers' => [
					'Content-Type' => 'application/json',
					'Cache-Control' => 'no-cache',
					'Ocp-Apim-Subscription-Key' => 'd89a06bd90db4fd8a32c5d66d1fbd5fc',
				],
			]);
		} catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
		}

		return json_decode($response->getBody()->getContents());
	}
}
