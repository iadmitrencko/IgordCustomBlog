<?php

namespace Igord\CustomBlog\lib\View\Block;

class Collection
{
    /** @var \Igord\CustomBlog\lib\View\Block[] */
    private $blocks = [];

    // ########################################

    /**
     * @param \Igord\CustomBlog\lib\View\Block $block
     *
     * @throws \LogicException
     */
    public function addBlock(\Igord\CustomBlog\lib\View\Block $block)
    {
        if (array_key_exists($block->getId(), $this->blocks)) {
            throw new \LogicException("Cannot add block with id: {$block->getId()} the same block id is exist.");
        }

        $this->blocks[$block->getId()] = $block;
    }

    /**
     * @return \Igord\CustomBlog\lib\View\Block[]
     */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * @param string $id
     *
     * @return \Igord\CustomBlog\lib\View\Block
     * @throws \LogicException
     */
    public function getBlock(string $id): \Igord\CustomBlog\lib\View\Block
    {
        if (!array_key_exists($id, $this->blocks)) {
            throw new \LogicException("Cannot get block. Block with id: {$id} not exist.");
        }

        return $this->blocks[$id];
    }

    // ########################################
}
