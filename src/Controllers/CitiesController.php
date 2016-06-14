<?php
namespace Weather\Controllers;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Weather\Repositories\WeatherRepository\WeatherRepository;
use \Slim\Views\Twig as Renderer;

class CitiesController
{
    /**
     * @var WeatherRepository $weatherRepo Repository to grab weather data from
     */
    private $weatherRepo;

    /**
     * @var Renderer $renderer Renderer to build a take a ViewModel array and build a View
     */
    private $renderer;

    /**
     * Creates a new CitiesController
     *
     * @param WeatherRepository $repo
     * @param Renderer $renderer
     */
    public function __construct(
        WeatherRepository $repo,
        Renderer $renderer
    ) {
        $this->weatherRepo = $repo;
        $this->renderer = $renderer;
    }

    /**
     * Builds the Cities Index page
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response $view
     */
    public function index(Request $request, Response $response, array $args)
    {
        return $this->renderer->render($response, 'cities/index.html');
    }

    /**
     * Builds the City Forecast page
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response $view
     */
    public function cityByName(Request $request, Response $response, array $args)
    {
        $weather = $this->weatherRepo->getWeatherForCity($args['cityName']);

        $data = [
            'title' => $weather->getTitle(),
            'current' => $weather->getCurrentForecast(),
            'threeDay' => $weather->getThreeDayForecast()
        ];

        return $this->renderer->render($response, 'cities/forecast.html', $data);
    }
}
