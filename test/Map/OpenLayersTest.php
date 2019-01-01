<?php

namespace H4MSK1\Map;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class OpenLayersTest extends TestCase
{
    public function testConstructorWithoutArgs()
    {
        $map = new OpenLayers();
        $this->assertInstanceOf('\H4MSK1\Map\OpenLayers', $map);
    }

    public function testGetHtml()
    {
        $map = new OpenLayers();
        $this->assertInstanceOf('\H4MSK1\Map\OpenLayers', $map);

        $this->assertContains('<div', $map->getHtml(1, 1));
    }
}
