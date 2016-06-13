<?php

namespace Weather\Factories;

class WeatherFactory {
    public function buildYahooWeather($yahooApiResponse) {
        return new \Weather\Adapters\Forecast\YahooWeatherForecast($yahooApiResponse);
    }
}
