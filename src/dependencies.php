<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['factories.weather'] = function ($c) {
    return new \Weather\Factories\WeatherFactory();
};

$container['repositories.weather.yahoo'] = function ($c) {
    $guzzle = new \GuzzleHttp\Client([
        'base_uri' => 'https://query.yahooapis.com/v1/public/'
    ]);

    return new \Weather\Repositories\WeatherRepository\YahooWeatherRepository(
        $guzzle,
        $c['factories.weather']
    );
};

$container['controllers.index'] = function ($c) {
    return new \Weather\Controllers\IndexController(
        $c['renderer']
    );
};

$container['controllers.cities'] = function ($c) {
    return new \Weather\Controllers\CitiesController(
        $c['repositories.weather.yahoo'],
        $c['renderer']
    );
};
