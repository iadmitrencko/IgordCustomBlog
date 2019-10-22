<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $configurator) {
    // lib dependencies
    $services = $configurator->services()
                             ->defaults()
                             ->autowire()
                             ->autoconfigure();

    $services->load('Igord\\CustomBlog\\', '../src/*');

    $services->set(\Igord\CustomBlog\lib\Routing\Manager\Result\Route\Param::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Igord\CustomBlog\lib\Routing\Manager\Result\Route::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Igord\CustomBlog\lib\Routing\Route::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Igord\CustomBlog\lib\Routing\Route\Param::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Igord\CustomBlog\lib\View\Block::class)
             ->autowire(false)
             ->autoconfigure(false);

    $services->set(\Igord\CustomBlog\lib\Message::class)
             ->autowire(false)
             ->autoconfigure(false);

    // ########################################

    // app dependencies
    $services->set(\Igord\CustomBlog\lib\Database\Mysql\Manager\Connection\Config::class)->args([
        '$host'     => '#LOCAL_VALUE#',
        '$port'     => 3306,
        '$username' => '#LOCAL_VALUE#',
        '$password' => '#LOCAL_VALUE#',
        '$dbName'   => 'IgordCustomBlog'
    ]);

    $services->set(\Igord\CustomBlog\lib\Http\Request::class)->factory([
        ref(\Igord\CustomBlog\lib\Http\Request\Factory::class),
        'create'
    ]);

    $services->set(\Igord\CustomBlog\lib\View::class)->args([
        '$viewBasePath' => dirname(__DIR__, 1) . '/view/',
        '$layout'       => 'layout.php'
    ]);

    $services->set(\Igord\CustomBlog\lib\View\Block\Loader::class)
             ->arg('$blockViewPath', dirname(__DIR__, 1) . '/view/blocks/');

    $services->alias(
        \Igord\CustomBlog\lib\Message\Collection\BaseInterface::class,
        \Igord\CustomBlog\lib\Message\Session\Collection::class
    );
};