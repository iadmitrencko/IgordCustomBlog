<?php

namespace Tests\lib\Routing;

use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    // ########################################

    public function testMethodParamPreparedCorrectly()
    {
        $route = new \Igord\CustomBlog\lib\Routing\Route(
            'GeT',
            '/post/asd',
            'Controller',
            'action'
        );

        $this->assertNotEquals('GeT', $route->getMethod());
        $this->assertEquals('GET', $route->getMethod());

        $route = new \Igord\CustomBlog\lib\Routing\Route(
            '',
            '/post/asd',
            'Controller',
            'action'
        );

        $this->assertEquals('', $route->getMethod());
    }

    public function testUriParamPreparedCorrectly()
    {
        $route = new \Igord\CustomBlog\lib\Routing\Route(
            'GET',
            '/',
            'Controller',
            'action'
        );

        $this->assertEquals('/', $route->getUri());

        $route = new \Igord\CustomBlog\lib\Routing\Route(
            'GET',
            '/post/id',
            'Controller',
            'action'
        );

        $this->assertEquals('/post/id/', $route->getUri());

        $route = new \Igord\CustomBlog\lib\Routing\Route(
            'GET',
            '',
            'Controller',
            'action'
        );

        $this->assertEquals('/', $route->getUri());
    }

    public function testParamsFunctionality()
    {
        $route = new \Igord\CustomBlog\lib\Routing\Route(
            'GET',
            '/',
            'Controller',
            'action',
            [new \Igord\CustomBlog\lib\Routing\Route\Param('name', 'pattern')]
        );

        $this->assertTrue($route->hasParam('name'));
        $this->assertFalse($route->hasParam('notExistedParamName'));
        $this->assertIsArray($route->getParams());

        $this->assertInstanceOf(\Igord\CustomBlog\lib\Routing\Route\Param::class, $route->getParam('name'));

        $this->expectException(\LogicException::class);
        $route->getParam('notExistedParamName');
    }

    // ########################################
}