<?php

namespace Igord\CustomBlog\lib\Routing\Route;

class Collection
{
    /** @var \Igord\CustomBlog\lib\Routing\Route[] */
    private $routes = [];

    // ########################################

    /**
     * @param \Igord\CustomBlog\lib\Routing\Route $route
     */
    public function addRoute(\Igord\CustomBlog\lib\Routing\Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @return \Igord\CustomBlog\lib\Routing\Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    // ########################################
}
