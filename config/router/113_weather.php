<?php

return [
    "routes" => [
        [
            "info" => "Weather",
            "mount" => "weather/default",
            "handler" => "\H4MSK1\Weather\WeatherController",
        ],
        [
            "info" => "Weather JSON",
            "mount" => "weather/api",
            "handler" => "\H4MSK1\Weather\WeatherApiController",
        ],
    ]
];
