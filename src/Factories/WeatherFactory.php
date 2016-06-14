<?php

namespace Weather\Factories;

class WeatherFactory
{
    /**
     * Builds a new YahooWeatherForecast object
     *
     * @param array $yahooApiResponse
     * @return \Weather\Adapters\Forecast\YahooWeatherForecast
     */
    public function buildYahooWeather($yahooApiResponse)
    {
        return new \Weather\Adapters\Forecast\YahooWeatherForecast($yahooApiResponse);
    }
}
