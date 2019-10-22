<?php

namespace Igord\CustomBlog\lib;

class View
{
    /** @var string */
    private $viewBasePath;

    /** @var string */
    private $layout;

    /** @var \Igord\CustomBlog\lib\View\Block\Loader */
    private $blockLoader;

    // ########################################

    /**
     * View constructor.
     *
     * @param string                                  $viewBasePath
     * @param string                                  $layout
     * @param \Igord\CustomBlog\lib\View\Block\Loader $blockLoader
     */
    public function __construct(string $viewBasePath, string $layout, View\Block\Loader $blockLoader)
    {
        $this->viewBasePath = rtrim($viewBasePath, '/') . '/';
        $this->layout       = ltrim($layout, '/');
        $this->blockLoader  = $blockLoader;
    }

    // ########################################

    /**
     * @param string $pagePath
     * @param array  $vars
     */
    public function render(string $pagePath, array $vars = [])
    {
        ob_clean();

        if (!empty($vars)) {
            extract($vars);
        }

        $child       = $this->viewBasePath . ltrim($pagePath, '/');
        $blockLoader = $this->blockLoader;

        include_once $this->viewBasePath . $this->layout;
    }

    // ########################################
}