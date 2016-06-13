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
        $cityName = $this->citiesService->translateCityName($args['cityName']);
        $weather = $this->weatherRepo->getWeatherForCity($cityName);

        return $weather;
    }
}
