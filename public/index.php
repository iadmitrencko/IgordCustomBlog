<?php

use Symfony\Component\DependencyInjection\ContainerBuilder as ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader as PhpFileLoader;
use Symfony\Component\Config\FileLocator as FileLocator;
use Igord\CustomBlog\Application as Application;

$rootDit = dirname(__DIR__, 1);
require $rootDit . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$loader           = new PhpFileLoader($containerBuilder, new FileLocator($rootDit . '/configs'));
$loader->load('services.php');
$containerBuilder->compile();

$app = $containerBuilder->get(Application::class);
$app->process();