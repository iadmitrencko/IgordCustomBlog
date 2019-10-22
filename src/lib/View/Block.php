<?php

namespace Igord\CustomBlog\lib\View;

class Block
{
    /** @var string */
    private $id;

    /** @var string */
    private $blockView;

    /** @var string */
    private $handler;

    // ########################################

    /**
     * Block constructor.
     *
     * @param string $id
     * @param string $blockView
     * @param string $handler
     */
    public function __construct(string $id, string $blockView, string $handler)
    {
        $this->id        = $id;
        $this->blockView = $blockView;
        $this->handler   = $handler;
    }

    // ########################################

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBlockView(): string
    {
        return $this->blockView;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    // ########################################
}