<?php

namespace Igord\CustomBlog\Blocks\PopularPosts;

class Handler implements \Igord\CustomBlog\lib\View\Block\Handler\BaseInterface
{
    public const BLOCK_ID   = 'popular_posts';
    public const BLOCK_VIEW = self::BLOCK_ID . '.php';

    private const POSTS_MAX_LIMIT = 5;

    /** @var \Igord\CustomBlog\Models\Posts */
    private $posts;

    // ########################################

    /**
     * Handler constructor.
     *
     * @param \Igord\CustomBlog\Models\Posts $posts
     */
    public function __construct(\Igord\CustomBlog\Models\Posts $posts)
    {
        $this->posts = $posts;
    }

    // ########################################

    /**
     * @return array
     */
    public function getVars(): array
    {
        return [
            'popularPosts' => $this->posts->findAll(self::POSTS_MAX_LIMIT, true)
        ];
    }

    // ########################################
}