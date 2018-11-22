<?php

namespace H4MSK1\IpLocator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class IpLocatorControllerTest extends TestCase
{
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . '/config/di');

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpLocatorController();
        $this->controller->setDI($this->di);
    }

    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf('\Anax\Response\Response', $res);

        $body = $res->getBody();
        $exp = '| ramverk1</title>';
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPost()
    {
        $res = $this->controller->indexActionPost();
        $this->assertInstanceOf('\Anax\Response\Response', $res);

        $body = $res->getBody();
        $exp = '| ramverk1</title>';
        $this->assertContains($exp, $body);
    }
}
