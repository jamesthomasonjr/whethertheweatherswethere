<?php

namespace Weather\Adapters\Forecast;

interface Forecast
{
    /**
     * Grabs the page title from the wrapped data
     *
     * @return string $title Page title
     */
    public function getTitle();

    /**
     * Grabs the current forecast details from the wrapped data
     *
     * @return array $current Current weather conditions
     */
    public function getCurrentForecast();

    /**
     * Grabs the three day forecast details from the wrapped data
     *
     * @return array $threeDayForecast Three day forecast
     */
    public function getThreeDayForecast();
}
