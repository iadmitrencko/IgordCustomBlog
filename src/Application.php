<?php

namespace Igord\CustomBlog;

class Application
{
    /** @var \Igord\CustomBlog\lib\View\Block\Collection */
    private $viewBlockCollection;

    /** @var \Igord\CustomBlog\lib\Routing\Route\Collection */
    private $routeCollection;

    /** @var \Igord\CustomBlog\lib\Routing\Manager */
    private $routingManager;

    /** @var \Igord\CustomBlog\lib\Routing\Route\Loader */
    private $routeLoader;

    /** @var \Igord\CustomBlog\Http\Controllers\NotFoundController */
    private $notFoundController;

    /** @var \Igord\CustomBlog\lib\Session */
    private $session;

    // ########################################

    /**
     * Application constructor.
     *
     * @param \Igord\CustomBlog\lib\View\Block\Collection           $viewBlockCollection
     * @param \Igord\CustomBlog\lib\Routing\Route\Collection        $routeCollection
     * @param \Igord\CustomBlog\lib\Routing\Manager                 $routingManager
     * @param \Igord\CustomBlog\lib\Routing\Route\Loader            $routeLoader
     * @param \Igord\CustomBlog\Http\Controllers\NotFoundController $notFoundController
     * @param \Igord\CustomBlog\lib\Session                         $session
     */
    public function __construct(
        lib\View\Block\Collection $viewBlockCollection,
        lib\Routing\Route\Collection $routeCollection,
        lib\Routing\Manager $routingManager,
        lib\Routing\Route\Loader $routeLoader,
        Http\Controllers\NotFoundController $notFoundController,
        lib\Session $session
    ) {
        $this->viewBlockCollection = $viewBlockCollection;
        $this->routeCollection     = $routeCollection;
        $this->routingManager      = $routingManager;
        $this->routeLoader         = $routeLoader;
        $this->notFoundController  = $notFoundController;
        $this->session             = $session;
    }

    // ########################################

    public function process(): void
    {
        $this->session->start();

        $this->registerBlocks();
        $this->registerRoutes();

        $route = $this->routingManager->findRoute();
        if (is_null($route)) {
            $this->notFoundController->show();

            return;
        }

        $this->routeLoader->process($route);

        return;
    }

    // ########################################

    /**
     * Register app blocks
     */
    private function registerBlocks(): void
    {
        $this->viewBlockCollection->addBlock(
            new lib\View\Block(
                Blocks\PopularPosts\Handler::BLOCK_ID,
                Blocks\PopularPosts\Handler::BLOCK_VIEW,
                Blocks\PopularPosts\Handler::class
            )
        );

        $this->viewBlockCollection->addBlock(
            new lib\View\Block(
                Blocks\Messages\Handler::BLOCK_ID,
                Blocks\Messages\Handler::BLOCK_VIEW,
                Blocks\Messages\Handler::class
            )
        );
    }

    /**
     * Register app routes
     */
    private function registerRoutes(): void
    {
        $this->routeCollection->addRoute(
            new lib\Routing\Route(
                lib\Http\Request::METHOD_GET,
                '/',
                Http\Controllers\IndexController::class,
                'show'
            )
        );

        $this->routeCollection->addRoute(
            new lib\Routing\Route(
                lib\Http\Request::METHOD_POST,
                '/post/',
                Http\Controllers\PostController::class,
                'add'
            )
        );

        $idParam = new lib\Routing\Route\Param('{id}', '#^[0-9]*$#');

        $this->routeCollection->addRoute(
            new lib\Routing\Route(
                lib\Http\Request::METHOD_GET,
                '/post/{id}',
                Http\Controllers\PostController::class,
                'show',
                [$idParam]
            )
        );

        $this->routeCollection->addRoute(
            new lib\Routing\Route(
                lib\Http\Request::METHOD_POST,
                '/post/{id}/comment',
                Http\Controllers\CommentController::class,
                'add',
                [$idParam]
            )
        );
    }

    // ########################################
}