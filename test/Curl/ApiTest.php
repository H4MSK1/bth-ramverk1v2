<?php

namespace H4MSK1\Curl;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testConstructorWithoutArgs()
    {
        $api = new Api();
        $this->assertInstanceOf('\H4MSK1\Curl\Api', $api);
    }

    public function testGetServiceByName()
    {
        $api = new Api();
        $this->assertInstanceOf('\H4MSK1\Curl\Api', $api);

        $this->assertFalse($api->getServiceByName('i.dont.exist'));
    }
}
