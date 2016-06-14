<?php

use PHPUnit\Framework\TestCase;
use \Weather\Adapters\Forecast\YahooWeatherForecast;

class YahooWeatherForecastTest extends TestCase
{
    public function setUp()
    {
        $data = [
            'query' => [
                'results' => [
                    'channel' => [
                        'item' => [
                            'title' => 'Mock Title',
                            'condition' => [
                                'temp' => 'Mock Current Temp',
                                'text' => 'Mock Current Description'
                            ],
                            'forecast' => [
                                [
                                    'date' => 'Mock Date 0',
                                    'day' => 'Mock Day 0',
                                    'high' => 'Mock High 0',
                                    'low' => 'Mock Low 0',
                                    'text' => 'Mock Description 0'
                                ],
                                [
                                    'date' => 'Mock Date 1',
                                    'day' => 'Mock Day 1',
                                    'high' => 'Mock High 1',
                                    'low' => 'Mock Low 1',
                                    'text' => 'Mock Description 1'
                                ],
                                [
                                    'date' => 'Mock Date 2',
                                    'day' => 'Mock Day 2',
                                    'high' => 'Mock High 2',
                                    'low' => 'Mock Low 2',
                                    'text' => 'Mock Description 2'
                                ]
                            ]
                        ],
                        'wind' => [
                            'chill' => 'Mock Wind Chill',
                            'direction' => 0,
                            'speed' => 'Mock Wind Speed'
                        ],
                        'atmosphere' => [
                            'humidity' => 'Mock Humidity'
                        ]
                    ]
                ]
            ],
        ];

        $this->forecast = new YahooWeatherForecast($data);
    }

    public function testGetTitle()
    {
        $this->assertEquals($this->forecast->getTitle(), 'Mock Title');
    }

    public function testGetCurrentForecast()
    {
        $current = $this->forecast->getCurrentForecast();

        $this->assertEquals($current['windChill'], 'Mock Wind Chill');
        $this->assertEquals($current['windDirection'], 'North');
        $this->assertEquals($current['windSpeed'], 'Mock Wind Speed');
        $this->assertEquals($current['humidity'], 'Mock Humidity');
        $this->assertEquals($current['temperature'], 'Mock Current Temp');
        $this->assertEquals($current['description'], 'Mock Current Description');
    }

    public function testGetThreeDayForecast()
    {
        $threeDay = $this->forecast->getThreeDayForecast();

        for ($i = 0; $i < 3; $i++) {
            $forecast = $threeDay[$i];
            $this->assertEquals($forecast['date'], 'Mock Date ' . $i);
            $this->assertEquals($forecast['day'], 'Mock Day ' . $i);
            $this->assertEquals($forecast['high'], 'Mock High ' . $i);
            $this->assertEquals($forecast['low'], 'Mock Low ' . $i);
            $this->assertEquals($forecast['description'], 'Mock Description ' . $i);
        }
    }
}
