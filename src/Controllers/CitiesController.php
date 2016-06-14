<?php
namespace Weather\Controllers;

use Weather\Repositories\WeatherRepository\WeatherRepository;
use \Slim\Views\PhpRenderer as Renderer;

class CitiesController {
    private $weatherRepo;
    private $renderer;

    public function __construct(
        WeatherRepository $repo,
        Renderer $renderer
    ) {
        $this->weatherRepo = $repo;
        $this->renderer = $renderer;
    }

    public function index($request, $response, $args)
    {
        return $this->renderer->render($response, 'cities/index.phtml');
    }

    public function cityByName($request, $response, $args)
    {
        $weather = $this->weatherRepo->getWeatherForCity($args['cityName']);

        $data = [
            'title' => $weather->getTitle(),
            'current' => $weather->getCurrentForecast(),
            'threeDay' => $weather->getThreeDayForecast()
        ];

        return $this->renderer->render($response, 'cities/forecast.phtml', $data);
    }
}
