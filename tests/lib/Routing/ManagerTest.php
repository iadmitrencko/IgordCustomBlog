<?php

namespace Tests\lib\Routing;

use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    // ########################################

    public function testRouteFindWithoutParams()
    {
        $collection = $this->createCollection();

        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '/');

        $manager = new \Igord\CustomBlog\lib\Routing\Manager(
            $collection,
            $request
        );

        $route = $manager->findRoute();

        $this->assertNotNull($route);
        $this->assertInstanceOf(\Igord\CustomBlog\lib\Routing\Manager\Result\Route::class, $route);
        $this->assertEquals('IndexController', $route->getController());
        $this->assertEquals('show', $route->getAction());
        $this->assertFalse($route->hasParams());
        $this->assertEmpty($route->getParams());
    }

    public function testRouteFindWithCorrectParams()
    {
        $collection = $this->createCollection();

        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '/post/48');

        $manager = new \Igord\CustomBlog\lib\Routing\Manager(
            $collection,
            $request
        );

        $route = $manager->findRoute();

        $this->assertNotNull($route);
        $this->assertInstanceOf(\Igord\CustomBlog\lib\Routing\Manager\Result\Route::class, $route);
        $this->assertEquals('PostController', $route->getController());
        $this->assertEquals('show', $route->getAction());
        $this->assertTrue($route->hasParams());

        $params = $route->getParams();

        $this->assertIsArray($params);
        $this->assertEquals(1, count($params));

        $param = $params[0];
        $this->assertInstanceOf(\Igord\CustomBlog\lib\Routing\Manager\Result\Route\Param::class, $param);
        $this->assertEquals('{id}', $param->getName());
        $this->assertEquals(48, $param->getValue());
    }

    public function testRouteNotFind()
    {
        $collection = $this->createCollection();

        $request = new \Igord\CustomBlog\lib\Http\Request('GET', '/not/existed/path');

        $manager = new \Igord\CustomBlog\lib\Routing\Manager(
            $collection,
            $request
        );

        $this->assertNull($manager->findRoute());
    }

    // ########################################

    private function createCollection(): \Igord\CustomBlog\lib\Routing\Route\Collection
    {
        $idParam = new \Igord\CustomBlog\lib\Routing\Route\Param(
            '{id}',
            '#^[0-9]*$#'
        );

        $collection = new \Igord\CustomBlog\lib\Routing\Route\Collection();

        $collection->addRoute(
            new \Igord\CustomBlog\lib\Routing\Route(
                'GET',
                '/',
                'IndexController',
                'show'
            )
        );

        $collection->addRoute(
            new \Igord\CustomBlog\lib\Routing\Route(
                'GET',
                '/post/{id}',
                'PostController',
                'show',
                [$idParam]
            )
        );

        $collection->addRoute(
            new \Igord\CustomBlog\lib\Routing\Route(
                'POST',
                '/post/{id}/comment',
                'CommentController',
                'add',
                [$idParam]
            )
        );

        return $collection;
    }

    // ########################################
}
