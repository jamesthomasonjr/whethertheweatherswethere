<?php

namespace Weather\Adapters\Forecast;

class YahooWeatherForecast {
    private $data;

    public function __construct($yahooApiResponse) {
        $this->data = $yahooApiResponse;
    }

    public function getTitle() {
        return $this->data['query']['results']['channel']['item']['title'];
    }

    public function getCurrentForecast() {
        return [
            'current' => [
                'windChill' => $this->data['query']['results']['channel']['wind']['chill'],
                'windDirection' => $this->data['query']['results']['channel']['wind']['direction'],
                'windSpeed' => $this->data['query']['results']['channel']['wind']['speed'],
                'humidity' => $this->data['query']['results']['channel']['atmosphere']['humidity'],
                'temperature' => $this->data['query']['results']['channel']['item']['condition']['temp'],
                'description' => $this->data['query']['results']['channel']['item']['condition']['text']
            ],
            'forecast' => [
                'date' => $this->data['query']['results']['channel']['item']['forecast'][0]['date'],
                'day' => $this->data['query']['results']['channel']['item']['forecast'][0]['day'],
                'high' => $this->data['query']['results']['channel']['item']['forecast'][0]['high'],
                'low' => $this->data['query']['results']['channel']['item']['forecast'][0]['low'],
                'description' => $this->data['query']['results']['channel']['item']['forecast'][0]['text'],
            ]
        ];
    }

    public function getThreeDayForecast() {
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
