<?php

namespace Tests\lib\Routing;

use PHPUnit\Framework\TestCase as TestCase;
use \Igord\CustomBlog\lib\Http\Request as Request;
use \Igord\CustomBlog\lib\Routing\Route as Route;
use \Igord\CustomBlog\lib\Routing\Route\Param as RouteParam;
use \Igord\CustomBlog\lib\Routing\Manager as Manager;
use \Igord\CustomBlog\lib\Routing\Manager\Result\Route as ResultRoute;
use \Igord\CustomBlog\lib\Routing\Route\Collection as Collection;
use \Igord\CustomBlog\lib\Routing\Manager\Result\Route\Param as ResultRouteParam;

class ManagerTest extends TestCase
{
    // ########################################

    public function testRouteFindWithoutParams()
    {
        $collection = $this->createCollection();
        $request    = new Request('GET', '/');
        $manager    = new Manager($collection, $request);

        $route = $manager->findRoute();

        $this->assertNotNull($route);
        $this->assertInstanceOf(ResultRoute::class, $route);
        $this->assertEquals('IndexController', $route->getController());
        $this->assertEquals('show', $route->getAction());
        $this->assertFalse($route->hasParams());
        $this->assertEmpty($route->getParams());
    }

    public function testRouteFindWithCorrectParams()
    {
        $collection = $this->createCollection();
        $request    = new Request('GET', '/post/48');
        $manager    = new Manager($collection, $request);

        $route = $manager->findRoute();

        $this->assertNotNull($route);
        $this->assertInstanceOf(ResultRoute::class, $route);
        $this->assertEquals('PostController', $route->getController());
        $this->assertEquals('show', $route->getAction());
        $this->assertTrue($route->hasParams());

        $params = $route->getParams();

        $this->assertIsArray($params);
        $this->assertEquals(1, count($params));

        $param = $params[0];
        $this->assertInstanceOf(ResultRouteParam::class, $param);
        $this->assertEquals('{id}', $param->getName());
        $this->assertEquals(48, $param->getValue());
    }

    public function testRouteNotFound()
    {
        $collection = $this->createCollection();
        $request    = new Request('GET', '/not/existed/path');
        $manager    = new Manager($collection, $request);

        $this->assertNull($manager->findRoute());
    }

    // ########################################

    private function createCollection(): Collection
    {
        $idParam = new RouteParam('{id}', '#^[0-9]*$#');

        $collection = new Collection();

        $collection->addRoute(new Route('GET', '/', 'IndexController', 'show'));
        $collection->addRoute(new Route('GET', '/post/{id}', 'PostController', 'show', [$idParam]));
        $collection->addRoute(new Route('POST', '/post/{id}/comment', 'CommentController', 'add', [$idParam]));

        return $collection;
    }

    // ########################################
}
