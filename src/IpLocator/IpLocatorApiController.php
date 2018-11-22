<?php

namespace H4MSK1\IpLocator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpLocatorApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get('page');
        $page->add('anax/iplocator/api');

        return $page->render([
            'title' => 'IP Locator',
        ]);
    }

    public function locateAction()
    {
        $request = $this->di->get('request');
        $result = (new IpLocator($request->getGet('ip')))->locateIp();

        return [$result];
    }
}
