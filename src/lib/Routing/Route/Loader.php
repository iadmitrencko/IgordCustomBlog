<?php

namespace Igord\CustomBlog\lib\Routing\Route;

class Loader
{
    /** @var \Psr\Container\ContainerInterface */
    private $container;

    // ########################################

    /**
     * Loader constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }

    // ########################################

    /**
     * @param \Igord\CustomBlog\lib\Routing\Manager\Result\Route $route
     */
    public function process(\Igord\CustomBlog\lib\Routing\Manager\Result\Route $route): void
    {
        $controller = $this->container->get($route->getController());

        if ($route->hasParams()) {
            $params = [];
            foreach ($route->getParams() as $param) {
                $params[] = $param->getValue();
            }

            call_user_func_array([$controller, $route->getAction()], $params);
        } else {
            call_user_func([$controller, $route->getAction()]);
        }
    }

    // ########################################
}