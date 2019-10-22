<?php

namespace Igord\CustomBlog\lib\Routing;

class Manager
{
    /** @var \Igord\CustomBlog\lib\Routing\Route\Collection */
    private $collection;

    /** @var \Igord\CustomBlog\lib\Http\Request */
    private $request;

    // ########################################

    /**
     * Manager constructor.
     *
     * @param \Igord\CustomBlog\lib\Routing\Route\Collection $collection
     * @param \Igord\CustomBlog\lib\Http\Request             $request
     */
    public function __construct(Route\Collection $collection, \Igord\CustomBlog\lib\Http\Request $request)
    {
        $this->collection = $collection;
        $this->request    = $request;
    }

    // ########################################

    /**
     * @return \Igord\CustomBlog\lib\Routing\Manager\Result\Route|null
     */
    public function findRoute(): ?Manager\Result\Route
    {
        foreach ($this->collection->getRoutes() as $route) {
            if ($this->request->getMethod() != $route->getMethod()) {
                continue;
            }

            if (($this->request->getUri() == $route->getUri())) {
                return new Manager\Result\Route($route->getController(), $route->getAction());
            }

            $requestUriParams = $this->explodeUriParams($this->request->getUri());
            $routeUriParams   = $this->explodeUriParams($route->getUri());

            if (count($requestUriParams) != count($routeUriParams)) {
                continue;
            }

            $params = [];
            $count  = count($routeUriParams);
            for ($i = 0; $i < $count; $i++) {
                if ($route->hasParam($routeUriParams[$i])) {
                    $param = $route->getParam($routeUriParams[$i]);
                    if (preg_match($param->getPattern(), $requestUriParams[$i])) {
                        $params[] = new Manager\Result\Route\Param($param->getName(), $requestUriParams[$i]);
                        continue;
                    } else {
                        continue(2);
                    }
                }

                if ($requestUriParams[$i] != $routeUriParams[$i]) {
                    continue(2);
                }
            }

            return new Manager\Result\Route($route->getController(), $route->getAction(), $params);
        }

        return null;
    }

    // ########################################

    /**
     * @param string $uri
     *
     * @return array
     */
    private function explodeUriParams(string $uri): array
    {
        $params = explode('/', $uri);

        array_shift($params);
        array_pop($params);

        return $params;
    }

    // ########################################
}