<?php

namespace H4MSK1\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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
        $result = (new Weather)->processRequest($request, $curl, true);

        return [$result];
    }
}
