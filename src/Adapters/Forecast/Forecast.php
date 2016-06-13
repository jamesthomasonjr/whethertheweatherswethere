<?php

namespace Weather\Adapters\Forecast;

interface Forecast {
    public function getTitle();
    public function getCurrentForecast();
    public function getThreeDayForecast();
}
