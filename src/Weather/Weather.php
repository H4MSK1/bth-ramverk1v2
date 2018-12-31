<?php

namespace H4MSK1\Weather;

use H4MSK1\Map\OpenLayers;
use H4MSK1\IpLocator\IpLocator;

class Weather
{
    public function processRequest($request, $curl, $useQueryString = false)
    {
        $payload = ['weather' => [], 'map' => null];
        $lat = 0;
        $lng = 0;

        if ($useQueryString) {
            $ip = $request->getGet('ip');
            $coords = $request->getGet('coords');
            $type = $request->getGet('type');
        } else {
            $ip = $request->getPost('ip');
            $coords = $request->getPost('coords');
            $type = $request->getPost('type');
        }

        if (empty($ip) && empty($coords)) {
            $payload['error'] = 'Missing input data';
            return $payload;
        }

        if (! empty($ip)) {
            $iploc = (new IpLocator($ip))->locateIp();

            if (isset($iploc['latitude']) && isset($iploc['longitude'])) {
                $lat = $iploc['latitude'];
                $lng = $iploc['longitude'];
            } else {
                $payload['error'] = 'Ip not valid';
            }
        }

        if (! empty($coords)) {
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

        if ($useQueryString) {
            // remove the map HTML code since we're using the API at this point
            unset($payload['map']);
        }

        return $payload;
    }
}
