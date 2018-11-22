<?php

namespace H4MSK1\IpLocator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class IpLocatorTest extends TestCase
{
    public function testLocateIp()
    {
        $locator = new IpLocator('8.8.8.8');
        $res = $locator->locateIp();

        $this->assertEquals('8.8.8.8', $res['ip']);
        $this->assertEquals('IPv4', $res['type']);
        $this->assertContains('google', $res['hostname']);

        $this->assertArrayHasKey('longitude', $res);
        $this->assertArrayHasKey('latitude', $res);
        $this->assertArrayHasKey('country', $res);
        $this->assertArrayHasKey('city', $res);
    }
}
