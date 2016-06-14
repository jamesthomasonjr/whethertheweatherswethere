<?php
namespace Weather\Controllers;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Weather\Repositories\WeatherRepository\WeatherRepository;
//use \Slim\Views\PhpRenderer as Renderer;
use \Slim\Views\Twig as Renderer;

class CitiesController
{
    private $weatherRepo;
    private $renderer;

    public function __construct(
        WeatherRepository $repo,
        Renderer $renderer
    ) {
        $this->weatherRepo = $repo;
        $this->renderer = $renderer;
    }

    public function index(Request $request, Response $response, array $args)
    {
        return $this->renderer->render($response, 'cities/index.phtml');
    }

    public function cityByName(Request $request, Response $response, array $args)
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
