<?php

namespace Weather\Adapters\Forecast;

class YahooWeatherForecast
{
    private $data;

    public function __construct($yahooApiResponse)
    {
        $this->data = $yahooApiResponse;
    }

    public function getTitle()
    {
        return $this->data['query']['results']['channel']['item']['title'];
    }

    private function translateWindDirection($windDirection)
    {
        $out = '';

        if ($windDirection >= 0 && $windDirection <= 11.5) {
            $out = 'North';
        } elseif ($windDirection > 11.25 && $windDirection <= 34.0) {
            $out = 'North North East';
        } elseif ($windDirection > 33.75 && $windDirection <= 56.5) {
            $out = 'North East';
        } elseif ($windDirection > 56.25 && $windDirection <= 78.75) {
            $out = 'East North East';
        } elseif ($windDirection > 78.75 && $windDirection <= 101.25) {
            $out = 'East';
        } elseif ($windDirection > 101.25 && $windDirection <= 123.75) {
            $out = 'East South East';
        } elseif ($windDirection > 123.75 && $windDirection <= 146.25) {
            $out = 'South East';
        } elseif ($windDirection > 146.25 && $windDirection <= 168.75) {
            $out = 'South South East';
        } elseif ($windDirection > 168.75 && $windDirection <= 191.25) {
            $out = 'South';
        } elseif ($windDirection > 191.25 && $windDirection <= 213.75) {
            $out = 'South South West';
        } elseif ($windDirection > 213.75 && $windDirection <= 236.25) {
            $out = 'South West';
        } elseif ($windDirection > 236.25 && $windDirection <= 258.75) {
            $out = 'West South West';
        } elseif ($windDirection > 258.75 && $windDirection <= 281.25) {
            $out = 'West';
        } elseif ($windDirection > 281.25 && $windDirection <= 303.75) {
            $out = 'West North West';
        } elseif ($windDirection > 303.75 && $windDirection <= 326.25) {
            $out = 'North West';
        } elseif ($windDirection > 326.25 && $windDirection <= 348.75) {
            $out = 'North North West';
        } elseif ($windDirection > 348.75 && $windDirection <= 360) {
            $out = 'North';
        }

        return $out;
    }

    public function getCurrentForecast()
    {
        return [
            'windChill' => $this->data['query']['results']['channel']['wind']['chill'],
            'windDirection' => $this->translateWindDirection($this->data['query']['results']['channel']['wind']['direction']),
            'windSpeed' => $this->data['query']['results']['channel']['wind']['speed'],
            'humidity' => $this->data['query']['results']['channel']['atmosphere']['humidity'],
            'temperature' => $this->data['query']['results']['channel']['item']['condition']['temp'],
            'description' => $this->data['query']['results']['channel']['item']['condition']['text']
        ];
    }

    public function getThreeDayForecast()
    {
        $forecast = [];

        for($i = 0; $i < 3; $i++) {
            $forecast[] = [
                'date' => $this->data['query']['results']['channel']['item']['forecast'][$i]['date'],
                'day' => $this->data['query']['results']['channel']['item']['forecast'][$i]['day'],
                'high' => $this->data['query']['results']['channel']['item']['forecast'][$i]['high'],
                'low' => $this->data['query']['results']['channel']['item']['forecast'][$i]['low'],
                'description' => $this->data['query']['results']['channel']['item']['forecast'][$i]['text'],
            ];
        }

        return $forecast;
    }
}
