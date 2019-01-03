<?php

namespace H4MSK1\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function testConstructorWithoutArgs()
    {
        $weather = new Weather();
        $this->assertInstanceOf('\H4MSK1\Weather\Weather', $weather);
    }

    public function testProcessRequest()
    {
        $weather = new Weather();
        $this->assertInstanceOf('\H4MSK1\Weather\Weather', $weather);
    }
}
