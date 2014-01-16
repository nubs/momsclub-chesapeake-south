<?php

use \Assetic\Extension\Twig\AsseticExtension;
use \Assetic\Factory\AssetFactory;
use \Assetic\Filter\LessFilter;
use \Assetic\Filter\UglifyCssFilter;
use \Assetic\FilterManager;
use \Slim\Slim;
use \Slim\Views\Twig;
use \Slim\Views\TwigExtension;

return function (Slim $app) {
    $assetFilterManager = new FilterManager();
    $assetFilterManager->set('less', new LessFilter());
    $assetFilterManager->set('uglifycss', new UglifyCssFilter());

    $assetFactory = new AssetFactory(__DIR__ . '/assets/less');
    $assetFactory->setFilterManager($assetFilterManager);

    $twigView = new Twig();
    $twigView->parserOptions = ['autoescape' => false];

    $app->config('templates.path', __DIR__ . '/templates');
    $view = $app->view($twigView);
    $view->parserExtensions = [new TwigExtension(), new AsseticExtension($assetFactory)];
};
