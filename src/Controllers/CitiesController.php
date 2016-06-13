<?php
namespace Weather\Controllers;

use Weather\Services\CitiesService;
use Weather\Repositories\WeatherRepository\WeatherRepository;

class CitiesController {
    private $citiesService;
    private $weatherRepo;

    public function __construct(
        CitiesService $service,
        WeatherRepository $repo
    ) {
        $this->citiesService = $service;
        $this->weatherRepo = $repo;
    }

    public function index($request, $response, $args) {
        return 'Cities Index';
    }

    public function cityByName($request, $response, $args) {
        //No longer needed: just let users put spaces in the URL
        //$cityName = $this->citiesService->translateCityName($args['cityName']);

        $weather = $this->weatherRepo->getWeatherForCity($args['cityName']);

        $out = [
            'title' => $weather->getTitle(),
            'current' => $weather->getCurrentForecast(),
            '3-day' => $weather->getThreeDayForecast()
        ];

        return var_export($out, true);
    }
}
