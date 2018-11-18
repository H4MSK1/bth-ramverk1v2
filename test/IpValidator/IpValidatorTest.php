<?php

namespace H4MSK1\IpValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class IpValidatorTest extends TestCase
{
    public function testConstructorWithoutArgs()
    {
        $validator = new IpValidator();
        $this->assertInstanceOf('\H4MSK1\IpValidator\IpValidator', $validator);
    }

    public function testConstructorWith()
    {
        $validator = new IpValidator('8.8.8.8');
        $this->assertInstanceOf('\H4MSK1\IpValidator\IpValidator', $validator);
        $this->assertEquals('8.8.8.8', $validator->getIp());
    }

    public function testSetGetIp()
    {
        $validator = new IpValidator();
        $validator->setIp();
        $this->assertEquals('Invalid', $validator->getIp());

        $validator->setIp('8.8.8.8');
        $this->assertEquals('8.8.8.8', $validator->getIp());
    }

    public function testGetPayload()
    {
        $this->assertEmpty((new IpValidator)->getPayload());
    }

    public function testGetHostName()
    {
        $validator = new IpValidator();
        $this->assertFalse($validator->getHostName());

        $validator->setIp('8.8.8.8');
        $this->assertContains('google', $validator->getHostName());
    }

    public function testGetProtocolType()
    {
        $validator = new IpValidator();
        $this->assertFalse($validator->getProtocolType());

        $validator->setIp('8.8.8.8');
        $this->assertEquals('IPv4', $validator->getProtocolType());

        $validator->setIp('2001:4860:4860::8888');
        $this->assertEquals('IPv6', $validator->getProtocolType());
    }

    public function testValidate()
    {
        $validator = new IpValidator();
        $res = $validator->validate();

        $this->assertEquals('Invalid', $res['ip']);
        $this->assertEquals('Invalid', $res['type']);
        $this->assertEquals('Unkown', $res['hostname']);

        $validator->setIp('8.8.8.8');
        $res = $validator->validate();

        $this->assertEquals('8.8.8.8', $res['ip']);
        $this->assertEquals('IPv4', $res['type']);
        $this->assertContains('google', $res['hostname']);
    }
}
