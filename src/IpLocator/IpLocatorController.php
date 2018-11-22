<?php

namespace H4MSK1\IpLocator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpLocatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction($result = null)
    {
        $page = $this->di->get('page');
        $page->add('anax/iplocator/index', compact('result'));

        return $page->render([
            'title' => 'IP Locator',
        ]);
    }

    public function indexActionPost()
    {
        $request = $this->di->get('request');
        $result = (new IpLocator($request->getPost('ip')))->locateIp();

        return $this->indexAction($result);
    }
}
