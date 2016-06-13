<?php
namespace Weather\Controllers;

use Weather\Repositories\WeatherRepository\WeatherRepository;

class CitiesController {
    private $weatherRepo;

    public function __construct(
        WeatherRepository $repo
    ) {
        $this->weatherRepo = $repo;
    }

    public function index($request, $response, $args) {
        return 'Cities Index';
    }

    public function cityByName($request, $response, $args) {
        $weather = $this->weatherRepo->getWeatherForCity($args['cityName']);

        $out = [
            'title' => $weather->getTitle(),
            'current' => $weather->getCurrentForecast(),
            '3-day' => $weather->getThreeDayForecast()
        ];

        return var_export($out, true);
    }
}
