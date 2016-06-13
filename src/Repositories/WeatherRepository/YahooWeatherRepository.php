<?php

namespace Weather\Repositories\WeatherRepository;

class YahooWeatherRepository implements WeatherRepository {
    public function __construct() {
    }

    public function getWeatherForCity($cityName) {
        return $cityName;
    }
}
