<?php

namespace H4MSK1\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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
        $result = (new Weather)->processRequest($request, $curl);

        return $this->indexAction($result);
    }
}
