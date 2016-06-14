<?php

namespace Weather\Repositories\WeatherRepository;

interface WeatherRepository
{
    /**
     * Grabs the weather data for the given city
     *
     * @param string $cityName
     * @return \Weather\Adatpers\Forecast\Forecast $forecast
     */
    public function getWeatherForCity($cityName);
}
