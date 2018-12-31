<?php

namespace H4MSK1\Curl;

use H4MSK1\Curl\Traits\WeatherApiTrait;

class Api
{
    use WeatherApiTrait;

    private $di;
    private $endpoints = [];

    public function __construct(array $endpoints = [], $di = null)
    {
        $this->endpoints = $endpoints;
        $this->di = $di;
    }

    public function getServiceByName($name)
    {
        return array_key_exists($name, $this->endpoints)
            ? $this->endpoints[$name]
            : false;
    }

    public function fetchCurl($endpoint)
    {
        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return $response;
    }
}
