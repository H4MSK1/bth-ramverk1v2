<?php

namespace H4MSK1\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use H4MSK1\IpLocator\IpLocator;

class WeatherApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get('page');
        $page->add('anax/weather/api');

        return $page->render([
            'title' => 'Weather',
        ]);
    }

    public function forecastAction()
    {
        $request = $this->di->get('request');
        $curl = $this->di->get('curl');

        $ip = (new IpLocator($request->getGet('ip')))->locateIp();
        $type = $request->getGet('type');
        $coords = $request->getGet('coords');
        $result = (new Weather)->processRequest($ip, $coords, $type, $curl);
        unset($result['map']);

        return [$result];
    }
}
