<?php

namespace Igord\CustomBlog\lib\View\Block;

class Loader
{
    /** @var \Igord\CustomBlog\lib\View\Block\Collection */
    private $collection;

    /** @var string */
    private $blockViewPath;

    /** @var \Psr\Container\ContainerInterface */
    private $container;

    // ########################################

    /**
     * Loader constructor.
     *
     * @param \Igord\CustomBlog\lib\View\Block\Collection $collection
     * @param string                                      $blockViewPath
     * @param \Psr\Container\ContainerInterface           $container
     */
    public function __construct(
        Collection $collection,
        string $blockViewPath,
        \Psr\Container\ContainerInterface $container
    ) {
        $this->collection    = $collection;
        $this->blockViewPath = rtrim($blockViewPath, '/');
        $this->container     = $container;
    }

    // ########################################

    /**
     * @param string $blockId
     */
    public function render(string $blockId): void
    {
        $block = $this->collection->getBlock($blockId);

        $handler = $this->container->get($block->getHandler());
        if (!($handler instanceof Handler\BaseInterface)) {
            throw new \LogicException("Handler of block: {$block->getId()} must be instance of " . Handler\BaseInterface::class);
        }

        $vars = $handler->getVars();
        if (!empty($vars)) {
            extract($vars);
        }

        $blockPath = ltrim($block->getBlockView(), '/');

        include_once $this->blockViewPath . '/' . $blockPath;
    }

    // ########################################
}