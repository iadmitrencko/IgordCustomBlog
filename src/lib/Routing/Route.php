<?php

namespace Igord\CustomBlog\lib\Routing;

class Route
{
    /** @var string */
    private $method;

    /** @var string */
    private $uri;

    /** @var string */
    private $controller;

    /** @var string */
    private $action;

    /** @var Route\Param[] */
    private $params;

    // ########################################

    /**
     * Route constructor.
     *
     * @param string        $method
     * @param string        $uri
     * @param string        $controller
     * @param string        $action
     * @param Route\Param[] $params
     */
    public function __construct(
        string $method,
        string $uri,
        string $controller,
        string $action,
        array $params = []
    ) {
        $this->method     = strtoupper($method);
        $this->uri        = rtrim($uri, '/') . '/';
        $this->controller = $controller;
        $this->action     = $action;
        $this->params     = $params;
    }

    // ########################################

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return Route\Param[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasParam(string $name): bool
    {
        foreach ($this->params as $param) {
            if ($name == $param->getName()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $name
     *
     * @return \Igord\CustomBlog\lib\Routing\Route\Param
     */
    public function getParam(string $name): Route\Param
    {
        foreach ($this->params as $param) {
            if ($name == $param->getName()) {
                return $param;
            }
        }

        throw new \LogicException("Cannot get param: {$name}.");
    }

    // ########################################
}