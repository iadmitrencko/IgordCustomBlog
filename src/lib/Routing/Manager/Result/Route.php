<?php

namespace Igord\CustomBlog\lib\Routing\Manager\Result;

class Route
{
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
     * @param string        $controller
     * @param string        $action
     * @param Route\Param[] $params
     */
    public function __construct(
        string $controller,
        string $action,
        array $params = []
    ) {
        $this->controller = $controller;
        $this->action     = $action;
        $this->params     = $params;
    }

    // ########################################

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
     * @return bool
     */
    public function hasParams(): bool
    {
        if (empty($this->params)) {
            return false;
        }

        return true;
    }

    // ########################################
}