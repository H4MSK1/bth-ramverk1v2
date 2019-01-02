<?php

namespace H4MSK1\Weather;

use H4MSK1\Curl\Api;
use H4MSK1\Map\OpenLayers;

class Weather
{
    public function processRequest($iplocation, $coords, $type, Api $curl)
    {
        $payload = ['weather' => [], 'map' => null];
        $lat = 0;
        $lng = 0;

        if (empty($coords) && $iplocation['ip'] === 'Invalid') {
            $payload['error'] = 'Missing input data';
            return $payload;
        }

        if (empty($coords)) {
            if (isset($iplocation['latitude']) && isset($iplocation['longitude'])) {
                $lat = $iplocation['latitude'];
                $lng = $iplocation['longitude'];
            } else {
                $payload['error'] = 'Ip not valid';
            }
        } else {
            if (strpos($coords, ',') !== false) {
                list($lat, $lng) = explode(',', $coords);
            } else {
                $payload['error'] = 'Coordinates not valid';
            }
        }

        if (! isset($payload['error'])) {
            $payload['weather'] = $curl->getWeatherData($lat, $lng, $type);
            $payload['map'] = (new OpenLayers)->getHtml($lat, $lng);
        }

        return $payload;
    }
}
