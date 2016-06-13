<?php

namespace Weather\Repositories\WeatherRepository;

use \GuzzleHttp\Client;
use \Weather\Factories\WeatherFactory;

class YahooWeatherRepository implements WeatherRepository {
    private $client;
    private $weatherFactory;

    public function __construct(
        Client $client,
        WeatherFactory $weatherFactory
    ) {
        $this->client = $client;
        $this->weatherFactory = $weatherFactory;
    }

    public function getWeatherForCity($cityName) {
        $query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text=\"{$cityName}\");";
        $url = "yql?q=" . urlencode($query) . "&format=json";

        $response = $this->client->get($url)->getBody();


        $responseObject = json_decode($response, true);

        return $this->weatherFactory->buildYahooWeather($responseObject);
    }
}
