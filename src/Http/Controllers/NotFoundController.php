<?php

namespace Igord\CustomBlog\Http\Controllers;

class NotFoundController
{
    /** @var \Igord\CustomBlog\lib\View */
    private $view;

    // ########################################

    /**
     * NotFoundController constructor.
     *
     * @param \Igord\CustomBlog\lib\View $view
     */
    public function __construct(\Igord\CustomBlog\lib\View $view)
    {
        $this->view = $view;
    }

    // ########################################

    /**
     * Render page 404
     */
    public function show()
    {
        http_response_code(404);

        $this->view->render('pages/errors/404.php', [
            'title' => 'Page not found.'
        ]);
    }

    // ########################################
}