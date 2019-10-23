<?php

namespace Tests\lib\Routing;

use PHPUnit\Framework\TestCase;
use \Igord\CustomBlog\lib\Routing\Route as Route;
use \Igord\CustomBlog\lib\Routing\Route\Param as RouteParam;

class RouteTest extends TestCase
{
    // ########################################

    public function testMethodParamPreparedCorrectly()
    {
        $route = new Route('GeT', '/post/asd', 'Controller', 'action');

        $this->assertNotEquals('GeT', $route->getMethod());
        $this->assertEquals('GET', $route->getMethod());

        // ----------------------------------------

        $route = new Route('', '/post/asd', 'Controller', 'action');

        $this->assertEquals('', $route->getMethod());
    }

    public function testUriParamPreparedCorrectly()
    {
        $route = new Route('GET', '/', 'Controller', 'action');

        $this->assertEquals('/', $route->getUri());

        // ----------------------------------------

        $route = new Route('GET', '/post/id', 'Controller', 'action');

        $this->assertEquals('/post/id/', $route->getUri());

        // ----------------------------------------

        $route = new Route('GET', '', 'Controller', 'action');

        $this->assertEquals('/', $route->getUri());
    }

    public function testParamsFunctionality()
    {
        $param = new RouteParam('name', 'pattern');

        $route = new Route('GET', '/', 'Controller', 'action', [$param]);

        $this->assertTrue($route->hasParam('name'));
        $this->assertFalse($route->hasParam('notExistedParamName'));
        $this->assertIsArray($route->getParams());

        $this->assertInstanceOf(RouteParam::class, $route->getParam('name'));

        $this->expectException(\LogicException::class);
        $route->getParam('notExistedParamName');
    }

    // ########################################
}