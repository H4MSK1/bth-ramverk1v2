<?php

namespace H4MSK1\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use H4MSK1\IpLocator\IpLocator;

class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction($result = null)
    {
        $page = $this->di->get('page');
        $page->add('anax/weather/index', compact('result'));

        return $page->render([
            'title' => 'Weather',
        ]);
    }

    public function indexActionPost()
    {
        $request = $this->di->get('request');
        $curl = $this->di->get('curl');

        $ipAddr = (new IpLocator($request->getPost('ip')))->locateIp();
        $type = $request->getPost('type');
        $coords = $request->getPost('coords');
        $result = (new Weather)->processRequest($ipAddr, $coords, $type, $curl);

        return $this->indexAction($result);
    }
}
