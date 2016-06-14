<?php

namespace Weather\Repositories\WeatherRepository;

interface WeatherRepository
{
    public function getWeatherForCity($cityName);
}
