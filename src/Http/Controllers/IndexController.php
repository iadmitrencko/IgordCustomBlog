<?php

namespace Igord\CustomBlog\Http\Controllers;

class IndexController
{
    /** @var \Igord\CustomBlog\lib\View */
    private $view;

    /** @var \Igord\CustomBlog\Models\Posts */
    private $posts;

    // ########################################

    /**
     * IndexController constructor.
     *
     * @param \Igord\CustomBlog\lib\View     $view
     * @param \Igord\CustomBlog\Models\Posts $posts
     */
    public function __construct(
        \Igord\CustomBlog\lib\View $view,
        \Igord\CustomBlog\Models\Posts $posts
    ) {
        $this->view  = $view;
        $this->posts = $posts;
    }

    // ########################################

    /**
     * Render index page
     */
    public function show()
    {
        $this->view->render('pages/index.php', [
            'posts' => $this->posts->findAll(),
            'title' => 'Index page'
        ]);
    }

    // ########################################
}